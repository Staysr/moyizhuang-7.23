<?php
/**
 * new-zhoudao
 * ApiController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use luffyzhao\laravelTools\Traits\ResponseTrait;
use Tymon\JWTAuth\Http\TokenResponse;
use Illuminate\Support\Facades\Log;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseTrait;
    
    /**
     * 错误响应.
     *
     * @method respondWithError
     *
     * @param  [type] $message [description]
     * @param int $code [description]
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    protected function respondWithError($message, $code = 500)
    {
        return new JsonResponse(
            [
                'data'    => [],
                'code'    => $code,
                'message' => $message,
            ],
            $code
        );
    }
    
    /**
     * 成功响应.
     *
     * @method respondWithSuccess
     *
     * @param  [type] $data    [description]
     * @param string $message [description]
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    protected function respondWithSuccess($data, $message = '成功')
    {
        return new JsonResponse(
            [
                'data'    => $data,
                'code'    => 200,
                'message' => $message,
            ]
        );
    }
    
    
    /**
     * 登录响应.
     *
     * @method respondWithToken
     *
     * @param  [type] $token [description]
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    protected function respondWithToken($token)
    {
        return $this->respondWithSuccess(
            [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60,
            ]
        );
    }
}