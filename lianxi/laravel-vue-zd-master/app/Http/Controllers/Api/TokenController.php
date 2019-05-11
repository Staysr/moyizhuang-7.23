<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Token\StoreRequest;
use App\Http\Requests\Api\Token\SmsRequest;
use App\Http\Requests\Api\Token\ForgetRequest;
use App\Repositories\Modules\ZdSms\Interfaces as ZdSmsInterfaces;
use App\Foundations\Util;
use Illuminate\Support\Facades\Redis;
use App\Repositories\Modules\ZdSysUser\Interfaces as ZdSysUserInterface;
use Mockery\Exception;

class TokenController extends ApiController
{
    /**
     * 登录
     * @method store
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        $token = auth('api')->attempt(
            $request->only(['phone', 'password'])
        );
        
        if (!$token) {
            return $this->respondWithError('用户不存在,或者密码不正确！');
        }
        
        return $this->respondWithToken((string) $token);
    }
    
    /**
     * 获取登录用户信息
     * @method index
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index()
    {
        return $this->respondWithSuccess(
            auth('api')->user()
        );
    }
    
    /**
     * 获取登录用户所有权限
     * @method permission
     *
     * @author luffyzhao@vip.126.com
     */
    public function permission()
    {
        return $this->respondWithSuccess(
            auth('api')->user()->cachedRole()->cachedPermissions()
        );
    }
    
    /**
     * 发送短信
     *
     * @param SmsRequest      $request
     * @param ZdSmsInterfaces $sms
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function sms(SmsRequest $request, ZdSmsInterfaces $sms)
    {
        $code    = Util::RandomCode(6);
        $content = $code . "(验证码,五分钟内有效)【方舟货的】";
        Redis::setex('zhoudao:sys:forget:' . $request->input(['phone']), 300, $code);
        
        try {
            $input = [
                'mobile'   => $request->input(['phone']),
                'contents' => $content,
                'remark'   => '舟到后台管理系统找回密码',
            ];
            return $this->respondWithSuccess($sms->create($input));
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 忘记密码
     *
     * @param ForgetRequest      $request
     * @param ZdSysUserInterface $zdSysUser
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function forget(ForgetRequest $request, ZdSysUserInterface $zdSysUser)
    {
        try {
            $user = $zdSysUser->findWhere($request->only(['phone']));
            return $this->respondWithSuccess($zdSysUser->update($user, $request->only(['password'])));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
}