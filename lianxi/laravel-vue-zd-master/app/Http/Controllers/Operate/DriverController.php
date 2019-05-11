<?php
/**
 * zdapp
 * DriverController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Operate;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Operate\Driver\IndexRequest;
use App\Repositories\Modules\ZdDriver\Interfaces;
use App\Searchs\Modules\Operate\Driver\IndexSearch;

class DriverController extends ApiController
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 大队长列表
     * @method governor
     * @author luffyzhao@vip.126.com
     */
    public function big(){
        return $this->respondWithSuccess(
            auth('api')->user()->drivers()->select(['id', 'name', 'phone', 'type'])->get()
        );
    }

    /**
     * 小队长列表
     * @method small
     * @author luffyzhao@vip.126.com
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function small($id){
        return $this->respondWithSuccess(
            $this->repo->getWhere([
                'type' => 1,
                'status' => 1,
                'app_status'=> 1,
                'supervisor_id' => $id
            ], ['id', 'phone', 'name'])
        );
    }

    /**
     * 查找司机
     * @method index
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(IndexRequest $request){
        $request = new IndexSearch($request->all());
        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $request,
                ['id', 'phone', 'name'])
        );
    }
}