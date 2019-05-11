<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Role\AssignRequest;
use App\Http\Requests\Api\Role\StoreRequest;
use App\Http\Requests\Api\Role\UpdateRequest;
use App\Repositories\Modules\ZdSysRole\Interfaces;
use App\Searchs\Modules\Api\Role\IndexSearch;
use App\Searchs\Modules\Api\Role\SelectSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Cache;

/**
 * Class RoleController
 * @package App\Http\Controllers\Api
 */
class RoleController extends ApiController
{
    
    protected $repo;
    
    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }
    
    /**
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
        $search = new IndexSearch($request->only('name'));
        
        $make = [
            'roleCategorys' => function ($query) {
                $query->select(['name']);
            }
        ];
        
        return $this->respondWithSuccess(
            $this->repo->scope(['hideSuper'])->make($make)->withCount(['users'])->paginate($search->toArray())
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(Request $request){
        $search =new SelectSearch(
            $request->all()
        );

        return $this->respondWithSuccess(
            $this->repo->getWhere($search->toArray(), [
                'id', 'name', 'authority'
            ])
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
        $input = $request->only(['name', 'remark', 'is_admin', 'authority', 'categorys']);
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
            $role = $this->repo->find($id);
            return $this->respondWithSuccess($role);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 城市组织
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function category($id)
    {
        try {
            $role = $this->repo->find($id);
            return $this->respondWithSuccess($role->roleCategorys()->get());
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
        $input = $request->only(['name', 'remark', 'is_admin', 'authority', 'categorys']);
        try {
            $role = $this->repo->find($id);
            return $this->respondWithSuccess($this->repo->update($role, $input));
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
            $role = $this->repo->withCount(['users'])->find($id);
            if ($role->users_count == 0) {
                return $this->respondWithSuccess($this->repo->delete($role));
            }
            else {
                throw new \Exception('角色下还有用户不能删除');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 角色的所有权限
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function permission($id)
    {
        try {
            $role = $this->repo->find($id);
            return $this->respondWithSuccess($role->perms()->get());
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /**
     * 分配权限
     *
     * @param AssignRequest $request
     * @param               $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function assignPermissions(AssignRequest $request, $id)
    {
        $input = $request->input('rule_id');
        try {
            $role = $this->repo->find($id);
            Cache::tags('BaseAuth')->flush();
            return $this->respondWithSuccess($role->perms()->sync($input));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
}
