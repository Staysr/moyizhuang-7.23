<?php

/**
 * 订单类相关脚本
 */

namespace Cron\Controller;

use Common\Controller\CronController;

class OrderController extends CronController {

    public function index() {
        echo IS_CLI;
    }

    /**
     * 将过期的系统课订单置为已结束,过期的普通课设置已退单
     * @author Gao Fang
     * @date 2017-09-01
     */
    public function tutoring() {
        $tutoringModel = M('tutoring_order');
        $time = time();
        //修改业务记录的状态
        $tutoringModel->where("`status` = 2 and expiration_time < {$time}")->save(array('status' => 3));

        //$orderModel = M('order');
        //修复订单的状态
        //系统课设置为过期
        $sql = "update app_order as ao,app_course_instance as aci set ao.`status`=3 WHERE ao.instance_id = aci.id and aci.tutoring=2 and ao.`status`=2 and ao.expiration_time > 0 and ao.expiration_time < {$time}";
        $tutoringModel->execute($sql);

        //普通课设置为退单
        $sql2 = "update app_order as ao,app_course_instance as aci set ao.`status`=4 WHERE ao.instance_id = aci.id and aci.tutoring=2 and ao.`status`=2 and ao.expiration_time > 0 and ao.expiration_time < {$time}";
        $tutoringModel->execute($sql2);
    }

}
