<?php

namespace App\Http\Controllers\Api;

use App\Excels\Modules\OrderExcel;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Order\ChangeRequest;
use App\Http\Requests\Api\Point\StoreRequest;
use App\Repositories\Modules\ZdTaskOrder\Interfaces;
use App\Repositories\Modules\ZdSms\Interfaces as ZdSmsInterfaces;
use App\Repositories\Modules\ZdOrderDeliveryPoint\Interfaces as ZdOrderDeliveryPointInterface;
use App\Searchs\Modules\Api\Order\OrderSearch;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Searchs\Modules\Api\Order\SelectSearch;
use App\Services\Api\Order\AgentService;
use App\Services\Api\Order\ChangeService;
use App\Services\Api\Order\FinishService;
use App\Services\Api\Order\InfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Api\Order\UndoService;
use App\Services\Api\Order\DispatchService;
use App\Services\Api\Order\CancelService;


/**
 * Class OrderController
 *
 * @package App\Http\Controllers\Api
 */
class OrderController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 查询订单
     *
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 16:44
     */
    public function index(IndexRequest $request)
    {
        $search = new OrderSearch(
            $request->only(
                [
                    'merchant_id',
                    'order_no',
                    'task_id',
                    'warehouse_id',
                    'name',
                    'driver_id',
                    'arrival_warehouse_time',
                    'exception_count',
                    'is_agent',
                    'is_one_step_finish',
                    'is_reassigned',
                    'status',
                ]
            )
        );
        $make = [
            'merchant' => function ($query) {
                $query->select(['zd_merchant.id', 'short_name']);
            },
            'task' => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'car_type_ids', 'is_fixed_point']
                );
            },
            'warehouse' => function ($query) {
                $query->select(
                    [
                        'zd_warehouse.id',
                        'title',
                        'address',
                        'contacts',
                        'contacts_phone',
                        'longitude',
                        'latitude',
                    ]
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driver' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'supervisor_id']
                );
            },
            'driver.supervisor' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number']
                );
            },
        ];
        $result = $this->repo->scope(['OrderWith','RelatedMerchant'])->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'zd_task_order.id',
                'order_no',
                'merchant_id',
                'task_id',
                'zd_task_order.name',
                'warehouse_id',
                'zd_task_order.driver_id',
                'zd_task_order.car_type_id',
                'unit_price',
                'merchant_safe_fee',
                'total_fee',
                'manage_fee',
                'arrival_warehouse_time',
                'punch_time',
                'leaves_warehouse_time',
                'finish_time',
                'zd_task_order.status',
                'point_count',
                'zd_task_order.create_time',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 查询
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/9/5 10:05
     */
    public function select(Request $request)
    {
        $search = new SelectSearch(
            $request->only('id')
        );
        $result = $this->repo->getWhere($search->toArray(), ['id', 'order_no as name']);
        return $this->respondWithSuccess($result);
    }


    /**
     * 设置不配送
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/3 15:36
     */
    public function undo(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new UndoService($request, $order, $sms);
                    $service->handle(true);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '设置不配送成功');

    }


    /**
     * 设置配送
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @author Mark
     * @date   2018/8/3 17:29
     */
    public function sent(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new DispatchService($request, $order, $sms);
                    $service->handle(true);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '设置配送成功');
    }

    /**
     * 运营取消
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @author Mark
     * @date   2018/8/3 17:29
     */
    public function cancel(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new CancelService($request, $order, $sms);
                    $service->handle(true);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '运营取消成功');
    }


    /**
     * 代签到
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @author Mark
     * @date   2018/8/3 17:29
     */
    public function agent(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new AgentService($request, $order, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '代签到成功');
    }


    /**
     * 一键完成
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @author Mark
     * @date   2018/8/3 17:29
     */
    public function finish(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new FinishService($request, $order, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '代签到成功');
    }


    /**
     * 到仓时间或价格变更
     *
     * @param ChangeRequest $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @author Mark
     * @date   2018/8/3 17:29
     */
    public function change(ChangeRequest $request, ZdSmsInterfaces $sms, $id)
    {
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new ChangeService($request, $order, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '修改到仓时间或价格变更成功');
    }


    /**
     * 详细
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/7 12:06
     */
    public function show($id)
    {
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'task' => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'car_type_ids', 'is_fixed_point']
                );
            },
            'warehouse' => function ($query) {
                $query->select(
                    [
                        'id',
                        'title',
                        'address',
                        'contacts',
                        'contacts_phone',
                        'longitude',
                        'latitude',
                        'remark',
                    ]
                );
            },
            'driver' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'driver_type', 'car_type_id','head_img_url']
                );
            },
            'driver.carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'delivery',
        ];
        $result = $this->repo->make($make)->find($id);

        return $this->respondWithSuccess($result);
    }


    /**
     * 添加配送点
     * @param StoreRequest                  $request
     * @param ZdOrderDeliveryPointInterface $orderDelivery
     * @param                               $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/9/5 15:24
     */
    public function point(
        StoreRequest $request,
        ZdOrderDeliveryPointInterface $orderDelivery,
        $id
    ) {
        $order=$this->repo->find($id);
        if($order->status!=0){
            return $this->respondWithError('出车单只有在未签到状态才能修改配送点');
        }
        $post = $request->only(
            ['name', 'lng', 'lat', 'contacts', 'contact_way']
        );
        $post['order_id']=$id;
        $orderDelivery->create($post);
        return $this->respondWithSuccess([],'增加配送点成功');
    }


    /**
     * 删除配送点
     * @param ZdOrderDeliveryPointInterface $orderDelivery
     * @param                               $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/24 13:52
     */
    public function delete(ZdOrderDeliveryPointInterface $orderDelivery,$id){
        $model=$orderDelivery->find($id);
        if($model->order->status!=0){
            return $this->respondWithError('出车单只有在未签到状态才能修改配送点');
        }
        $orderDelivery->delete($model->getModel());
        return $this->respondWithSuccess([],'删除配送点成功');
    }


    /**
     * 通知司机
     * @param Request         $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/25 10:34
     */
    public function notify(Request $request, ZdSmsInterfaces $sms, $id){
        $order = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $order, $sms) {
                    $service = new InfoService($request, $order, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '修改配送点通知司机成功');

    }


    /**
     * 导出
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/7 15:11
     */
    public function export()
    {
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'task' => function ($query) {
                $query->select(
                    ['id', 'name', 'type', 'car_type_ids', 'is_fixed_point']
                );
            },
            'warehouse' => function ($query) {
                $query->select(
                    [
                        'id',
                        'title',
                        'address',
                        'contacts',
                        'contacts_phone',
                        'longitude',
                        'latitude',
                    ]
                );
            },
            'driver' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'supervisor_id']
                );
            },
            'driver.supervisor' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number']
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $export = new OrderExcel($this->repo->scope(['RelatedMerchant'])->make($make));

        return $export->download("出车单.xlsx");
    }




}
