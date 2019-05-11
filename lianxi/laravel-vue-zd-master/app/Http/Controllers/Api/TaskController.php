<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Task\CreateRequest;
use App\Http\Requests\Api\Task\ChangeRequest;
use App\Http\Requests\Api\Task\AssignedRequest;
use App\Http\Requests\Api\Task\SelectRequest;
use App\Http\Requests\Api\Task\SimpleRequest;
use App\Http\Requests\Api\Task\StoreRequest;
use App\Http\Requests\Api\Task\SafeRequest;
use App\Jobs\Api\AssignTaskJob;
use App\Repositories\Modules\ZdSms\Interfaces as ZdSmsInterfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrderInterfaces;
use App\Repositories\Modules\ZdOrderDeliveryPoint\Interfaces as ZdOrderDeliveryPointInterfaces;
use App\Repositories\Modules\ZdTaskDeliveryPoint\Interfaces as ZdTaskDeliveryPointInterfaces;
use App\Repositories\Modules\ZdDriver\Interfaces as ZdDriverInterfaces;
use App\Repositories\Modules\ZdTask\Interfaces;
use App\Searchs\Modules\Api\Task\IndexSearch;
use App\Searchs\Modules\Api\Task\SelectSearch;
use App\Services\Api\Task\AbandonService;
use App\Services\Api\Task\ChangeService;
use App\Services\Api\Task\ChooseService;
use App\Services\Api\Task\DeleteService;
use App\Services\Api\Task\RescindService;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;


