<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Company\SelectRequest;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdCompany\Interfaces;
use App\Searchs\Modules\Api\Company\SelectSearch;

class CompanyController extends ApiController
{
    protected $repo;
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param SelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(SelectRequest $request){
        $search = new SelectSearch($request->only(['name']));
        return $this->respondWithSuccess(
            $this->repo->getWhere($search->toArray(), [
                'id', 'name'
            ])
        );
    }
}
