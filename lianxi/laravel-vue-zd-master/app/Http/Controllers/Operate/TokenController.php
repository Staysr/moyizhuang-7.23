<?php
/**
 * zdapp
 * TokenController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Operate;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Operate\Token\StoreRequest;
use App\Repositories\Modules\ZdDriver\Interfaces;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(){
        return $this->respondWithSuccess(
            auth('api')->user()
        );
    }
}