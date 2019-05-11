<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdTaskOrder\Interfaces;
use App\Repositories\Modules\ZdOrderDeliveryPoint\Interfaces as ZdOrderDeliveryPointInterfaces;
use App\Searchs\Modules\Merchant\OrderSearch;
use App\Http\Requests\Merchant\Order\IndexRequest;

/**
 * Class OrderController
 * @package App\Http\Controllers\Merchant
 */
class OrderController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 查询订单
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:44
     */
    public function index(indexRequest $request)
    {
        $search = new OrderSearch($request->only(['arrival_warehouse_time', 'status', 'type', 'id']));
        $type = $request->input('type');
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'task' => function ($query) use ($type) {
                $query->select(['id', 'name', 'type', 'car_type_ids', 'is_fixed_point']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title', 'address', 'contacts', 'contacts_phone', 'longitude', 'latitude']);
            },
            'driver' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number', 'head_img_url']);
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'position' => function ($query) {
                $query->select(['id', 'address','lng','lat','createTime']);
            },
            'delivery' => function ($query) {
                $query->select(
                    [
                        'id',
                        'order_id',
                        'name',
                        'lng',
                        'lat',
                        'order_id',
                        'is_fixed_point',
                        'put_lng',
                        'put_lat',
                        'contacts',
                        'contact_way',
                        'sort',
                        'status',
                        'finish_time',
                        'reason',
                        'img_one',
                        'img_two',
                        'img_three',
                    ]
                );
            },
        ];
        $temp = $this->repo->scope(['SingleMerchant'])->make($make)->getWhere(
            $search->toArray(),
            [
                'id',
                'order_no',
                'merchant_id',
                'task_id',
                'name',
                'warehouse_id',
                'driver_id',
                'car_type_id',
                'unit_price',
                'merchant_safe_fee',
                'total_fee',
                'manage_fee',
                'arrival_warehouse_time',
                'punch_time',
                'leaves_warehouse_time',
                'finish_time',
                'status',
                'point_count',
                'create_time',
            ]
        )->filter(function ($item) use ($type){
            if(!empty($type)){
                return $item->task->type ==$type;
            }else{
                return true;
            }
        })->each(
            function ($item) {
                $is_fixed_point = $item->task->is_fixed_point;
                $item->task->append(['carTypeName']);
                $item->append(['shortArrivalWarehouseTime']);
                $item->delivery->each(
                    function ($value) use ($is_fixed_point) {
                        if ($is_fixed_point == 0) {
                            $value->lng = $value->put_lng;
                            $value->lat = $value->put_lat;
                        }
                        $value->setHidden(['is_fixed_point', 'put_lng', 'put_lat']);
                    }
                );
                if ($is_fixed_point == 0) {
                    $item->delivery->sortByDesc('finish_time');
                }
            }
        );

        if($request->input('sort')=='asc'){
            $result= $temp->sortBy('arrival_warehouse_time')->values()->toArray();
        }else{
            $result= $temp->sortByDesc('arrival_warehouse_time')->values()->toArray();
        }

        foreach ($result as $index => $item) {
            if (in_array($item['status'], [3, 4, 5, 6])|| strtotime($item['arrival_warehouse_time']) > time() + 3600) {
                $result[$index]['position'] = null;
            }
        }
        return $this->respondWithSuccess($result);
    }


    /**
     * 配送点信息
     * @param ZdOrderDeliveryPointInterfaces $orderDelivery
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/5/29 16:10
     */
    public function delivery(ZdOrderDeliveryPointInterfaces $orderDelivery, $id)
    {
        $delivery = $orderDelivery->findWhere(
            ['id' => $id],
            [
                'id',
                'task_id',
                'order_id',
                'name',
                'lng',
                'lat',
                'contacts',
                'contact_way',
                'sort',
                'is_fixed_point',
                'status',
                'put_address',
                'put_lng',
                'put_lat',
                'finish_time',
                'reason',
            ]
        );

        return $this->respondWithSuccess($delivery);
    }


}
