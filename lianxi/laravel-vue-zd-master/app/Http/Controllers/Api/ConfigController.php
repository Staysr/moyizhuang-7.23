<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Config\UpdateRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Redis;

class ConfigController extends ApiController
{
    /**
     * 获取系统配置
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function index($key = 'zhoudao:sysconfig')
    {
        try {
            $arr = (array) json_decode(Redis::get($key), true);
            if ($arr) {
                foreach ($arr as $k => $v) {
                    $arr[$k] = round($v * 1, 1);
                }
            }
            return $this->respondWithSuccess($arr);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 设置系统配置
     *
     * @param UpdateRequest $request
     * @param string        $key
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function update(UpdateRequest $request, $key = 'zhoudao:sysconfig')
    {
        try {
            $input = $request->all();
            return $this->respondWithSuccess(Redis::set($key, json_encode($input)));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
}
