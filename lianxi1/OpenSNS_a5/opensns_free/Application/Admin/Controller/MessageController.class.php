<?php
namespace Admin\Controller;

use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminListBuilder;

/**
 * Class MessageController  消息控制器
 * @package Admin\Controller
 * @author:xjw129xjt(肖骏涛) xjt@ourstu.com
 */
class MessageController extends AdminController
{


    public function userList($page=1,$r=20)
    {
        $aSearch1 = I('get.user_search1','');
        $aSearch2 = I('get.user_search2',0,'intval');
        $map = array();

        if (empty($aSearch1) && empty($aSearch2)) {


            $aUserGroup = I('get.user_group', 0, 'intval');
            $aRole = I('get.role', 0, 'intval');


            if (!empty($aRole) || !empty($aUserGroup)) {
                $uids = $this->getUids($aUserGroup, $aRole);
                $map['uid'] = array('in', $uids);
            }


            $user = D('member')->where($map)->page($page, $r)->field('uid,nickname')->select();
            foreach ($user as &$v) {
                $v['id'] = $v['uid'];
            }
            unset($v);
            $totalCount = D('member')->where($map)->count();

        } else {

            $uids = $this->getUids_sc($aSearch1, $aSearch2);
            $map['uid'] = array('in', $uids);

            $user = D('member')->where($map)->page($page, $r)->field('uid,nickname')->select();
            foreach ($user as &$v) {
                $v['id'] = $v['uid'];
            }
            unset($v);
            $totalCount = D('member')->where($map)->count();


        }
        $r = 20;

        $role = D('Role')->selectByMap(array('status' => 1));
        $user_role = array(array('id' => 0, 'value' => L('_ALL_')));
        foreach ($role as $key => $v) {
            array_push($user_role, array('id' => $v['id'], 'value' => $v['title']));
        }

        $group = D('AuthGroup')->getGroups();

        $user_group = array(array('id' => 0, 'value' => L('_ALL_')));
        foreach ($group as $key => $v) {
            array_push($user_group, array('id' => $v['id'], 'value' => $v['title']));
        }


        $builder = new AdminListBuilder();
        $builder->title(L('_"MASS_USER_LIST"_'));
        $builder->meta_title = L('_"MASS_USER_LIST"_');

        $builder->setSelectPostUrl(U('Message/userList'))
            ->setSearchPostUrl(U('Message/userList'))
            ->select(L('_USER_GROUP:_'), 'user_group', 'select', L('_FILTER_ACCORDING_TO_USER_GROUP_'), '', '', $user_group)
            ->select(L('_IDENTITY_'), 'role', 'select', L('_FILTER_ACCORDING_TO_USER_IDENTITY_'), '', '', $user_role)
            ->search('','user_search1','',L('_SEARCH_ACCORDING_TO_USERS_NICKNAME_'),'','','')
            ->search('','user_search2','',L('_SEARCH_ACCORDING_TO_USER_ID_'),'','','');
        $builder->buttonModalPopup(U('Message/sendMessage'), array('user_group' => $aUserGroup, 'role' => $aRole), L('_SEND_A_MESSAGE_'), array('data-title' => L('_MASS_MESSAGE_'), 'target-form' => 'ids', 'can_null' => 'true'));
        $builder->keyText('uid', '用户ID')->keyText('nickname', L('_"NICKNAME"_'));

        $builder->data($user);
        $builder->pagination($totalCount, $r);
        $builder->display();


    }

    private function getUids($user_group = 0, $role = 0)
    {
        $uids = array();
        if (!empty($user_group)) {
            $users = D('auth_group_access')->where(array('group_id' => $user_group))->field('uid')->select();
            $group_uids = getSubByKey($users, 'uid');
            if ($group_uids) {
                $uids = $group_uids;
            }
        }
        if (!empty($role)) {
            $users = D('user_role')->where(array('role_id' => $role))->field('uid')->select();
            $role_uids = getSubByKey($users, 'uid');
            if ($role_uids) {
                $uids = $role_uids;
            }
        }
        if (!empty($role) && !empty($user_group)) {
            $uids = array_intersect($group_uids, $role_uids);
        }
        return $uids;


    }
    private function getUids_sc($search_nn = "", $search_id = 0)
    {
        $uids = array();
        if (!empty($search_nn)) {
            $users = D('member')->where(array('nickname' => $search_nn))->field('uid')->select();
            $uids_nn = getSubByKey($users, 'uid');
            if ($uids_nn) {
                $uids = $uids_nn;
            }
        }
        if (!empty($search_id)) {
            $users = D('member')->where(array('uid' => $search_id))->field('uid')->select();
            $uids_id = getSubByKey($users, 'uid');
            if ($uids_id) {
                $uids = $uids_id;
            }
        }
        if (!empty($search_id) && !empty($search_nn)) {
            $uids = array_intersect($search_id, $search_nn);
        }
        return $uids;
    }

