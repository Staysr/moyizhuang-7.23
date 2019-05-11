<?php

/**
 * 定时器控制器基类
 */

namespace Common\Controller;

use Think\Controller;

class CronController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!IS_CLI) {
            die('illegal access');
        }
        set_time_limit(0);
    }

}
