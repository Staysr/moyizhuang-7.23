<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Repositories\Modules\ZdSysRule\Interfaces;
use App\Searchs\Modules\Api\Permission\IndexSearch;
use App\Http\Requests\Api\Permission\StoreRequest;
use App\Http\Requests\Api\Permission\UpdateRequest;
use Illuminate\Support\Facades\Cache;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Api
 */
class PermissionController extends ApiController
{
    
    protected $repo;
    
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch($request->only(['islink']));
        
        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'parent_id', 'name', 'icon', 'islink', 'title', 'sort']
            )
        );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['name', 'title', 'parent_id', 'sort', 'icon', 'islink']);
        try {
            Cache::tags('BaseAuth')->flush();
            return $this->respondWithSuccess($this->repo->create($input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function show($id)
    {
        try {
            return $this->respondWithSuccess($this->repo->find($id));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param               $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function update(UpdateRequest $request, $id)
    {
        $input = $request->only(['name', 'title', 'parent_id', 'sort', 'icon', 'islink']);
        try {
            Cache::tags('BaseAuth')->flush();
            $rule = $this->repo->find($id);
            return $this->respondWithSuccess($this->repo->update($rule, $input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function destroy($id)
    {
        try {
            $rule = $this->repo->find($id);
            Cache::tags('BaseAuth')->flush();
            return $this->respondWithSuccess($this->repo->delete($rule));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}
