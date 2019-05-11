<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use luffyzhao\laravelTools\Traits\ResponseTrait;
use Tymon\JWTAuth\Http\TokenResponse;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseTrait;

    /**
     * 错误响应.
     *
     * @method respondWithError
     *
     * @param [type] $message [description]
     * @param int $code [description]
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    protected function respondWithError($message, $code = 500)
    {
        Log::info(
            json_encode(
                [
                    'message' => $message,
                ],
                $code
            ,JSON_UNESCAPED_UNICODE)
        );

        return response()->json(
            [
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
     * @param [type] $data    [description]
     * @param string $message [description]
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    protected function respondWithSuccess($data, $message = '成功')
    {
        return response()->json(
            [
                'data' => $data ,
                'message' => $message,
            ]
        );
    }


    /**
     * 登录响应.
     *
     * @method respondWithToken
     *
     * @param [type] $token [description]
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
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        );
    }
}
