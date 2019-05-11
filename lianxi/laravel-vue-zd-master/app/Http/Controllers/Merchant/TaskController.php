<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Merchant;


use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdTask\Interfaces;
use App\Repositories\Modules\ZdTaskOffer\Interfaces as ZdTaskOfferInterfacces;
use App\Searchs\Modules\Merchant\TaskSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Merchant\Task\IndexRequest;
use App\Http\Requests\Merchant\Task\CreateRequest;
use App\Facades\Util;

/**
 * Class TaskController
 * @package App\Http\Controllers\Merchant
 */
class TaskController extends Controller
{
    /**
     * @var Interfaces|null
     */
    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 列表
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/19 17:03
     */
    public function index(IndexRequest $request)
    {
        $search = new TaskSearch($request->only(['id', 'status']));
        $make = [
            'driver' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number', 'car_type_id']);
            },
            'rescind' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number', 'car_type_id']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title']);
            },
        ];
        $searchArr=$search->toArray();
        if (2 == $request->input(['status'])) { //选到可用司机
            array_push($searchArr,['rescind_id','=',0]);
            array_push($searchArr,['driver_status','=',2]);
        }
        $result =  $this->repo->scope(['SingleMerchant', 'orderWith', 'isDelete'])->make($make)->paginate(
            $searchArr,
            20,
            [
                'id',
                'warehouse_id',
                'driver_id',
                'type',
                'name',
                'status',
                'temp_start_date',
                'estimate_time',
                'arrival_date',
                'choose_driver_end_time',
                'offer_end_time',
                'car_type_ids',
                'driver_status',
                'offer_count',
                'rescind_id',
                'delete_time',
                'arrival_warehouse_time'
            ]
        );
        $resultArr = $result->each(
            function ($item) {
                $item->append(['taskWorkTime']);

                switch ($item->status) {
                    case 0:
                        $item->taskChooseTime = $item->offer_end_time;
                        break;
                    case 1:
                    case 2:
                        $item->taskChooseTime = $item->choose_driver_end_time;
                        break;
                    default:
                        $item->taskChooseTime = null;
                }
                $item->setHidden(
                    ['temp_start_date', 'estimate_time', 'arrival_date', 'choose_driver_end_time', 'offer_end_time']
                );
                if (!empty($item->driver)) {
                    $item->driver->carTypeName = $item->driver->carType->name;
                    $item->driver->setHidden(['carType']);
                }

                if (!empty($item->rescind)) {
                    $item->rescind->carTypeName = $item->rescind->carType->name;
                    $item->rescind->setHidden(['carType']);
                }
            }
        );
        return response()->json(
            [
                'count' => $result->total(),
                'data' => Util::TaskFilter($resultArr->toArray()),
                'message' => '成功',
            ]
        );

    }

    /**
     * 获取司机任务信息
     * @param ZdTaskOfferInterfacces $offer
     * @param                        $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 16:49
     */
    public function driver(ZdTaskOfferInterfacces $offer, $id)
    {

        $info = $this->repo->find($id);
        $infoArray = $info->toArray();
        if ($infoArray['rescind_id'] == 0) {
            $make = [
                'driver' => function ($query) {
                    $query->select(
                        ['id', 'name', 'phone', 'assess_score', 'car_type_id', 'head_img_url', 'car_number']
                    );
                },
                'driverSub' => function ($query) {
                    $query->select(['id', 'driver_id', 'checked_count', 'complete_count']);
                },
            ];
            $offerArr = $offer->findWhere(
                ['task_id' => $id, 'driver_id' => $infoArray['driver_id']],
                ['unit_price', 'remark']
            );
        } else {
            $make = [
                'rescind' => function ($query) {
                    $query->select(
                        ['id', 'name', 'phone', 'assess_score', 'car_type_id', 'head_img_url', 'car_number']
                    );
                },
                'rescindSub' => function ($query) {
                    $query->select(['id', 'driver_id', 'checked_count', 'complete_count']);
                },
            ];
            $offerArr = $offer->findWhere(
                ['task_id' => $id, 'driver_id' => $infoArray['rescind_id']],
                ['unit_price', 'remark']
            );
        }

        $task = $this->repo->make($make)->findWhere(
            ['id' => $id],
            [
                'id',
                'driver_id',
                'type',
                'arrival_date',
                'temp_start_date',
                'estimate_time',
                'rescind_id',
                'driver_status',
                'status',
                'rescind_time',
                'arrival_warehouse_time'
            ]
        );
        if (!empty($task->driver->carType)) {
            $task->driver->carTypeName = $task->driver->carType->name;
            $task->driver->setHidden(['carType']);
        }
        if (!empty($task->rescind->carType)) {
            $task->rescind->carTypeName = $task->rescind->carType->name;
            $task->rescind->setHidden(['carType']);
        }


        $task->append(['driverStatusText', 'taskWorkTime']);
        $task->setHidden(['type', 'temp_start_date', 'estimate_time', 'arrival_date','rescind_id', 'rescind_time']);

        $result = $task->toArray();


        if (empty($result['driver']) && !empty($result['rescind'])) {
            $result['driver'] = $result['rescind'];
        }
        if (empty($result['driver_sub']) && !empty($result['rescind_sub'])) {
            $result['driver_sub'] = $result['rescind_sub'];
        }

        unset($result['rescind']);
        unset($result['rescind_sub']);

        if (!empty($result) && !empty($offerArr)) {
            $offerArrInfo=$offerArr->toArray();
            $result['driver']['unit_price'] = $offerArrInfo['unit_price'];
            $result['driver']['remark'] = null;
        }

        return $this->respondWithSuccess($result);
    }


    /**
     * 获取报价信息
     * @param Request $request
     * @param ZdTaskOfferInterfacces $offer
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/5/29 17:45
     */
    public function offer(ZdTaskOfferInterfacces $offer, $id)
    {
        $make = [
            'task' => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                        'type',
                        'arrival_date',
                        'temp_start_date',
                        'estimate_time',
                        'rescind_id',
                        'status',
                        'driver_status',
                        'arrival_warehouse_time'
                    ]
                );
            },
            'driver' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number', 'car_type_id', 'assess_score', 'head_img_url']);
            },
        ];
        $task = $this->repo->find($id);
        if ($task['rescind_id'] == 0) {
            $driver_id = $task->driver_id;
        } else {
            $driver_id = $task->rescind_id;
        }
        $result = $offer->make($make)->getWhere(
            [
                ['task_id', '=', $id],
                ['driver_id', '=', $driver_id],
                [
                    function ($query) {
                        $query->whereIn('status', [1, 2]);
                    },
                ],
            ],
            ['id', 'task_id', 'driver_id', 'unit_price']
        )->each(
            function ($item) {
                $item->task->append(['taskWorkTime']);
                $item->task->setHidden(['type', 'temp_start_date', 'estimate_time', 'arrival_date']);
                if (!empty($item->driver)) {
                    $item->driver->carTypeName = $item->driver->carType->name;
                    $item->driver->setHidden(['carType']);
                } else {
                    $item->driver->carTypeName = null;
                }
                if (!empty($item->driverSub)) {
                    $item->driver->completeCount = $item->driverSub->complete_count;
                } else {
                    $item->driver->completeCount = 0;
                }
                $item->setHidden(['driverSub']);

            }
        );
        return $this->respondWithSuccess( Util::OfferFilter( $result->toArray()));

    }


    /**
     * 任务详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/1 15:58
     */
    public function detail(Request $request, $id)
    {
        $make = [
            'driver' => function ($query) {
                $query->select(['id', 'name', 'phone', 'car_number']);
            },
            'warehouse' => function ($query) {
                $query->select(['id', 'title']);
            },
            'setting' => function ($query) {
                $query->select(['id', 'task_id', 'type', 'key', 'value']);
            },
            'delivery' => function ($query) {
                $query->select(['id', 'name', 'task_id', 'lng', 'lat', 'contacts', 'contact_way', 'sort']);
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
                'is_fixed_point',
                'unfixed_json',
                'delivery_point_remark',
                'is_back',
                'distance_json',
                'arrival_date',
                'send_time',
                'temp_start_date',
                'temp_end_date',
                'arrival_warehouse_time',
                'estimate_time',
                'total_time',
                'unit_price',
                'price_remark',
                'offer_end_time',
                'choose_driver_end_time',
                'choose_driver_time',
                'carry_type',
                'status',
                'driver_status',
                'work_time',
                'remark',
                'rescind_id',
            ]
        );
        $default = ['carry' => [], 'other' => [], 'supply' => []];
        $result->extra = (object)$result->setting->each(
            function ($item) {
                $item->setHidden(['id', 'task_id']);
            }
        )->groupBy('type')->filter(
            function ($item, $key) {
                if ($key == 'carry' || $key == 'other' || $key == 'supply') {
                    return true;
                }
            }
        );
        if (!empty($result->extra->toArray())) {
            $result->extra = array_merge($default, $result->extra->toArray());
        } else {
            $result->extra = $default;
        }


        $result->taskWorkTimeDate = date("Y-m-d", strtotime($result->taskWorkTime));

        if (!empty($result->delivery)) {
            $result->delivery->each(
                function ($item) {
                    $item->location = $item->lng.','.$item->lat;
                }
            );
        }
        $result->setHidden(['setting']);
        $result->append(['carTypeName']);

        return $this->respondWithSuccess($result);
    }


    public function create(CreateRequest $request)
    {
        if (2 === auth()->user()->status) {
            return $this->respondWithError('你的账户已被冻结，不能发布线路任务，请联系你的岗控经理', 401);
        }
        $time=time();
        $request->merge(['timestamp'=>$time]);
        $post = $request->only(
            [
                'id',
                'type',
                'name',
                'merchant_id',
                'car_type_ids',
                'warehouse_id',
                'is_fixed_point',
                'unfixed_json',
                'delivery_point_remark',
                'is_back',
                'distance_json',
                'arrival_date',
                'send_time',
                'temp_start_date',
                'temp_end_date',
                'arrival_warehouse_time',
                'estimate_time',
                'total_time',
                'safe_id',
                'merchant_safe_id',
                'goods_remark',
                'goods_volume',
                'goods_weight',
                'goods_num',
                'back_bill',
                'unit_price',
                'offer_end_time',
                'choose_driver_end_time',
                'price_remark',
                'is_delivery',
                'carry_type',
                'work_time',
                'remark',
                'delivery_point',
                'carry',
                'receipt',
                'dispatching',
                'supply',
                'welfare',
                'other',
            ]
        );
        DB::transaction(
            function () use ($post,$request,$time) {
                $post=$request->DefaultValue($post,$time);
                $model=$this->repo->create($post);
                // 固定和非固定配送点
                $this->repo->fixedPoint($post, $model->id);
                // 任务配置
                $this->repo->taskSetting($post, $model->id);
                //插入待选列表
                $this->repo->taskChoose($post, $model->id);
                //商户数据回调
                $this->repo->merchantTaskCount($post, auth()->user()->merchant_id);
            }
        );
        return $this->respondWithSuccess([], '创建任务成功');
    }


}