    public function sendMessage()
    {

        if (IS_POST) {
            $aSendType=I('post.sendType','','text');
            $aUids = I('post.uids');
            $aUserGroup = I('post.user_group');
            $aUserRole = I('post.user_role');
            $aTitle = I('post.title', '', 'text');
            $aContent = I('post.content', '', 'html');
            $aUrl = I('post.url', '', 'text');
            $aArgs = I('post.args', '', 'text');
            $args = array();
            // 转换成数组
            if ($aArgs) {
                $array = explode('/', $aArgs);
                while (count($array) > 0) {
                    $args[array_shift($array)] = array_shift($array);
                }
            }

            if (empty($aTitle)) {
                $this->error(L('_PLEASE_ENTER_THE_MESSAGE_HEADER_'));
            }
            if (empty($aContent)) {
                $this->error(L('_PLEASE_ENTER_THE_MESSAGE_CONTENT_'));
            }
            // 以权限组或身份发送消息
            if(empty($aUids)){
                if (empty($aUserGroup) && empty($aUserRole)) {
                    $this->error(L('_PLEASE_SELECT_A_USER_GROUP_OR_AN_IDENTITY_GROUP_OR_USER_'));
                }

                $role_count = D('Role')->where(array('status' => 1))->count();
                $group_count = D('AuthGroup')->where(array('status' => 1))->count();
                if ($role_count == count($aUserRole)) {
                    $aUserRole = 0;
                }
                if ($group_count == count($aUserGroup)) {
                    $aUserGroup = 0;
                }
                if (!empty($aUserRole)) {
                    $uids = D('user_role')->where(array('role_id' => array('in', $aUserRole)))->field('uid')->select();
                }
                if (!empty($aUserGroup)) {
                    $uids = D('auth_group_access')->where(array('group_id' => array('in', $aUserGroup)))->field('uid')->select();
                }
                if (empty($aUserRole) && empty($aUserGroup)) {
                    $uids = D('Member')->where(array('status' => 1))->field('uid')->select();
                }
                $to_uids = getSubByKey($uids, 'uid');
            }else{
                // 用uid发送消息
                $to_uids = explode(',',$aUids);
            }
            if(in_array('systemMessage',$aSendType)){
                $resMessage=D('Message')->sendMessageWithoutCheckSelf($to_uids, $aTitle, $aContent, $aUrl, $args);
                if($resMessage!==true){
                    $this->error('发送失败~');
                }
            }
            if(in_array('systemEmail',$aSendType)){
                $resEmail=D('Message')->sendEmail($to_uids, $aTitle, $aContent, $aUrl, $args);
                if($resEmail!==true){
                    $this->error($resEmail);
                }
            }
            if(in_array('mobileMessage',$aSendType)){
                $resMobile=D('Message')->sendMobileMessage($to_uids, $aTitle, $aContent, $aUrl, $args);
                if($resMobile!==true){
                    $this->error($resMobile);
                }
            }

            $result['status'] = 1;
            $result['info'] = L('_SEND_');
            $this->ajaxReturn($result);
        } else {
            $aUids = I('get.ids');
            $aUserGroup = I('get.user_group', 0, 'intval');
            $aRole = I('get.role', 0, 'intval');
            if (empty($aUids)) {
                $role = D('Role')->selectByMap(array('status' => 1));
                $roles = array();
                foreach ($role as $key => $v) {
                    array_push($roles, array('id' => $v['id'], 'value' => $v['title']));
                }
                $group = D('AuthGroup')->getGroups();
                $groups = array();
                foreach ($group as $key => $v) {
                    array_push($groups, array('id' => $v['id'], 'value' => $v['title']));
                }
                $this->assign('groups', $groups);
                $this->assign('roles', $roles);
                $this->assign('aUserGroup', $aUserGroup);
                $this->assign('aRole', $aRole);
            } else {
                $uids = implode(',',$aUids);
                $users = D('Member')->where(array('uid'=>array('in',$aUids)))->field('uid,nickname')->select();
                $this->assign('users', $users);
                $this->assign('uids', $uids);
            }
            $this->display('sendmessage');
        }
    }

