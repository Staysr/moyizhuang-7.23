<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\ZdCategory\Interfaces;

class CategoryController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    public function checkbox(Request $request){
        return $this->respondWithSuccess(
            $this->repo->scope(['city'])->get([
                'id', 'name'
            ])
        );
    }
}
