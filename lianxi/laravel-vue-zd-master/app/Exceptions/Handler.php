<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use luffyzhao\laravelTools\Sign\Exceptions\SignException;
use Illuminate\Support\Facades\Log;
use JPush\Exceptions\APIRequestException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];
    
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson() && !config('app.debug')) {
            if ($exception instanceof AuthenticationException) {
                return response()->json(
                    [
                        'message' => 'Token已过期失效',
                    ],
                    402
                );
            }
            elseif ($exception instanceof NotFoundHttpException) {
                return response()->json(
                    [
                        'message' => '找不到接口地址!',
                    ],
                    500
                );
            }
            elseif ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(
                    [
                        'message' => '数据提交方式不正确!',
                    ],
                    500
                );
            }
            if ($exception instanceof AuthenticationException) {
                return response()->json(
                    [
                        'message' => '没有找到对应的登录用户',
                    ],
                    401
                );
            }
            elseif ($exception instanceof ValidationException) {
                return response()->json(
                    [
                        'data'    => [
                            'message' => current($exception->errors())[0]
                        ],
                        'message' => '验证不通过',
                    ],
                    423
                );
            }
            elseif ($exception instanceof SignException) {
                return response()->json(
                    [
                        'message' => $exception->getMessage(),
                    ],
                    400
                );
            }
            elseif ($exception instanceof APIRequestException) {
                return response()->json(
                    [
                        'message' => '推送失败!',
                    ],
                    500
                );
            }
            else {
                return response()->json(
                    [
                        'message' => '系统错误,请联系管理员!',
                    ],
                    500
                );
            }
        }
        
        return parent::render($request, $exception);
    }
}
