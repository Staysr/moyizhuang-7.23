<?php
namespace app\admin\validate;
use think\Validate;
class Shiyan extends Validate
{

    protected $rule = [
        ['danwei','require|max:60','单位不能为空|单位名最多不能超过60个字符'],

        ['name','require|max:60','姓名不能为空|姓名最多不能超过60个字符'],

        ['tel','require|number|max:60','电话不能为空|电话必须为数字|最大不能超过60字符'],

        ['title','require|max:60:','标题不能为空|最大不能超过60字符'],
       
        ['startwendu','max:60','温度不能超过60个字符'],

        ['endwendu','max:60','温度不能超过60个字符'],
        
        ['startshidu','max:60','湿度不能超过60个字符'],

        ['endshidu','max:60','湿度不能超过60个字符'],

        ['startyangqi','max:60','氧气不能超过60个字符'],
        
        ['endyangqi','max:60','氧气不能超过60个字符'],

        ['starteryang','max:60','二氧化碳不能超过60个字符'],
        
        ['enderyang','max:60','二氧化碳不能超过60个字符'],

       
    ];
    protected $scene=[
        // 'login'=>['danwei','name'=>'require|max:25','password','captcha'],

    ];
}