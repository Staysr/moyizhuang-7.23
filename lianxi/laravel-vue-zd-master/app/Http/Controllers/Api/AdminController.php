<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Admin\SelectRequest;
use App\Http\Requests\Api\Admin\StoreRequest;
use App\Http\Requests\Api\Admin\UpdateRequest;
use App\Repositories\Modules\ZdSysUser\Interfaces;
use App\Searchs\Modules\Api\Admin\IndexSearch;
use App\Searchs\Modules\Api\Admin\SelectSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AdminController extends ApiController
{
    
    protected $repo;
    
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     *
     * 列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch($request->only(['phone', 'name']));
        
        $make = [
            'roles' => function ($query) {
                $query->select(['id', 'name', 'is_admin']);
            }
        ];
        
        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(
                $search->toArray(),
                20,
                ['id', 'phone', 'status', 'role', 'name', 'authority_level']
            )
        );
    }

    /**
     * @param SelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(SelectRequest $request){
        $search = new SelectSearch($request->only([
            'authority_level',
            'name'
        ]));

        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'name', 'authority_level']
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
            [
                'phone',
                'password',
                'role',
                'manager',
                'name',
                'sex',
                'authority_level',
                'job_number',
                'contact',
                'birthday',
                'status'
            ]
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
        try {
            return $this->respondWithSuccess($this->repo->find($id));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param               $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function update(UpdateRequest $request, $id)
    {
        $input = $request->only(
            [
                'phone',
                'password',
                'role',
                'manager',
                'name',
                'sex',
                'authority_level',
                'job_number',
                'contact',
                'birthday',
                'status'
            ]
        );
        try {
            $user = $this->repo->find($id);
            if ($input['password'] == null || trim($input['password']) == '') {
                unset($input['password']);
            }
            return $this->respondWithSuccess($this->repo->update($user, $input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 删除
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function destroy($id)
    {
        try {
            $role = $this->repo->find($id);
            return $this->respondWithSuccess($this->repo->delete($role));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
}
