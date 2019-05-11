CRMEB 基于thinkphp5的电商管理系统 [官网](http://www.crmeb.com)
===============
常见问题：http://blog.9gt.net/?p=136
> ThinkPHP5的运行环境要求PHP5.5.5以上。
QQ群：116279623

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─admin               后台目录
│  │  ├─controller      控制器目录
│  │  │  ├─agent        代理商
│  │  │  ├─article      文章内容管理
│  │  │  ├─distributor  分销
│  │  │  ├─finance      财务管理
│  │  │  ├─order       订单管理
│  │  │  ├─record      数据统计
│  │  │  ├─routine     小程序后台管理
│  │  │  ├─server      程序升级服务端管理
│  │  │  ├─setting     系统设置
│  │  │  ├─store       商城目录
│  │  │  ├─system      系统维护
│  │  │  ├─ump         营销管理
│  │  │  ├─user        用户目录
│  │  │  ├─wechat      微信管理目录
│  │  │  ├─widget      公共调用
│  │  │  ├─merchant    商户目录
│  │  │  ├─AuthController.php        后台基类
│  │  │  ├─Common.php                后台公共方法类
│  │  │  ├─Login.php                 登录
│  │  │  ├─Index.php                 后台首页
│  │  │  └─AuthController.php        后台基类
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  │  ├─index       首页目录
│  │  │  ├─login       登录目录
│  │  │  └─public      公共目录
│  │  ├─common.php      后台公共函数
│  │  └─config.php      模块配置文件
│  │
│  ├─wap                 手机端目录
│  │  ├─controller      控制器目录
│  │  │  └─AuthController.php        wap基类
│  │  ├─model           模型目录
│  │  │  ├─merchant    后台目录
│  │  │  ├─store       商城目录
│  │  │  └─user        用户目录
│  │  ├─view           视图目录
│  │  │  ├─index       首页目录
│  │  │  ├─login       登录目录
│  │  │  ├─public      公共目录
│  │  │  ├─store       商城目录
│  │  │  ├─merchant    商户目录
│  │  │  ├─article     文章目录
│  │  │  ├─my          用户目录
│  │  │  └─service     客服目录
│  │  ├─common.php      wap公共函数
│  │  └─config.php      模块配置文件
│  │
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  ├─version.php        版本文件
│  └─database.php       数据库配置文件
│
├─public                公共目录
│  ├─static              全局静态文件目录
│  │    ├─plug           第三方插件前后台公用
│  │    ├─css            css前后台公用
│  │    └─js             js前后台公用
│  ├─system              后台静态文件目录
│  │    ├─plug           第三方插件后台
│  │    ├─js             后台
│  │    ├─css            后台
│  │    ├─images         后台
│  │    ├─frame          后台框架
│  │    ├─module         后台功能模块
│  │    ├─plug           后台第三方插件
│  │    └─util           后台自定义常用工具
│  ├─wap                  前台静态文件目录
│  │   ├──first           模版1
│  ├─install              程序安装文件目录
│  ├─uploads              上传文件目录
│  ├─router.php           路由文件
│  ├─index.php            程序入口文件
│  ├─mysql.php            数据字典工具
│  ├─.htaccess            apache 环境伪静态文件
│  ├─nginx.conf           nginx 环境伪静态文件
│  └─web.config           iis 环境伪静态文件
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
│  ├─api               公共api目录
│  ├─basic             基础继承类目录
│  ├─behavior          全局行为目录
│  │  ├─system        后台行为
│  │  ├─wechat        微信行为
│  │  ├─merchant      商户行为
│  │  └─wap           wap端行为
│  ├─service           全局服务目录
│  └─traits            公共特性目录
│
├─vendor               composer扩展类库目录
│  ├─xaboy             后台快速创建表单类
│  ├─tp5er             数据库备份类
│  ├─phpoffice         表格操作类
│  ├─overtrue          微信接口类
│  └─traits            公共特性目录
│
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─index.php             入口文件
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
~~~
## 账号密码
+ 前台
  + 账号: crmeb
  + 密码: 123456
+ 后台
  + 账号: admin
  + 密码: crmeb.com

## 微信配置

+ 授权接口 : 
  + `/wap/wechat/serve`
+ 支付api接口 : 
  + `/wap/my/`
  + `/wap/my/order/uni/`
  + `/wap/store/confirm_order/cartId/`
+ 模板消息
  + IT科技 | 互联网|电子商务
  + IT科技 | IT软件与服务

## 模板变量

+ {__ADMIN_PATH}    =>  /public/system/
+ {__FRAME_PATH}    =>  /public/system/frame/
+ {__PLUG_PATH}     =>  /public/static/plug/
+ {__MODULE_PATH}   =>  /public/system/module/
+ {__STATIC_PATH}   =>  /public/static/
+ {__PUBLIC_PATH}   =>  /public/
+ {__WAP_PATH}      =>  /public/wap/

## 公共方法
* \service\CacheService 系统缓存类
```
    // 设置系统缓存
    set($key, $value) 
    // 获取系统缓存
    get($key, $default) 
    // 删除指定系统缓存
    rm($key)  
    // 清空所有系统缓存
    clear() 
```
* \service\ExportService 导出csv表格类
```
    // 导出Csv
    exportCsv($list 数据, $fliename 文件名, $header 表格头部, $br 换行分隔符) 
```
* \service\GroupDataService 组合数据类
```
    // 获得组合数据信息+组合数据列表
    getGroupData($configName,$limit) 
    // 获得组合数据列表
    getData($configName,$limit) 
```
* \service\HookService 行为扩展类
```
    // 资源监听 自动注册前置行为操作 + 行为操作
    resultListen($tag, $params, $extra = null, $once = false,$behavior = null 自动注册类) 
    // 监听后置行为操作
    afterListen($tag, $params, $extra = null, $once = false, $behavior = null 自动注册类) 
    // 监听前置行为操作
    beforeListen($tag,$params,$extra = null, $once = false, $behavior = null) 
    // 监听行为操作
    listen($tag, $params, $extra = null, $once = false, $behavior = null) 
    // 添加前置行为
    addBefore($tag, $behavior, $first = false) 
    // 添加后置行为
    addAfter($tag, $behavior, $first = false) 
    // 添加行为
    add($tag, $behavior, $first = false) 
    
```
* \service\HttpService Request请求类
```
    // 发送get请求
    getRequest($url, $data = array(), $header = false, $timeout = 10)
    // 发送post请求
    postRequest($url, $data = array(), $header = false, $timeout = 10)
    // 发送请求
    request($url, $method = 'get', $data = array(), $header = false, $timeout = 15)
    // 获取请求head头
    getHeaderStr():String
    // 获取请求head头
    getHeader():Array
```
* \service\JsonService Json输出类
```
    // 成功
    successful($msg = 'ok',$data=[])
    // 成功+状态
    status($status,$msg,$result = [])
    // 失败
    fail($msg,$data=[])
```
* \service\QrcodeService 二维码生成类
```
    // 获取一个临时二维码,不存在自动生成
    getTemporaryQrcode($type,$id)
    // 获取一个永久二维码,不存在自动生成
    getForeverQrcode($type,$id)
    // 查询已有的二维码
    getQrcode($id,$type = 'id')
```
* \service\SystemConfigService 系统配置类
```
    // 获取一个系统配置,带缓存
    config($key)
    // 获取一个系统配置,不带缓存
    get($key)
    // 获取多个系统配置,不带缓存
    more($keys = [])
    // 获取所有系统配置,不带缓存
    getAll()
```
* \service\UploadService 文件上传类
```
    // 单图上传
    image($fileName, $path, $moveName = true, $autoValidate=true, $root=null, $rule='uniqid')
    // 文件上传
    file($fileName, $path, $moveName = true, $autoValidate=[], $root=null, $rule='uniqid')
    // 图片压缩
    thumb($filePath, $ratio=8, $pre='s_')
```
* \service\WechatService 微信服务类
参考:https://www.easywechat.com/docs/3.x
```
    // 获取微信配置参数
    options()
    // 多客服消息转发
    transfer($account = '')
    // 上传永久素材接口
    materialService()
    // 上传临时素材接口
    materialTemporaryService()
    // 用户接口
    userService()
    // 客服消息接口
    staffService()
    // 微信公众号菜单接口
    menuService()
    // 微信二维码生成接口
    qrcodeService()
    // 短链接生成接口
    urlService()
    // 用户授权
    oauthService()
    // 模板消息接口
    noticeService()
    // 发送模板消息
    sendTemplate($openid,$templateId,array $data,$url = null,$defaultColor = null)
    // 支付接口
    paymentService()
    // 下载商户流水
    downloadBill($day,$type = 'ALL')
    // 用户标签服务
    userTagService()
    // 用户分组服务
    userGroupService()
    // 获得jsSdk支付参数 
    jsPay($openid, $out_trade_no, $total_fee, $attach, $body, $detail='', $trade_type='JSAPI', $options = [])
    // 订单退款
    payOrderRefund($orderNo, array $opt)
    // 支付成功回调
    handleNotify()
    // jssdk Config参数
    jsSdk($url = '')
    // 回复文本消息
    textMessage($content)
    // 回复图片消息
    imageMessage($media_id)
    // 回复视频消息
    videoMessage($media_id, $title = '', $description = '...', $thumb_media_id = null)
    // 回复声音消息
    voiceMessage($media_id)
    // 回复图文消息
    newsMessage($title, $description = '...', $url = '', $image = '')
    // 回复文章消息
    articleMessage($title, $thumb_media_id, $source_url, $content = '', $author = '', $digest = '', $show_cover_pic = 0, $need_open_comment = 0, $only_fans_can_comment = 1)
    // 回复素材消息
    materialMessage($type, $media_id)
    // 作为客服消息发送
    staffTo($to, $message)
    // 获得用户信息
    getUserInfo($openid)
```
* \service\WechatTemplateService 微信模板消息类
```
    // 发送模板消息
    sendTemplate($openid,$templateId,array $data,$url = null,$defaultColor = '')
    // 给管理员发送模板消息
    sendAdminNoticeTemplate(array $data,$url = null,$defaultColor = '')
```
## 基础继承类
* \basic\ModelBasic Model基础类
```
    /**
     * 获得Db并缓存
     * @param $name
     * @param bool $update
     * @return mixed|\think\db\Query
     */
    protected static function getDb($name, $update = false)
    
    /**
     * 设置错误信息
     * @param string $errorMsg
     * @return bool
     */
    protected static function setErrorInfo($errorMsg = self::DEFAULT_ERROR_MSG,$rollback = false)
    
    /**
     * 获取错误信息
     * @param string $defaultMsg
     * @return string
     */
    public static function getErrorInfo($defaultMsg = self::DEFAULT_ERROR_MSG)
    
    /**
     * 开启事务
     */
    public static function beginTrans()
    
    /**
     * 提交事务
     */
    public static function commitTrans()
    
    /**
     * 关闭事务
     */
    public static function rollbackTrans()

    /**
     * 根据结果提交或者滚回事务
     * @param $res
     */
    public static function checkTrans($res)
```
* \basic\SystemBasic 后台基础类
```
    /**
     * 操作失败提示框
     * @param string $msg 提示信息
     * @param string $backUrl 跳转地址
     * @param string $title 标题
     * @param int $duration 持续时间
     * @return mixed
     */
    protected function failedNotice($msg = '操作失败', $backUrl = 0, $info = '', $duration = 3)
    /**
     * 失败提示一直持续
     * @param $msg
     * @param int $backUrl
     * @param string $title
     * @return mixed
     */
    protected function failedNoticeLast($msg = '操作失败', $backUrl = 0, $info = '')
    
    /**
     * 操作成功提示框
     * @param string $msg 提示信息
     * @param string $backUrl 跳转地址
     * @param string $title 标题
     * @param int $duration 持续时间
     * @return mixed
     */
    protected function successfulNotice($msg = '操作成功',$backUrl = 0,$info = '',$duration = 3)
    
    /**
     * 成功提示一直持续
     * @param $msg
     * @param int $backUrl
     * @param string $title
     * @return mixed
     */
    protected function successfulNoticeLast($msg = '操作成功',$backUrl = 0,$info = '')

    /**
     * 错误提醒页面
     * @param string $msg
     * @param int $url
     */
    protected function failed($msg = '哎呀…亲…您访问的页面出现错误', $url = 0)

    /**
     * 成功提醒页面
     * @param string $msg
     * @param int $url
     */
    protected function successful($msg, $url = 0)
```
* \basic\WapBasic Wap端基础类
```
    /**
     * 操作失败 弹窗提示 ajax请求时返回json数据
     * @param string $msg
     * @param int $url
     * @param string $title
     */
    protected function failed($msg = '操作失败', $url = 0, $title='错误提示')
    
    /**
     * 操作成功 弹窗提示 ajax请求时返回json数据
     * @param $msg
     * @param int $url
     */
    protected function successful($msg = '操作成功', $url = 0, $title='成功提醒')
    
    /**
     * 微信用户自动登陆 并返回openid
     * @return string $openid
     */
    protected function oauth()
```
##  公共特性类
* \traits\ModelTrait Model公共特性
```
    /**
     * 添加一条数据
     * @param $data
     * @return object $model 数据对象
     */
    public static function set($data)
    
    /**
     * 添加多条数据
     * @param $group
     * @param bool $replace
     * @return mixed
     */
    public static function setAll($group, $replace = false)
    
    /**
     * 修改一条数据
     * @param $data
     * @param $id
     * @param $field
     * @return bool $type 返回成功失败
     */
    public static function edit($data,$id,$field = null)
    
    /**
     * 查询一条数据是否存在
     * @param $map
     * @param string $field
     * @return bool 是否存在
     */
    public static function be($map, $field = '')
    
    /**
     * 删除一条数据
     * @param $id
     * @return bool $type 返回成功失败
     */
    public static function del($id)
    
    /**
     * 分页
     * @param null $model 模型
     * @param null $eachFn 处理结果函数
     * @param array $params 分页参数
     * @param int $limit 分页数
     * @return array
     */
    public static function page($model = null, $eachFn = null, $params = [], $limit = 20)
    
    /**
     * 高精度 加法
     * @param int|string $uid id
     * @param string $decField 相加的字段
     * @param float|int $dec 加的值
     * @param string $keyField id的字段
     * @param int $acc 精度
     * @return bool
     */
    public static function bcInc($key, $incField, $inc, $keyField = null, $acc=2)
    
    /**
     * 高精度 减法
     * @param int|string $uid id
     * @param string $decField 相减的字段
     * @param float|int $dec 减的值
     * @param string $keyField id的字段
     * @param bool $minus 是否可以为负数
     * @param int $acc 精度
     * @return bool
     */
    public static function bcDec($key, $decField, $dec, $keyField = null, $minus = false, $acc=2)
```
## Api接口
* \Api\Express 快递查询
```
    /**
     * 快递查询
     * @param string $number 单号
     * @param string $type 快递公司编号
     * @return bool
     */
    public static function query($number, $type = 'auto')
    
    /**
     * 获得所有快递公司信息
     * @return bool
     */
    public static function type()
```

## 后台全局Api $eb
```
    // 查看图片
    $eb.openImage(src)
    /**
     * 提示框 
     * @param type 'delete' 删除提示 | 'error' 错误提示 | 'success' 成功提示 |
     * @param param
     * @param code
     */
    $eb.$swal(type,param,code)
    
    /**
     * 弹出框
     * @param type 'textarea' 多行输入框输入框
     * @param params
     * @param succFn
     */
    $eb.$alert(type,params,succFn)
    
    /**
     * message
     * @param type 'success' | 'warning' | 'error' | 'loading' | 'default'
     * @param config
     * @returns {*}
     */
    $eb.message(type,config)
    
    /**
     * notice
     * @param type 'success' | 'warning' | 'error' | 'default'
     * @param config
     * @returns {*}
     */
    $eb.notice(type,config)
    
    // 关闭notice
    $eb.noticeClose(name)

    // 销毁notice
    $eb.noticeDestroy(name)
    
    /**
     * modal
     * @param type 'success' | 'warning' | 'error' | 'confirm' | 'default'
     * @param config
     * @returns {*}
     */
    $eb.modal(type,config)
    
    // 移除modal
    $eb.modalRemove
    
    
    /**
     * 加载条
     * @param type 'start' 开启 | 'finish' 结束 | 'error' 错误 | 'update' 更新到指定percent
     * @param percent
     * @returns {*}
     */
     $eb.loading(type,percent)
     
     /**
      * 使用弹窗打开iframe页面
      * @param title
      * @param src
      * @param opt
      * @returns index
      */
     $eb.createModalFrame(title,src,opt)
     
     /**
       * 关闭iframe页面
       * @param name | index
       */
     $eb.closeModalFrame(name)
     
     /**
       * 全局layer
       */
     $eb.layer
     
     /**
       * 全局axios
       */
     $eb.axios
```

## 前端工具类

### public/static/plug/helper.js  助手类
```
    // 信息提示  提前引入 layer插件
    $h.pushMsg  = function(msg,fn)
    // 同时只提示一次信息  提前引入 layer插件
    $h.pushMsgOnce = function(msg,fn)
    // 加载中   提前引入 layer插件
    $h.load = function()
    // 加载中 透明背景  提前引入 layer插件
    $h.loadFFF = function()
    // 关闭加载中
    $h.loadClear = function()
    // ajax文件上传  提前引入 ajaxFileUpload插件
    $h.ajaxUploadFile = function (name,url,fnGroup)
    // 高精度除法
    $h.div = function(arg1,arg2)
    // 高精度乘法
    $h.Mul = function(arg1,arg2)
    // 高精度加法
    $h.Add = function(arg1,arg2)
    // 高精度减法
    $h.Sub = function(arg1,arg2)
    // cookie操作
    $h.cookie = function(key,val,time)
    // get参数获取
    $h.getParmas = function getUrlParam(name)
    // tp5路由生成
    $h.U = function(opt = {c:'控制器',a:'方法',p:'路由参数',q:'get参数'});
    // 是否登陆中
    $h.isLogin = function()
    // 获得未压缩图片url
    $h.unThumb = function (src)
```

### public/static/plug/wxApi.js 微信api接口

### public/static/plug/reg-verify.js 类型验证

```
    // 是否网址
    isHref:function(test)
    // 是否为邮箱
    isEmail:function(test)
    // 是否为手机号
    isPhone:function(test)
    // 是否为邮编
    isPostCode:function(test)
    // 是否为空
    isEmpty:function(test)
    // 是否为Array
    isArray:function(test)
    // 是否为Object
    isObject:function(test)
    // 是否为Undefined
    isUndefined:function(test)
    // 是否为Null
    isNull:function(test)
    // 去除左右空格
    trim:function(test)
```
### public/wap/first/crmeb/module/store.js api请求

```
    /**
     * 发送GET请求
     * @param url 地址
     * @param successCallback 成功回调 JsonService::successfly
     * @param errorCallback 失败回调 JsonService::failed
     */
    baseGet:function(url,successCallback,errorCallback)
    
    /**
     * 发送POST请求 使用
     * @param url 地址
     * @param data post参数
     * @param successCallback 成功回调 JsonService::successfly
     * @param errorCallback 失败回调 JsonService::failed
     */
    basePost:function(url,data,successCallback,errorCallback)
```

