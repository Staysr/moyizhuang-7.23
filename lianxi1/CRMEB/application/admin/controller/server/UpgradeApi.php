<?php
/*
 * Upgrade 控制器 供在线升级使用，售出客户端无此文件
 *
 */

namespace app\admin\controller\server;

use think\Controller;
use service\JsonService as Json;
use think\Request;
use service\HookService;
use app\admin\model\server\ServerWeb;
use app\admin\model\server\ServerVersion;
use app\admin\model\server\ServerUpgradeLog;

class UpgradeApi extends Controller
{
    protected $post;
    protected $https;
    protected $ip;

    public function _initialize()
    {
       $this->post=$this->request->post();
        if(!$this->request->isPost()) return Json::fail('请用POST访问');
        $whiter_list=[$this->request->action(),self::get_access_rule()];
        if($whiter_list[0]!='updatewebinfo'){
            if(!isset($this->post['token'])) return Json::fail('请传入token验证您的信息');
            if(!($math=ServerVersion::check_token($this->post,function() use($whiter_list) {
                list($pathinfo,$white)=$whiter_list;
                if(!is_array($white)) return false;
                foreach ($white as $val){
                    if(strpos($pathinfo,$val)!==false){
                        return true;
                    }
                }
                return false;
            }))) return Json::fail('token 验证失败或是您没有权限访问');
            list($https,$ip)=$math;
            $this->ip=$ip;
            $this->https=$https;
        }
        if(empty($this->post)) $this->post=$this->request->request();
        if(!empty($this->https)) $this->post['https']=$this->https;
        if(!empty($this->ip)) $this->post['ip']=$this->ip;
        //处理掉 request 里面的索引
        if(isset($this->post['s'])){
            $post=$this->post;
            $arr=[];
            $this->post=null;
            foreach($post as $k=>$val){
                if($k!='s'){
                    $arr[$k]=$val;
                }
            }
            $this->post=$arr;
        }
        // if(!empty($this->ip)) $this->post['ip']=$this->ip;
        if(!isset($this->post['ip'])) return Json::fail('请传入ip验证您的信息');
        if(!isset($this->post['https'])) return Json::fail('请传入https验证您的信息');
    }
    public static function ceshi(){
        $res = $_SERVER;
//        $res = [1,2,3,4];
        return json_encode($res);
    }
    //白名单
    public static function get_access_rule(){
        //设置不用验证是否授权的方法
        return [
            'updatewebinfo',
            'get_version_list',
            'new_version_count',
            'isauth'
        ];
    }
    //更新站点信息
    public function updatewebinfo(){
        $data=ServerVersion::Examine($this->post,[
            'ip','host','version','version_code','https'
        ]);
        $data['name']=isset($this->post['webname'])?$this->post['webname'] :'';
        $data['last_time'] = time();
        if(ServerWeb::be(['host'=>$data['host']])){
            ServerWeb::update($data,['host'=>$data['host']]);
        }else{
            $data['add_time'] = time();
             ServerWeb::create($data);
        }
        return Json::successful('ok');
    }
    //是否授权
    public function isauth(){
        $info=ServerWeb::isAuth($this->ip,$this->https);
        return Json::successful($info);
    }
    //获取最新版本版本号
    public function now_version(){
        return Json::successful(['version'=>ServerVersion::getNowVersion()]);
    }
    //获取升级版本详细信息
    public function version_info(){
        $post=ServerVersion::Examine($this->post,['version','id']);
        if(empty($post['version']) || empty($post['id'])) return Json::fail('缺少参数 version 或者 ID ');
        $zipinfo=ServerVersion::getZipInfo($post);
        if($zipinfo){
            return Json::successful($zipinfo);
        }else{
            return Json::fail('服务器异常');
        }
    }
    //获取在线更新列表历史列表
    public function get_version_list(){
        $post=ServerVersion::Examine($this->post,[['page',1],['limit',20]]);
        $list=ServerVersion::order('id desc')->field(['add_time','content','version','id'])->page($post['page'],$post['limit'])->select()->toArray();
        foreach ($list as &$val){
            $val['add_time']=date('Y-m-d H:i:s',$val['add_time']);
        }
        return Json::successful($list);
    }
    //升级完成，写入日志
    public function set_upgrade_info(){
        $post=ServerVersion::Examine($this->post,['versionid','update_time','versionbefor','versionend','content','type']);
        if($this->ip && $this->https){
            $post['webid']=ServerWeb::where(['ip'=>$this->ip,'https'=>$this->https])->value('id');
        }
        ServerUpgradeLog::create($post);
        return Json::successful('写入日志成功');
    }
    //获取当前版本以上的版本
    public function get_now_version($id){
        $list=ServerVersion::where('id','>',$id)->field(['zip_name','version','id'])->order('id asc')->select()->toArray();
        return Json::successful($list);
    }
    public function new_version_count(){
        $post=ServerVersion::Examine($this->post,'id');
        $count=ServerVersion::where('id','>',$post['id'])->count();
        return Json::successful(['count'=>$count]);
    }
}