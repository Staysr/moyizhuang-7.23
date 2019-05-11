<?php

namespace app\admin\controller\server;

use app\admin\controller\AuthController;
use service\JsonService as Json;
use service\UpgradeService;
use think\Request;
use service\UpgradeApi;
use service\FormBuilder as Form;
use think\Url;
use app\admin\model\server\ServerWeb;
use app\admin\model\server\ServerVersion;
use app\admin\model\server\ServerUpgradeLog;
use service\UtilService as Util;

class ServerUpgrade extends AuthController
{
    //站点列表
    public function index(){
        $where = Util::getMore([
            ['name',''],
            ['https',''],
            ['ip',''],
            ['status','']
        ],$this->request);
        $this->assign(ServerWeb::systemPage($where));
        $this->assign('where',$where);
        return $this->fetch();
    }
    //版本列表
    public function versionlist(){
        $this->assign(ServerVersion::systemPage());
        return $this->fetch();
    }
    //服务器记录升级日志
    public function upgrade_log(){
        $where = Util::getMore([
            ['webid',''],
            ['page','']
        ],$this->request);
        $this->assign(ServerUpgradeLog::systemPage($where));
        $this->assign('where',$where);
        return $this->fetch();
    }
    //添加版本
    public function add_version(){
        if($post=input('post.')){
            $post['add_time']=time();
            $post['type']='update';
            if(empty($post['zip_name'])) return Json::fail('请上传升级ZIP包');
            if(empty($post['openfile'])) return Json::fail('请上传升级ZIP包');
            $FileService=new UpgradeService;
            $listFile=$FileService->list_dir_info($post['openfile'],true);
            $post['update_file']=$listFile?json_encode($listFile):'';
            ServerVersion::create($post);
            $FileService->del_dir($post['openfile']);
            return Json::successful('保存成功');
        }else{
            return $this->fetch();
        }
    }

    //编辑版本
    public function edit_version(Request $request,$id){
        if($post=input('post.')){
            $data = Util::postMore([
                'content'
            ],$request);
            if(!$data['content']) return Json::fail('请输入版本更新内容');
            //更新包未编辑
            ServerVersion::edit($data,$id);
            return Json::successful('修改成功!');
        }else{
            $this->assign('Version',ServerVersion::get($id));
            return $this->fetch();
        }
    }
    //更新保存版本
    public function update_version(Request $request,$id)
    {
        if(!$id) return $this->failed('数据不存在');
        $data = Util::postMore([
            'content'
        ],$request);
        if(!$data['content']) return Json::fail('请输入版本更新内容');
        //更新包未编辑
        ServerVersion::update($data,array('id'=>$id));
        return Json::successful('修改成功!');
    }
    //删除版本
    public function delete_version($id){
        if(!$id) return $this->failed('数据不存在');
        $ver = ServerVersion::get($id)->toArray();
        if(!empty($ver['zip_name'])){
            $file_name=ROOT_PATH . 'public' . DS . 'uploads'.DS.'upgrade'.DS.$ver['zip_name'];
            @unlink($file_name);
        }
        if(ServerVersion::where(['id'=>$id])->delete()){
            Json::successful('删除成功');
        }else{
            Json::fail('删除失败');
        }
    }
    //上传更新包
    public function upload(){
        $request=Request::instance();
        $file =$request->file('zip_file');
        $zip_file=$file->getInfo();
        $pathino=pathinfo($zip_file['name']);
        if(isset($pathino['extension']) && $pathino['extension']!='zip'){
            return Json::fail('上传格式有误 只允许为 zip 文件');
        }
        if($file){
            $file_name=ROOT_PATH . 'public' . DS . 'uploads'.DS.'upgrade';
            $info = $file->move($file_name);
            if($info){
                $FileService=new UpgradeService;
                $open=ROOT_PATH.'public'.DS.'zipopen'.time().'/';
                $link=$file_name.'/'.$info->getSaveName();
                $FileService->ZipOpen($link,$open);
//                $listFile=$FileService->list_dir_info($open,true,'sql');
//                if(!$listFile){
//                    $FileService->unlink_file($link);
//                    $FileService->del_dir($open);
//                    return Json::fail('未检测到上传的ZIP文件里有.SQL类型的文件,如果没有更新数据库,请携带空的.SQL文件上传');
//                }
                if(file_exists($open.'application/version.php') || file_exists($open.'application/database.php')){
                    $FileService->unlink_file($link);
                    $FileService->del_dir($open);
                    return Json::fail('不允许上传 application/version.php 文件 或者 application/database.php 文件。');
                }
                return Json::successful(['savename'=>$info->getSaveName(),'openfile'=>$open]);
            }else{
                return Json::fail($file->getError());
            }
        }
    }
    //删除更新包
    public function del_zip(){
        if($zip_name=input('post.zip_name')){
            $file_name=ROOT_PATH . 'public' . DS . 'uploads'.DS.'upgrade'.DS.$zip_name;
            if(file_exists($file_name)) @unlink($file_name);
            return Json::successful('删除成功');
        }
    }
    //添加站点表单
    public function create(){
        $f = array();
        $f[] = Form::input('ip','IP');
        $f[] = Form::input('https','网址');
        $f[] = Form::input('name','网站名称');
        $form = Form::make_post_form('添加站点',$f,Url::build('createweb'));
        $this->assign(compact('form'));
        return $this->fetch('public/form-builder');

    }
    //添加站点
    public function createweb(Request $request){
        $data = Util::postMore([
            'ip',
            'https',
            'name',
        ],$request);
        if($data['ip'] == '') return Json::fail('请输入IP');
        if(!$data['https']) return Json::fail('请输入网址');
        if(!$data['name']) return Json::fail('请输入站点名称');
        $data['add_time'] = time();
        ServerWeb::set($data);
        return Json::successful('添加站点成功!');
    }

    //授权
    public function shouquan($id=''){
        if(!$id) return $this->failed('数据不存在');
        if(ServerWeb::where(['id'=>$id])->update(['status'=>1,'auth_time'=>time()])){
            Json::successful('授权成功');
        }else{
            Json::fail('授权失败');
        }
    }
    //取消授权
    public function unshouquan($id=''){
        if(!$id) return $this->failed('数据不存在');
        if(ServerWeb::where(['id'=>$id])->update(['status'=>0,'unauth_time'=>time()])){
            Json::successful('取消成功');
        }else{
            Json::fail('取消失败');
        }
    }
    //删除站点授权
    public function delete($id=''){
        if(!$id) return $this->failed('数据不存在');
        if(ServerWeb::where(['id'=>$id])->delete()){
            Json::successful('删除成功');
        }else{
            Json::fail('删除失败');
        }
    }

}