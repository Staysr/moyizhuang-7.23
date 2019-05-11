<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Driver\ListsRequest;
use App\Http\Requests\Api\Driver\SelectRequest;
use App\Repositories\Modules\ZdDriver\Interfaces;
use App\Searchs\Modules\Api\Driver\ListsSearch;
use App\Searchs\Modules\Api\Driver\SelectSearch;
use Illuminate\Http\Request;
use App\Searchs\Modules\Api\Driver\FinishSearch;
use App\Http\Controllers\ApiController;
use App\Excels\Modules\DriverExcel;

/**
 * Class DriverController
 *
 * @package App\Http\Controllers\Api
 */
class DriverController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 已审核自营司机
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/30 15:13
     */
    public function index(Request $request)
    {

        $search = new FinishSearch(
            $request->only(
                [
                    'name',
                    'phone',
                    'company_id',
                    'car_number',
                    'assess_score',
                    'type',
                ]
            )
        );
        $make = [
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'supervisor' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driverSub' => function ($query) {
                $query->select(
                    [
                        'driver_id',
                        'complete_count',
                        'work_count',
                        'complaint_count',
                        'b_score_sum',
                        'driver_id',
                    ]
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $searchArr = $search->toArray();
        $result = $this->repo->scope(['orderWith', 'self','RelatedDriver'])->make($make)->paginate(
            $searchArr,
            20,
            [
                'id',
                'name',
                'phone',
                'idcard',
                'category_id',
                'type',
                'company_id',
                'driver_type',
                'supervisor_id',
                'car_number',
                'app_status',
                'status',
                'driver_type',
                'car_type_id',
                'assess_score',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 已审核合作司机
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/30 15:13
     */
    public function work(Request $request)
    {

        $search = new FinishSearch(
            $request->only(
                [
                    'name',
                    'phone',
                    'company_id',
                    'car_number',
                    'assess_score',
                    'type',
                ]
            )
        );
        $make = [
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'supervisor' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driverSub' => function ($query) {
                $query->select(
                    [
                        'driver_id',
                        'complete_count',
                        'work_count',
                        'complaint_count',
                        'b_score_sum',
                    ]
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $searchArr = $search->toArray();
        $result = $this->repo->scope(['orderWith', 'work','RelatedDriver'])->make($make)->paginate(
            $searchArr,
            20,
            [
                'id',
                'name',
                'phone',
                'idcard',
                'category_id',
                'type',
                'company_id',
                'driver_type',
                'supervisor_id',
                'car_number',
                'app_status',
                'status',
                'driver_type',
                'car_type_id',
                'assess_score',
            ]
        );

        return $this->respondWithSuccess($result);
    }

    /**
     *
     * @param SelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(SelectRequest $request)
    {
        $search = new SelectSearch(
            $request->only('name','company_id','car_number','phone')
        );

        $result = $this->repo->scope(['RelatedDriver'])->getWhere($search->toArray(), ['id', 'name', 'phone'])->each(
            function ($item) {
                $item->name = $item->name.'('.$item->phone.')';
            }
        );

        return $this->respondWithSuccess($result);
    }

    /**
     * 查找司机
     * @param ListsRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function lists(ListsRequest $request)
    {
        $search = new ListsSearch(
            $request->all()
        );

        $make = [
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];

        $result = $this->repo->scope(['orderWith', 'OnTheJob','RelatedDriver'])->make($make)
            ->paginate(
                $search->toArray(),
                20,
                [
                    'id',
                    'name',
                    'phone',
                    'category_id',
                    'driver_type',
                    'car_number',
                    'driver_type',
                    'car_type_id',
                    'identity_type',
                ]
            );

        return $this->respondWithSuccess($result);
    }

    /**
     * 已审核社会司机
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/7/30 15:13
     */
    public function social(Request $request)
    {
        $search = new FinishSearch(
            $request->only(
                [
                    'name',
                    'phone',
                    'company_id',
                    'car_number',
                    'assess_score',
                    'type',
                    'extend_id',
                    'app_status',
                    'car_type_id',
                    'is_plat_service_fee',
                    'deposit_status',
                ]
            )
        );
        $make = [
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'supervisor' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driverSub' => function ($query) {
                $query->select(
                    [
                        'driver_id',
                        'complete_count',
                        'work_count',
                        'complaint_count',
                        'b_score_sum',
                    ]
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $searchArr = $search->toArray();
        $result = $this->repo->scope(['orderWith', 'social','RelatedDriver'])->make($make)
            ->paginate(
                $searchArr,
                20,
                [
                    'id',
                    'name',
                    'phone',
                    'idcard',
                    'category_id',
                    'type',
                    'driver_type',
                    'supervisor_id',
                    'car_number',
                    'app_status',
                    'status',
                    'driver_type',
                    'car_type_id',
                    'is_plat_service_fee',
                    'account_price',
                    'deposit_status',
                    'assess_score',
                ]
            );

        return $this->respondWithSuccess($result);
    }


    /**
     * 司机详情
     *
     * @param Request $request
     * @param ZdBackendLogInterfaces $Log
     * @param                        $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/30 16:49
     */
    public function show(Request $request, $id)
    {

        $make = [
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'supervisor' => function ($query) {
                $query->select(['id', 'name']);
            },
            'review' => function ($query) {
                $query->select(
                    ['id', 'type_code', 'value', 'remark', 'create_time', 'driver_id']
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $result = $this->repo->scope(['orderWith', 'Finish'])->make(
            $make
        )->findWhere(
            ['id' => $id],
            [
                'id',
                'name',
                'sex',
                'native_place',
                'phone',
                'idcard',
                'address',
                'job_number',
                'job_date',
                'drive_level',
                'issue_date',
                'entry_time',
                'car_number',
                'app_status',
                'is_work',
                'work_status',
                'create_time',
                'supervisor_id',
                'company_id',
                'car_type_id',
                'category_id',
                'is_big_work',
                'work_status',
            ]
        );

        return $this->respondWithSuccess($result);
    }

    /**
     * 导出
     * @param Request $request
     * @param         $type
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/31 15:10
     */
    public function export(Request $request, $type)
    {
        $request->merge(['export' => $type]);
        $make = [
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category' => function ($query) {
                $query->select(['id', 'name']);
            },
            'supervisor' => function ($query) {
                $query->select(['id', 'name']);
            },
            'review' => function ($query) {
                $query->select(
                    ['id', 'type_code', 'value', 'remark', 'create_time']
                );
            },
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $export = new DriverExcel($this->repo->scope([$type,'RelatedDriver'])->make($make));

        return $export->download("司机列表.xlsx");
    }

}

