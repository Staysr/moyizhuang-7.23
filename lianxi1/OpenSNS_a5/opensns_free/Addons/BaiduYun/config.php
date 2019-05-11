<?php

return array_merge(array(
    'switch' => array(//配置在表单中的键名 ,这个会是config[title]
        'title' => '是否开启百度云短信：',//表单的文字
        'type' => 'radio',         //表单的类型：text、textarea、checkbox、radio、select等
        'options' => array(
            '1' => '启用',
            '0' => '禁用',
        ),
        'value' => '1',
        'tip' => '默认开启'
    ),
),
    get_option(),
    get_option2(),
    get_option3()
);

function get_option()
{
    $arr['corp_id'] =
        array(
            'title' => '账户id',
            'type' => 'text',
            'value' => '',
            'tip' => '（必须配置）'
        );
    return $arr;
}

function get_option2()
{
    $arr['corp_pwd'] =
        array(
            'title' => '账户密码',
            'type' => 'text',
            'value' => '',
            'tip' => '（必须配置）'
        );
    return $arr;
}

function get_option3()
{
    $arr['corp_service'] =
        array(
            'title' => '业务代码',
            'type' => 'text',
            'value' => '',
            'tip' => '（必须配置）'
        );
    return $arr;
}