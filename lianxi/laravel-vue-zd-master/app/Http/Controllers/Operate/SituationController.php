<?php
/**
 * zdapp
 * SituationController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Operate\Situation\IndexRequest;
use App\Http\Requests\Operate\Situation\TaskRequest;
use App\Repositories\Modules\ZdDriver\Interfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrder;
use App\Searchs\Modules\Operate\Situation\IndexSearch;
use App\Searchs\Modules\Operate\Situation\TaskSearch;

class SituationController extends ApiController {
    protected $repo;

    public function __construct(Interfaces $repo) {
        $this->repo = $repo;
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(IndexRequest $request) {
        $search = new IndexSearch($request->all());
        return $this->respondWithSuccess(
            $this->repo->scope(['OnTheJob'])->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'phone', 'car_number', 'is_work', 'is_big_work', 'work_status', 'last_end_work', 'total_work_time', 'work_date']
            )
        );
    }

    /**
     * @param TaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function task(TaskRequest $request) {
        $taskOrder = app(ZdTaskOrder::class);
        $search    = new TaskSearch($request->all());

        $make = ['driver' => function ($query) {
            $query->select(['id', 'name', 'supervisor_id'])->with(['supervisor' => function ($query) {
                $query->select(['id', 'name']);
            }]);
        }, 'merchant' => function ($query) {
            $query->select(['id', 'short_name']);
        }];

        return $this->respondWithSuccess(
            $taskOrder->make($make)->paginate(
                $search->toArray(),
                20,
                ['id', 'arrival_warehouse_time', 'merchant_id', 'driver_id', 'status']
            )
        );
    }

}