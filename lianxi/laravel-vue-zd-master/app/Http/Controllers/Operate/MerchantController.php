<?php

namespace App\Http\Controllers\Operate;

use App\Searchs\Modules\Operate\Merchant\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdMerchant\Interfaces;

class MerchantController extends ApiController
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(Request $request){
        return $this->respondWithSuccess(
            $this->repo->join(['user'])->getWhere(
                new IndexSearch([]),
                ['zd_merchant.id', 'zd_merchant.short_name']
            )
        );
    }
}
