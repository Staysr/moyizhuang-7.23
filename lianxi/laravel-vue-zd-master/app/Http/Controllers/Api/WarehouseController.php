<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Api;

use App\Excels\Modules\WarehouseExcel;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Warehouse\SelectRequest;
use App\Repositories\Modules\ZdWarehouse\Interfaces;
use App\Repositories\Modules\ZdWarehouseContacts\Interfaces as ZdWarehouseContactsInterfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrderInterfaces;
use App\Searchs\Modules\Api\Warehouse\SelectSearch;
use App\Searchs\Modules\Api\Warehouse\WarehouseSearch;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Warehouse\StoreRequest;
use App\Http\Requests\Api\Warehouse\UpdateRequest;


/**
 * Class WarehouseController
 *
 * @package App\Http\Controllers\Api
 */
class WarehouseController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 列表
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/8 9:42
     */
    public function index(Request $request)
    {

        $search = new WarehouseSearch(
            $request->only(
                [
                    'merchant_id',
                    'id',
                    'title',
                    'status',
                    'category_position',
                    'create_time',
                ]
            )
        );

        $result = $this->repo->withCount('order')->scope(['orderWith','RelatedMerchant'])->with(['merchant:id,short_name'])->paginate(
            $search->toArray(),
            20,
            [
                'id',
                'merchant_id',
                'title',
                'address',
                'contacts',
                'contacts_phone',
                'status',
                'create_time',
            ]
        );

        return $this->respondWithSuccess($result);
    }

    /**
     * @param SelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(SelectRequest $request)
    {
        $search = new SelectSearch(
            $request->only(['title', 'merchant_id'])
        );

        return $this->respondWithSuccess(
            $this->repo->limit($search->toArray(), 10, ['id', 'title as name'])
        );
    }

    /**
     * 列表
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/4/24 12:04
     */
    public function search(Request $request)
    {
        return $this->respondWithSuccess(
            $this->repo->scope(['orderWith'])->getWhere(
                [],
                ['id', 'title']
            )
        );
    }


    /**
     * 查看
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/4/24 12:04
     */
    public function show(Request $request, $id)
    {
        $make = [
            'backupContacts' => function ($query) {
                $query->select(['id', 'warehouse_id', 'name', 'phone']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
        ];
        $result = $this->repo->scope(['orderWith'])->make(
            $make
        )->findWhere(
            ['id' => $id, 'status' => 1],
            [
                'id',
                'merchant_id',
                'title',
                'category_zone',
                'contacts',
                'contacts_phone',
                'address',
                'description',
                'instruction',
                'longitude',
                'latitude',
                'remark',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 新增
     *
     * @param StoreRequest $request
     * @param ZdWarehouseContactsInterfaces $contact
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 17:51
     */
    public function store(
        StoreRequest $request
    ) {

        $model = $this->repo->create(
            $request->only(
                [
                    'title',
                    'category_zone',
                    'contacts',
                    'contacts_phone',
                    'address',
                    'description',
                    'instruction',
                    'longitude',
                    'latitude',
                    'remark',
                    'merchant_id',
                    'backup_contacts',
                ]
            )
        );

        return $this->respondWithSuccess($model, '创建仓库成功');

    }


    /**
     * 更新仓库
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        UpdateRequest $request,
        $id
    ) {
        $model = $this->repo->withCount(['order'])->find($id);
        if ($model->order_count) {
            return $this->respondWithError('该仓库已使用过，不可以修改', 401);
        }

        $this->repo->update(
            $model,
            $request->only(
                [
                    'title',
                    'category_zone',
                    'contacts',
                    'contacts_phone',
                    'address',
                    'description',
                    'instruction',
                    'car_type_id',
                    'longitude',
                    'latitude',
                    'remark',
                    'backup_contacts',
                    'merchant_id',
                ]
            )
        );

        return $this->respondWithSuccess($model, '编辑仓库成功');
    }


    /**
     * 切换仓库状态
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/30 11:34
     */
    public function toggle($id)
    {
        $model = $this->repo->find($id);
        $status = ($model->status == 1) ? 0 : 1;
        $this->repo->update($model, ['status' => $status]);

        return $this->respondWithSuccess([], '切换仓库状态成功');
    }


    /**
     * 删除
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei@mysmallstove.com
     */
    public function destroy($id)
    {
        $model = $this->repo->withCount(['order'])->find($id);
        if ($model->order_count > 0) {
            return $this->respondWithError('该仓库已被使用');
        } else {
            $this->repo->delete($model);
        }

        return $this->respondWithSuccess([], '删除仓库成功');
    }


    /**
     * 导出
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/8 9:28
     */
    public function export()
    {
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
        ];
        $export = new WarehouseExcel($this->repo->scope(['RelatedMerchant'])->make($make));

        return $export->download("仓库列表.xlsx");
    }


}