    /**———————————————消息改版 zzl———————————————————*/
    public function config()
    {
        $admin_config = new AdminConfigBuilder();
        $data = $admin_config->handleConfig();

        $admin_config->title("会话配置")
            ->data($data)
            ->keySelect('MESSAGE_SESSION_TPL', '会话列表模板', '', array('session1' => '官方模板1','session2' => '官方模板2','session3' => '官方模板3','session4' => '官方模板4'))
            ->buttonSubmit()
            ->buttonBack()
            ->display();
    }

    /**
     * 系统会话列表
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function messageSessionList()
    {
        $message_sessions=get_all_message_session();
        foreach($message_sessions as &$val){
            if($val['block_tpl']){
                $val['block_tpl']=APP_PATH.$val['module'].'/.../'.$val['block_tpl'].'.html';
            }else{
                $val['block_tpl']=APP_PATH.'Common/.../_message_block.html';
            }
            if($val['default']){
                $val['name']=$val['name'].'【默认】';
            }
        }
        unset($val);
        $builder=new AdminListBuilder();
        $builder->title('会话类型列表')
            ->suggest('这里只能查看和刷新，要对会话做增删改，请修改对应文件')
            ->ajaxButton(U('Message/sessionRefresh'),null,'刷新',array('hide-data' => 'true'))
            ->keyText('name','标识（发送消息时的$type参数值）')
            ->keyTitle()
            ->keyText('alias','所属模块')
            ->keyImage('logo','会话图标')
            ->keyText('sort','排序值')
            ->keyText('block_tpl','列表样式模板(“...”表示“View/default/MessageTpl/block”)')
            ->data($message_sessions)
            ->display();
    }
    public function sessionRefresh()
    {
        S('ALL_MESSAGE_SESSION',null);
        $this->success('刷新成功！',U('Message/messageSessionList'));
    }
    public function tplRefresh()
    {
        S('ALL_MESSAGE_TPL',null);
        $this->success('刷新成功！',U('Message/messageTplList'));
    }
    /**
     * 消息模板列表
     * @author 郑钟良<zzl@ourstu.com>
     */
    public function messageTplList()
    {
        $message_tpls=get_message_tpl();
        foreach($message_tpls as &$val){
            if($val['tpl_name']){
                $val['tpl_name']=APP_PATH.$val['module'].'/.../'.$val['tpl_name'].'.html';
            }else{
                $val['tpl_name']=APP_PATH.'Common/.../_message_li.html';
            }
            if($val['default']){
                $val['name']=$val['name'].'【默认】';
            }
            $val['example_content']=$this->_toShowArray($val['example_content']);
        }
        unset($val);
        $builder=new AdminListBuilder();
        $builder->title('消息模板列表')
            ->suggest('这里只能查看和刷新，要对会话做增删改，请修改对应文件')
            ->ajaxButton(U('Message/tplRefresh'),null,'刷新',array('hide-data' => 'true'))
            ->keyText('name','标识（发送消息时的$tpl参数值）')
            ->keyTitle('title','文字说明')
            ->keyText('alias','所属模块')
            ->keyText('tpl_name','消息模板(“...”表示“View/default/MessageTpl/tpl”)')
            ->keyHtml('example_content','messageContent模板')
            ->data($message_tpls)
            ->display();
    }
    private function _toShowArray(&$data)
    {
        if(is_array($data)){
            $str="\$messageContent=array(<br>";
            foreach($data as $key=>$val){
                $str.="&nbsp;&nbsp;&nbsp;&nbsp;'".$key."'=>'".$val."',<br>";
            }
            unset($key,$val);
            $str.=');';
            return $str;
        }
        return $data;
    }

    public function listMessageEvent()
    {
        $event = M('message_event')->where(array('status' => 1))->select();
        $this->assign('event', $event);
        $this->meta_title = "消息模板" ;
        $this->display('list');
    }

