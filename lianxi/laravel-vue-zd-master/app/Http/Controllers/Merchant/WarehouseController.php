<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdWarehouse\Interfaces;
use App\Repositories\Modules\ZdWarehouseContacts\Interfaces as ZdWarehouseContactsInterfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrderInterfaces;
use Illuminate\Http\Request;
use App\Http\Requests\Merchant\Warehouse\StoreRequest;
use App\Http\Requests\Merchant\Warehouse\UpdateRequest;
use Illuminate\Support\Facades\DB;


/**
 * Class WarehouseController
 *
 * @package App\Http\Controllers\Merchant
 */
class WarehouseController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/4/24 12:04
     */
    public function index(Request $request)
    {
        return $this->respondWithSuccess(
            $this->repo->scope(['orderWith', 'SingleMerchant','EnableHouse'])->getWhere(
                [],
                ['id', 'title']
            )
        );
    }


    /**
     * 查看
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/4/24 12:04
     */
    public function show(Request $request, $id)
    {
        $make = [
            'backupContacts' => function ($query) {
                $query->select(['id', 'warehouse_id', 'name', 'phone']);
            },
        ];
        $result = $this->repo->scope(['orderWith', 'SingleMerchant'])->make($make)->findWhere(
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
     * @param StoreRequest                  $request
     * @param ZdWarehouseContactsInterfaces $contact
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 17:51
     */
    public function store(StoreRequest $request)
    {

        $post=$request->only(
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
        );
        $post['merchant_id'] = auth()->user()->merchant_id;
        $post['status'] = 1;
        $this->repo->create($post);

        return $this->respondWithSuccess([], '创建仓库成功');

    }


    /**
     * 更新仓库
     * @param UpdateRequest $request
     * @param ZdWarehouseContactsInterfaces $contact
     * @param ZdTaskOrderInterfaces $order
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/7/6 17:37
     */
    public function update(UpdateRequest $request, ZdWarehouseContactsInterfaces $contact,ZdTaskOrderInterfaces $order, $id)
    {
        $model = $this->repo->withCount(['order'])->find($id);
        if($model->order_count){
            return $this->respondWithError('该仓库已使用过，不可以修改', 401);
        }

        $this->repo->update($model, $request->only(
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
                'backup_contacts'
            ]
        ));

        return $this->respondWithSuccess([], '编辑仓库成功');
    }


}

