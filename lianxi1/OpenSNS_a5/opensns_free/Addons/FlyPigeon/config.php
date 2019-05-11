<?php

return   array_merge( array(
    'switch'=>array(//配置在表单中的键名 ,这个会是config[title]
        'title'=>'是否开启飞鸽传书短信：',//表单的文字
        'type'=>'radio',		 //表单的类型：text、textarea、checkbox、radio、select等
        'options'=>array(
            '1'=>'启用',
            '0'=>'禁用',
        ),
        'value'=>'1',
        'tip'=>'默认开启'
    ),
),
    get_option(),
    get_option2(),
    get_option3(),
    get_option4()
);

function get_option(){
    $arr['signature'] =
        array(
            'title'=>'签名ID',
            'type'=>'text',
            'value'=>'',
            'tip'=>'（必须配置）'
        );
    return $arr;
}

function get_option2(){
    $arr['template1'] =
        array(
            'title'=>'注册模板ID',
            'type'=>'text',
            'value'=>'',
            'tip'=>'（不是必填项）'
        );
    return $arr;
}

function get_option3(){
    $arr['template2'] =
        array(
            'title'=>'找回密码模板ID',
            'type'=>'text',
            'value'=>'',
            'tip'=>'（不是必填项）'
        );
    return $arr;
}

function get_option4(){
    $arr['template3'] =
        array(
            'title'=>'跟换手机模板ID',
            'type'=>'text',
            'value'=>'',
            'tip'=>'（不是必填项）'
        );
    return $arr;
}