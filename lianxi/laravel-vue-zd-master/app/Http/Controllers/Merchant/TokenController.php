<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Notifications\Push\Merchant\Logout;
use Illuminate\Http\Request;
use App\Repositories\Modules\ZdMerchantUser\Interfaces;
use App\Repositories\Modules\ZdVersion\Interfaces as ZdVersionInterfaces;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\Merchant\Token\LoginRequest;
use Auth;

class TokenController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/4 16:52
     */
    public function login(LoginRequest $request)
    {

        $credentials = request(['phone', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return $this->respondWithError('密码输入错误', 401);
        }
        // 帐户禁用
        if (0 === auth()->user()->status) {
            return $this->respondWithError('您的账户已被禁用，请联系岗控经理处理', 401);
        }
        // 如果原来有登录就退出
        $credentials = $request->only(['device_token', 'phone']);
        if(auth()->user()->device_token && !empty($credentials['device_token']) && $credentials['device_token'] !==auth()->user()->device_token){
            auth()->user()->notify(new Logout);
            Redis::del("zhoudao:app:login:".auth()->user()->device_token);
        }
        // 模拟器不管
        if(!empty($credentials['device_token'])){
            Redis::set("zhoudao:app:login:".$credentials['device_token'], $credentials['phone']);
        }
        // 更新登录
        $credentials = $request->only(['device_token', 'os', 'os_version', 'model', 'app_version', 'resolution']);
        if (!empty($credentials)) {
            $this->repo->update(auth()->user(), $credentials);
        }

        return $this->respondWithToken((string)$token);
    }

    /**
     * 系统版本
     * @param ZdVersionInterfaces $version
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/7/18 11:21
     */
    public function version(ZdVersionInterfaces $version)
    {
        $info = $version->findWhere(
            ['app_type' =>3,'status'=>1 ],
            [
                'version_no',
                'version_desc',
                'force_update',
                'download_url'
            ]
        );

        return $this->respondWithSuccess($info);
    }

    /**
     * 获取登录信息.
     *
     * @method me
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function me()
    {
        return $this->respondWithSuccess(auth()->user());
    }

    /**
     * 退出登录.
     *
     * @method logout
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function logout()
    {
        auth()->logout();

        return $this->respondWithSuccess([], '退出成功');
    }

    /**
     * 刷新token.
     *
     * @method refresh
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
