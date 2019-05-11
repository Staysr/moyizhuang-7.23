<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdSafe\Interfaces;
use App\Http\Requests\Api\Safe\StoreRequest;
use Illuminate\Http\Request;

class SafeController extends ApiController
{
    protected $repo;
    
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * 列表
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function index()
    {
        return $this->respondWithSuccess(
            $this->repo->paginate(
                [],
                20,
                ['id', 'type', 'title', 'safe_fee', 'is_per', 'max_payment', 'status']
            )
        );
    }
    
    /**
     * 添加
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(
            ['type', 'title', 'safe_fee', 'is_per', 'max_payment', 'status']
        );
        try {
            return $this->respondWithSuccess($this->repo->create($input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 详情
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function show($id)
    {
        $safe = $this->repo->find($id);
        return $this->respondWithSuccess($safe);
    }
    
    /**
     * 切换状态
     *
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function cutoverStatus(Request $request, $id)
    {
        $this->validate($request, ['status' => ['required', 'in:0,1']], [], ['status' => '状态']);
        try {
            $safe  = $this->repo->find($id);
            $input = $request->only(['status']);
            return $this->respondWithSuccess($this->repo->update($safe, $input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 保价服务
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function select(Request $request)
    {
        return $this->respondWithSuccess(
            $this->repo->getWhere(['type' => 1, 'status' => 1], ['id', 'title'])
        );
    }
    
}
