<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdCarType\Interfaces;

class CarTypeController extends ApiController
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 获取车型数据
     * @method select
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function select(Request $request){
        return $this->respondWithSuccess(
            $this->repo->get(['id', 'name'])
        );
    }
}
