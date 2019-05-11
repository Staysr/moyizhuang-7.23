<?php
/**
 * Created by PhpStorm.
 * User: blake.Song
 * Date: 2018/8/20
 * Time: 16:46
 */

namespace App\Http\Controllers\Api;


use App\Excels\Modules\LineExcel;
use App\Excels\Modules\PointExcel;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Point\IndexRequest;
use App\Model\ZdPointTime;
use App\Repositories\Modules\ZdPoint\Interfaces;
use App\Repositories\Modules\ZdPointTime\Interfaces as TimeInterfaces;
use App\Searchs\Modules\Api\Point\tasklineSearch;
use Illuminate\Http\Request;

class PointController extends ApiController
{
    /**
     * @var $repo Interfaces
     */
    protected $repo;

    /**
     * @var $time TimeInterfaces
     */
    protected $time;

    public function __construct(Interfaces $repo, TimeInterfaces $time)
    {
        $this->repo = $repo;
        $this->time = $time;
    }

    public function index($id)
    {
        $make = [
            'pointTime' => function ($query) {
                /* @var $query ZdPointTime */
                $query->select(['id', 'warehouse_id', 'arrival_warehouse_day', 'arrival_warehouse_time']);
            },
            'pointTime.warehouse' => function ($query) {
                $query->select(['id', 'merchant_id', 'title']);
            },
            'pointTime.warehouse.merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'linePoint' => function ($query) {
                $query->select(['id', 'line_id', 'point_id']);
            }
        ];

        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(['point_time_id' => $id])
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithSuccess(
            $this->repo->find($id)
        );
    }

    /**
     * 修改定位地点
     * @param IndexRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(IndexRequest $request, $id)
    {
        $request->replace(
            array_merge(
                $request->all(),
                [
                    'name' => $request->input('fixed_name')
                ]
            )
        );

        $result = $this->repo->update(
            $this->repo->find($id),
            $request->only(['fixed_name', 'lng', 'lat', 'name'])
        );

        if ($result === FALSE) {
            return $this->respondWithError('更新失败');
        }

        return $this->respondWithSuccess([], '更新成功');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        return $this->respondWithSuccess(
            $this->repo->delete(
                $this->repo->find($id)
            )
        );
    }

    /**
     * 配送点导出
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request, $id)
    {
        $request->merge(['point_time_id' => $id]);
        $make = [
            'pointTime' => function ($query) {
                /* @var $query ZdPointTime */
                $query->select(['id', 'warehouse_id', 'arrival_warehouse_day', 'arrival_warehouse_time']);
            },
            'pointTime.warehouse' => function ($query) {
                $query->select(['id', 'merchant_id', 'title']);
            },
            'pointTime.warehouse.merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'linePoint' => function ($query) {
                $query->select(['id', 'line_id', 'point_id']);
            }
        ];
        $excel = new PointExcel($this->repo->make($make));

        return $excel->download('配送点列表.xls');
    }

    /**
     * 全部路线列表
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function line($id)
    {
        $make = [
            'pointTime' => function ($query) {
                /* @var $query ZdPointTime */
                $query->select(['id', 'warehouse_id', 'arrival_warehouse_day', 'arrival_warehouse_time']);
            },
            'pointTime.warehouse' => function ($query) {
                $query->select(['id', 'merchant_id', 'title', 'longitude', 'latitude']);
            },
            'pointTime.warehouse.merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'linePoint' => function ($query) {
                $query->select(['id', 'line_id', 'point_id', 'sort']);
            },
            'linePoint.line' => function ($query) {
                $query->select(['id', 'title']);
            }
        ];

        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(['point_time_id' => $id], 500)
        );
    }
    
    /**
     * 发布线路任务-导入配送点-线路列表
     *
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function taskline(Request $request, $id)
    {
        $search = new tasklineSearch($request->only('arrival_time'));
        
        return $this->respondWithSuccess(
            $this->time->scope(['line', 'orderWith'])->paginate(
                array_merge($search->toArray(), ['warehouse_id' => $id]),
                15,
                [
                    'zd_line.id',
                    'warehouse_id',
                    'point_time_id',
                    'title',
                    'arrival_warehouse_day',
                    'arrival_warehouse_time'
                ]
            )
        );
    }
    
    /**
     * 发布线路任务-导入配送点-线路列表-配送点列表
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tasklinepoint($id)
    {
        return $this->respondWithSuccess(
            $this->repo->scope(['linePoint', 'orderWith'])->getWhere(
                ['status' => 1, 'line_id' => $id],
                [
                    'zd_point.id',
                    'point_time_id',
                    'fixed_name',
                    'area',
                    'lng',
                    'lat',
                    'contacts',
                    'contact_way',
                    'status',
                    'line_id',
                    'point_id',
                    'sort'
                ]
            )
        );
    }

    /**
     * 线路导出
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, $id)
    {
        $request->merge(['point_time_id' => $id]);
        $make = [
            'pointTime' => function ($query) {
                /* @var $query ZdPointTime */
                $query->select(['id', 'warehouse_id', 'arrival_warehouse_day', 'arrival_warehouse_time']);
            },
            'pointTime.warehouse' => function ($query) {
                $query->select(['id', 'merchant_id', 'title', 'longitude', 'latitude']);
            },
            'pointTime.warehouse.merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'linePoint' => function ($query) {
                $query->select(['id', 'line_id', 'point_id', 'sort']);
            },
            'linePoint.line' => function ($query) {
                $query->select(['id', 'title']);
            }
        ];

        $excel = new LineExcel($this->repo->make($make));

        return $excel->download('线路列表.xls');
    }

}