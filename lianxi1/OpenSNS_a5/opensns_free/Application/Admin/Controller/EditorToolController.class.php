<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12 0012
 * Time: 下午 2:47
 */
namespace Admin\Controller ;

use Admin\Builder\AdminConfigBuilder;

class EditorToolController extends AdminController{
    public function config() {
        $group = array() ;
        $builder = new AdminConfigBuilder() ;
        $data = $builder->handleConfig();
        $builder->data($data);
        $builder->title('编辑器配置信息')->suggest('请谨慎配置，容易导致编辑器无法使用。编辑器配置名需要以当前大写模块名开头，如动态中添加：WEIBO_ADD。');
        foreach ($data as $key=>$val) {
            $map = explode('_', $key) ;
            if(count($map) >= 2){
                if(!D('Module')->checkInstalled(ucfirst(strtolower($map[0])))){
                    continue ;
                }
            }
            if($key == 'DEFAULT')
                continue ;
            $tip = switch_name($key) ;
            if(!is_array($group[$tip[1][1]]))
                $group[$tip[1][1]] = array() ;
            array_push($group[$tip[1][1]], $key) ;
            if($tip[0]['url']){
                $tip[0]['url'] = '位置：'.$tip[0]['url'] ;
            }else{
                $tip[0]['url'] = '' ;
            }
            $builder->keyTextarea($key, $tip[0]['tip'], $tip[0]['url']);
        }
        unset($val) ;
        $builder->keyTextarea('DEFAULT', '编辑器默认配置');
        if(isset($group['自定义编辑器'])){
            $builder->group('自定义编辑器', $group['自定义编辑器']);
            unset($group['自定义编辑器']) ;
        }
        if(isset($group['默认编辑器配置']))
            unset($group['默认编辑器配置']) ;
        $builder->group('编辑器默认配置', array('DEFAULT'));
        foreach ($group as $k=>$value){
            $builder->group($k, $value);
        }
        unset($value) ;
        $builder->buttonSubmit();
        $builder->display();
    }

    public function chooseEditor() {
        $type = I('type', 'editor', 'string') ;
        $config = urldecode(I('config', '', 'string')) ;
        $name = I('name', 'content', 'string') ;
        $style = I('style', '', 'text') ;
        $style = (array)json_decode(urldecode($style)) ;
        $value = I('value', '', 'string') ;
        $type = strtolower($type) ;
        $noLoad = I('no_load', 1,'intval') ;
        if($type == 'markdown') {
            $html = W('Common/EditorMd/markDown',array($name,$name,$value,$config)) ;
        }else{
            $html = W('Common/Ueditor/editor',array($name,$name,$value,$style['width'],$style['height'],$config,'',array('is_load_script'=>$noLoad))) ;
        }
    }
}
