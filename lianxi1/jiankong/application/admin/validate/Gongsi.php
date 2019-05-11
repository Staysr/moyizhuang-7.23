<?php
namespace app\admin\validate;
use think\Validate;
class Gongsi extends Validate
{

    protected $rule = [
        ['danwei_name','require|max:50|unique:danwei','单位名称不能为空|姓名最多不能超过50个字符|单位名已经注册'],
        ['shebei_name','require|max:50|unique:danwei','设备名称不能为空|姓名最多不能超过50个字符|设备名已经注册'],
        ['shebei_number','require|max:50|unique:danwei','设备编码不能为空|姓名最多不能超过50个字符|设备编码已经注册'],

    ];



}