    public function addMessageEvent()
    {
        if(IS_POST) {
            $aTitle = I('post.title', '', 'text');
            $aName = I('post.name', '', 'text');
            $aZhannei = I('post.zhannei', '', 'intval');
            $aSms = I('post.sms', '', 'intval');
            $aEmail = I('post.email', '', 'intval');
//            $aWeixin = I('post.weixin', '', 'intval');
//            $aApp = I('post.app', '', 'intval');
            $aStatus = I('post.status', '', 'intval');
            if(!$aTitle || !$aName) {
                $this->error('标题或者标识不能为空！');
            }

            $data = array('name' => $aName, 'title' => $aTitle, 'zhannei' => $aZhannei, 'sms' => $aSms, 'email' => $aEmail, 'status' => $aStatus);
            $model = M('message_event');
            $data = $model->create($data);
            $result = $model->add($data);

//            D('message_template')->add(array('event_id' => $result, 'status' => 1));

            if (!$result) {
                $this->error(L('_ERROR_CREATE_FAIL_'));
            }
            $this->success('创建成功');
        } else {
            $builder = new AdminConfigBuilder();
            $builder->title('添加消息事件')
                ->keyTitle()
                ->keyText('name', '事件标识', '事件标识唯一')
                ->keyBool('zhannei', '是否发送站内消息' ,'')->keyDefault('zhannei', 1)
                ->keyBool('sms', '是否发送短信' ,'')->keyDefault('sms', 1)
                ->keyBool('email', '是否发送电子邮件' ,'')->keyDefault('email', 1)
//                ->keyBool('weixin', '是否发送微信公众号消息' ,'')->keyDefault('weixin', 1)
//                ->keyBool('app', '是否发送APP推送' ,'')->keyDefault('app', 1)
                ->keyStatus()->keyDefault('status', 1)
                ->buttonSubmit(U('addMessageEvent'))->buttonBack()
                ->display();
        }
    }
    
    public function saveMessageEvent()
    {
        $arr = $_POST;
        foreach ($arr as $key => $v) {
            foreach ($v as $val) {
                $data[$val][$key] = 1;
            }
        }
        
        $events = M('message_event')->where(array('status' => 1))->select();
        foreach ($events as $key => $val) {
            $event[$val['id']] = array(
                'zhannei' => 0,
                'sms' => 0,
                'email' => 0,
//                'weixin' => 1,
//                'app' => 1,
            );
        }
        unset($val);

        $data_merge = $data + $event;
        foreach ($data_merge as $key => $s) {
            $list = array(
                'zhannei' => $s['zhannei'],
                'sms' => $s['sms'],
                'email' => $s['email'],
            );
            $res = M('message_event')->where(array('id' => $key))->setField($list);
        }
        unset($s);

        $this->success('修改成功~');
    }

    //新消息模板
    public function editMessageTemplate()
    {
        $tempId = I('get.id', 0, 'intval');
        if($_POST) {
            $data['zhannei'] = I('post.zhannei', '');
            $data['sms'] = I('post.sms', '');
            $data['email'] = I('post.email', '');
            $data['status'] = 1;
            if(M('message_template')->where(array('event_id' => $tempId))->find()) {
                $res = D('message_template')->where(array('event_id' => $tempId))->save($data);
            } else {
                $data['event_id'] = $tempId;
                $res = D('message_template')->add($data);
            }

            if($res) {
                $this->success('保存成功~');
            }
        } else {
            $builder = new AdminConfigBuilder();
            $data = M('message_template')->where(array('event_id' => $tempId))->find();

            $builder->title('编辑信息模板')->data($data)
                ->keyEditor('zhannei', '站内消息模板')
                ->keyEditor('sms', '短信模板')
                ->keyEditor('email', '电子邮件模板')
                ->group('站内消息', 'zhannei')
                ->group('短信', 'sms')
//                ->group('微信公众号')
                ->group('电子邮件', 'email')
//                ->group('APP')
                ->buttonSubmit(U('editmessagetemplate', array('id' => $tempId)), '保存')
                ->buttonBack()
                ->display();
        }

    }

    //编辑消息模板
//    public function editMessageTemplate()
//    {
//        if($_POST) {
//            $eventId = I('get.id', 0, 'intval');
//
//            $data['zhannei'] = I('post.zhannei', '');
//            $data['sms'] = I('post.sms', '');
//            $data['email'] = I('post.email', '');
//
//            $res = D('message_template')->where(array('event_id' => $eventId))->save($data);
//            if($res) {
//                $this->success('保存成功~');
//            }
//        }
//    }

}
