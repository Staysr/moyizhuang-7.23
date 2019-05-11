<?php

return array(
    array(
        'name'    => 'rechargetips',
        'title'   => '充值提示文字',
        'type'    => 'text',
        'content' =>
            array(),
        'value'   => '余额可用于购买商品或用于商城消费',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'moneylist',
        'title'   => '充值金额列表',
        'type'    => 'array',
        'content' =>
            array(),
        'value'   =>
            array(
                '￥10'  => '10',
                '￥20'  => '20',
                '￥30'  => '30',
                '￥50'  => '50',
                '￥100' => '100',
            ),
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'defaultmoney',
        'title'   => '默认充值金额',
        'type'    => 'string',
        'content' =>
            array(),
        'value'   => '10',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'minmoney',
        'title'   => '最低充值金额',
        'type'    => 'string',
        'content' =>
            array(),
        'value'   => '1',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '最低的充值金额',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'iscustommoney',
        'title'   => '是否开启任意金额',
        'type'    => 'radio',
        'content' =>
            array(
                1 => '开启',
                0 => '关闭',
            ),
        'value'   => '1',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'paytypelist',
        'title'   => '支付方式',
        'type'    => 'checkbox',
        'content' =>
            array(
                'wechat' => '微信支付',
                'alipay' => '支付宝支付',
            ),
        'value'   => 'wechat,alipay',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'defaultpaytype',
        'title'   => '默认支付方式',
        'type'    => 'radio',
        'content' =>
            array(
                'wechat' => '微信支付',
                'alipay' => '支付宝支付',
            ),
        'value'   => 'wechat',
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '',
        'ok'      => '',
        'extend'  => '',
    ),
);
