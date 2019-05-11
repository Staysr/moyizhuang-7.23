<?php

namespace App\Http\Controllers\Operate;

use App\Http\Requests\Operate\Statistics\IndexRequest;
use App\Plugins\Statistics\DriverInfo;
use App\Searchs\Modules\Operate\Statistics\IndexSearch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Modules\StatisticsDriver\Interfaces;


class StatisticsController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 查询统计数据
     * @method index
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(IndexRequest $request)
    {
        $data = [];
        $only = $request->only(['start_date', 'end_date', 'driver_id', 'type']);
        $driverInfo = (new DriverInfo())->setSupervisorId($only['driver_id'])->setDate($only['start_date']);

        if ($driverInfo->isNowData()) {
            $lists = $driverInfo->merge();
        } else {
            $search = new IndexSearch($only);
            $lists = $this->repo->total($search);
        }
        $response = [];

        $data['task_order_number'] = $lists->where('task_order_total', '>', 0)->count();
        $data['order_number'] = $lists->where('order_complete_total', '>', 0)->count();
        $data['number'] = $lists->count();
        $data['task_order_fee'] = $lists->sum('task_order_fee');
        $data['task_order_total'] = $lists->sum('task_order_total');
        $data['order_cancel_total'] = $lists->sum('order_cancel_total');
        $data['order_complete_total'] = $lists->sum('order_complete_total');
        $data['order_complete_fee'] = $lists->sum('order_complete_fee');

        if($only['type'] == 2){
            $response['small_lists'] = $lists->where('driver_type', '=', 1)->values();
        }

        $response['lists'] = $lists;
        $response['data'] = $data;
        return $this->respondWithSuccess($response);
    }

    /**
     * 是否查询实时数据
     * @method isNowDate
     * @param Request $request
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    protected function isNowDate(Request $request)
    {
        $date = Carbon::parse($request->input('start_date'));

        return $date->isToday() || $date->isYesterday();
    }
}