class TaskController extends ApiController
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
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch(
            $request->only(
                [
                    'merchant_id',
                    'task_id',
                    'name',
                    'warehouse_id',
                    'driver_id',
                    'type',
                    'driver_status',
                    'create_time',
                ]
            )
        );

        $make = [
            'driver' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'car_type_id']
                );
            },
            'driver.carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'rescind' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'car_type_id']
                );
            },
            'rescind.carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
        ];

        $result = $this->repo->scope(['orderWith', 'isDelete','RelatedMerchant'])->make($make)
            ->paginate(
                $search->toArray(),
                20,
                [
                    'id',
                    'warehouse_id',
                    'driver_id',
                    'merchant_id',
                    'merchant_safe_id',
                    'type',
                    'name',
                    'status',
                    'driver_status',
                    'offer_count',
                    'rescind_id',
                    'browse_count',
                    'assign_status',
                    'arrival_date',
                    'temp_start_date',
                    'car_type_ids',
                    'is_show'
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
        $search = new SelectSearch($request->only(['name']));

        return $this->respondWithSuccess(
            $this->repo->limit(
                $search->toArray(),
                10,
                [
                    'id',
                    'name',
                ]
            )
        );
    }

    /**
     * 任务详情
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function show($id)
    {
        $make = [
            'driver' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'car_type_id']
                );
            },
            'driver.carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'rescind' => function ($query) {
                $query->select(
                    ['id', 'name', 'phone', 'car_number', 'car_type_id']
                );
            },
            'rescind.carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'merchantSafe' => function ($query) {
                $query->select(['id', 'safe_fee','is_per']);
            },
            'delivery' => function ($query) {
                $query->select(['id', 'name', 'task_id',  'contacts', 'contact_way', 'sort']);
            },
        ];

        $result = $this->repo->make($make)->findWhere(
            ['id' => $id],
            ['*']
        );
        $default = ['carry' => [], 'other' => [], 'supply' => []];
        $result->extra = (object)$result->setting->each(
            function ($item) {
                $item->setHidden(['id', 'task_id','create_time','modify_time']);
            }
        )->groupBy('type');
        if (!empty($result->extra->toArray())) {
            $result->extra = array_merge($default, $result->extra->toArray());
        } else {
            $result->extra = $default;
        }
        $result->append(['car_type_name']);

        return $this->respondWithSuccess($result);
    }
    
    /**
     * 复制任务信息
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function copy($id)
    {
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'delivery' => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'task_id',
                        'lng',
                        'lat',
                        'contacts',
                        'contact_way',
                        'sort',
                    ]
                );
            },
            'setting'  => function ($query) {
                $query->select(['id', 'task_id', 'type', 'key', 'value']);
            },
        ];
        
        $result = $this->repo->make($make)->findWhere(
            ['id' => $id],
            [
                'id',
                'type',
                'merchant_id',
                'warehouse_id',
                'name',
                'is_fixed_point',
                'unfixed_json',
                'delivery_point_remark',
                'is_back',
                'distance_json',
                'send_time',
                'arrival_date',
                'temp_start_date',
                'temp_end_date',
                'arrival_warehouse_time',
                'estimate_time',
                'car_type_ids',
                'merchant_safe_id',
                'goods_remark',
                'goods_volume',
                'goods_weight',
                'goods_num',
                'back_bill',
                'unit_price',
                'price_remark',
                'is_delivery',
                'offer_end_time',
                'choose_driver_end_time',
                'carry_type',
                'is_show'
            ]
        );
        
        $result->delivery->each(
            function ($item) {
                $item->setHidden(['id', 'task_id', 'sort']);
            }
        );
        
        $default = [
            'receipt'     => [
                'type'      => '',
                'recipient' => '',
                'phone'     => '',
                'address'   => '',
                'express'   => '',
            ],
            'dispatching' => [],
            'carry'       => [
                'textarea'     => '',
                'is_worker'    => 0,
                'is_loading'   => 0,
                'is_unloading' => 0,
            ],
            'other'       => [
                'is_remove_seat'  => 0,
                'is_trolley'      => 0,
                'is_tail_plate'   => 0,
                'is_extinguisher' => 0,
                'is_lock'         => 0,
                'other_require'   => '',
            ],
            'supply'      => [],
            'welfare'     => []
        ];
        $extra   = (object) $result->setting->each(
            function ($item) {
                $item->setHidden(['id', 'task_id']);
                if (is_numeric($item->value))
                    $item->value = (int) $item->value;
            }
        )->groupBy('type');
        $extra   = array_merge($default, $extra->toArray());
        foreach ($extra as $key => $value)
        {
            $k            = array_column($value, 'key');
            $v            = array_column($value, 'value');
            $result->$key = (!$k || !$v) ? $value : array_combine($k, $v);
        }
        
        $hideen  = ['id', 'setting'];
        $hideen1 = $result->type === 1 ? ['temp_start_date', 'temp_end_date'] : ['send_time', 'arrival_date'];
        $hideen2 = $result->is_fixed_point === 1 ? ['unfixed_json'] : ['delivery'];
        $result->setHidden(array_merge($hideen, $hideen1, $hideen2));
        $result = $result->toArray();
        
        $result['car_type_ids'] = array_map('intval', explode(',', $result['car_type_ids']));
        if (isset($result['delivery']))
        {
            $result['delivery_point'] = $result['delivery'];
            unset($result['delivery']);
        }
        
        return $this->respondWithSuccess($result);
    }


    /**
     * 删除任务
     *
     * @param SimpleRequest $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/3 15:36
     */
    public function delete(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $task, $sms) {
                    $service = new DeleteService($request, $task, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '任务删除成功');
    }


    /**
     * 任务作废
     *
     * @param Request $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/14 12:24
     */
    public function abandon(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $task, $sms) {
                    $service = new AbandonService($request, $task, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '任务作废成功');
    }


    /**
     * 全都不选
     *
     * @param SimpleRequest $request
     * @param ZdSmsInterfaces $sms
     * @param                 $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/14 12:24
     */
    public function none(Request $request, ZdSmsInterfaces $sms, $id)
    {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use ($request, $task, $sms) {
                    $service = new AbandonService($request, $task, $sms);
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '任务作废成功');
    }


    /**
     * 选择司机
     *
     * @param StoreRequest $request
     * @param ZdSmsInterfaces $sms
     * @param ZdTaskOrderInterfaces $taskOrder
     * @param ZdTaskDeliveryPointInterfaces $taskDelivery
     * @param ZdOrderDeliveryPointInterfaces $orderDelivery
     * @param ZdDriverInterfaces $newDriver
     * @param                                $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/15 11:24
     */
    public function choose(
        StoreRequest $request,
        ZdSmsInterfaces $sms,
        ZdTaskOrderInterfaces $taskOrder,
        ZdTaskDeliveryPointInterfaces $taskDelivery,
        ZdOrderDeliveryPointInterfaces $orderDelivery,
        ZdDriverInterfaces $newDriver,
        $id
    ) {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use (
                    $request,
                    $task,
                    $sms,
                    $taskOrder,
                    $taskDelivery,
                    $orderDelivery,
                    $newDriver
                ) {
                    $service = new ChooseService(
                        $request,
                        $task,
                        $sms,
                        $taskOrder,
                        $taskDelivery,
                        $orderDelivery,
                        $newDriver
                    );
                    $service->handle(true);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '选择司机成功');
    }


    /**
     * 购买保价
     *
     * @param SafeRequest $request
     * @param             $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/16 11:16
     */
    public function safe(SafeRequest $request, $id)
    {
        $task = $this->repo->find($id);
        if (!in_array($task->status, [0, 1])) {
            return  $this->respondWithError('任务状态必须是司机报价中，选择司机中');
        }
        $task->merchant_safe_id = $request->input('merchant_safe_id');
        $task->save();

        return $this->respondWithSuccess([], '购买保价成功');

    }


    /**
     * 无责任解约
     *
     * @param SimpleRequest $request
     * @param ZdSmsInterfaces $sms
     * @param ZdTaskOrderInterfaces $taskOrder
     * @param ZdOrderDeliveryPointInterfaces $orderDelivery
     * @param                                $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/15 14:31
     */
    public function rescind(
        SimpleRequest $request,
        ZdSmsInterfaces $sms,
        ZdTaskOrderInterfaces $taskOrder,
        ZdOrderDeliveryPointInterfaces $orderDelivery,
        $id
    ) {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use (
                    $request,
                    $task,
                    $sms,
                    $taskOrder,
                    $orderDelivery
                ) {
                    $service = new RescindService(
                        $request,
                        $task,
                        $sms,
                        $taskOrder,
                        $orderDelivery
                    );
                    $service->handle(true);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '无责任解约成功');
    }

    /**
     * 招主/临时司机
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @author aofei
     */
    public function create(CreateRequest $request)
    {
        $time = time();
        $request->merge(['timestamp' => $time]);
        try {
            $input = $request->except(['merchant']);
            DB::transaction(
                function () use ($input, $request, $time) {
                    $input = $request->DefaultValue($input, $time);
                    // 线路任务
                    $task = $this->repo->create($input);
                    // 固定和非固定配送点
                    $this->repo->fixedPoint($input, $task->id);
                    // 任务配置
                    $this->repo->taskSetting($input, $task->id);
                    // 插入待选列表
                    $this->repo->taskChoose($input, $task->id);
                    // 商户数据回调
                    $this->repo->merchantTaskCount($input, $input['merchant_id']);
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '创建任务成功');
    }


    /**
     * 指派司机
     *
     * @param AssignedRequest $request
     * @param                                $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/16 14:11
     */
    public function assigned(
        AssignedRequest $request,
        $id
    ) {
        $task = $this->repo->with(['setting', 'delivery'])->find($id);
        // 验证冲突
        $request->isConflict($task);

        $this->dispatch(new AssignTaskJob($task, $request->only(['drivers', 'unit_price'])));

        return $this->respondWithSuccess([], '指派司机成功');
    }


    /**
     * 修改司机
     *
     * @param ChangeRequest $request
     * @param ZdSmsInterfaces $sms
     * @param ZdTaskOrderInterfaces $taskOrder
     * @param ZdTaskDeliveryPointInterfaces $taskDelivery
     * @param ZdOrderDeliveryPointInterfaces $orderDelivery
     * @param ZdDriverInterfaces $newDriver
     * @param                                $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/16 14:11
     */
    public function change(
        ChangeRequest $request,
        ZdSmsInterfaces $sms,
        ZdTaskOrderInterfaces $taskOrder,
        ZdTaskDeliveryPointInterfaces $taskDelivery,
        ZdOrderDeliveryPointInterfaces $orderDelivery,
        ZdDriverInterfaces $newDriver,
        $id
    ) {
        $task = $this->repo->find($id);
        try {
            DB::transaction(
                function () use (
                    $request,
                    $task,
                    $sms,
                    $taskOrder,
                    $taskDelivery,
                    $orderDelivery,
                    $newDriver
                ) {
                    $service = new ChangeService(
                        $request,
                        $task,
                        $sms,
                        $taskOrder,
                        $taskDelivery,
                        $orderDelivery,
                        $newDriver
                    );
                    $service->handle();
                }
            );
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithSuccess([], '修改司机成功');
    }



    /**
     * 切换任务显示
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/21 11:57
     */
    public function toggle(Request $request, $id)
    {
        $task = $this->repo->find($id);
        $task->is_show = $task->is_show == 1 ? 0 : 1;
        $task->save();

        return $this->respondWithSuccess([], '切换任务显示成功');
    }


    /**
     * 任务报价
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/21 14:14
     */
    public function offer(Request $request, $id)
    {
        $make = [
            'offer' => function ($query) {
                $query->select(
                    [
                        'id',
                        'driver_id',
                        'task_id',
                        'unit_price',
                        'percentage',
                        'remark',
                        'status',
                        'create_time',
                    ]
                );
            },
            'offer.driver' => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'phone',
                        'car_number',
                        'car_type_id',
                        'assess_score',
                        'head_img_url',
                    ]
                );
            },
            'offer.driver.driverSub' => function ($query) {
                $query->select(
                    ['id', 'driver_id', 'complete_count']
                );
            },
            'offer.driver.carType' => function ($query) {
                $query->select(
                    ['id', 'name']
                );
            },
        ];
        $result = $this->repo->make($make)->findWhere(
            ['id' => $id],
            [
                'id',
                'type',
                'name',
                'merchant_id',
                'car_type_ids',
                'warehouse_id',
                'driver_id',
                'arrival_date',
                'send_time',
                'temp_start_date',
                'temp_end_date',
                'arrival_warehouse_time',
                'estimate_time',
                'total_time',
                'offer_end_time',
                'choose_driver_end_time',
                'choose_driver_time',
                'status',
                'driver_status',
                'work_time',
                'generated',
                'create_er',
                'rescind_id',
                'rescind_time',
                'delete_time',
                'is_show',
                'remark',
                'create_time',
            ]
        );
        $result->append(['car_type_name']);

        return $this->respondWithSuccess($result);
    }


    /**
     * 被选中的司机报价
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/21 15:28
     */
    public function driver(Request $request, $id)
    {

        $make = [
            'offer' => function ($query) {
                $query->select(
                    [
                        'id',
                        'driver_id',
                        'task_id',
                        'unit_price',
                        'percentage',
                        'remark',
                        'status',
                        'create_time',
                    ]
                );
            },
            'offer.driver' => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'phone',
                        'car_number',
                        'car_type_id',
                        'assess_score',
                        'head_img_url',
                    ]
                );
            },
            'offer.driver.driverSub' => function ($query) {
                $query->select(
                    ['id', 'driver_id', 'complete_count']
                );
            },
            'offer.driver.carType' => function ($query) {
                $query->select(
                    ['id', 'name']
                );
            },
        ];
        $result = $this->repo->make($make)->findWhere(
            ['id' => $id],
            [
                'id',
                'type',
                'name',
                'merchant_id',
                'car_type_ids',
                'warehouse_id',
                'driver_id',
                'arrival_date',
                'send_time',
                'temp_start_date',
                'temp_end_date',
                'arrival_warehouse_time',
                'estimate_time',
                'total_time',
                'offer_end_time',
                'choose_driver_end_time',
                'choose_driver_time',
                'status',
                'driver_status',
                'work_time',
                'generated',
                'create_er',
                'rescind_id',
                'rescind_time',
                'delete_time',
                'is_show',
                'remark',
            ]
        );
        $result->append(['carTypeName']);
        $result->offer->first(
            function ($item) use ($result) {
                return $item->dirver_id == $result->dirver_id;
            }
        );

        return $this->respondWithSuccess($result);
    }


}
