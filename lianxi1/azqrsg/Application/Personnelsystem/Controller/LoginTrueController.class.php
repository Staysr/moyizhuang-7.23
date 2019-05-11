<?php
namespace Personnelsystem\Controller;

use Think\Controller;
header("content-type:text/html;charset=utf-8");

class LoginTrueController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkAdminSession();
        $system = M("system");
        $rs_system = $system->field("sLoginTimeout")
            ->where("sId=1")
            ->find();
        $_SESSION['expiretime'] = time() + (($rs_system["sLoginTimeout"]) * 60);
    }

    public function CheckAdminSession()
    {
        // 设置超时为几分钟
        $system = M("system");
        $rs_system = $system->field("sLoginTimeout")
            ->where("sId=1")
            ->find();
        if (isset($_SESSION['expiretime'])) {
            if ($_SESSION['expiretime'] < time()) {
                unset($_SESSION['expiretime']);
                session(null);
                $this->error("登陆超时，请重新登陆！", U('login/index'));
                exit();
            } else {
                $_SESSION['expiretime'] = time() + (($rs_system["sLoginTimeout"]) * 60); // 刷新时间戳
            }
        }
    }

    public function ExitLogin()
    {
        session(null);
        $this->success("成功退出", U("login/index"));
    }

    public function LoginTrue()
    {
        if (! session("aUser")) {
            ?>
<script type="text/javascript">
			window.location.href="<?php echo __ROOT__;?>/login/";
            </script>
	<?php
	exit;
            // $this->error("Sorry ！你还没有登录，请登陆后访问！",U('/login/index/'));
            // exit;
        }
    }
}
