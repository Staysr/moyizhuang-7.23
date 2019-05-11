<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Api;

use App\Excels\Modules\CarExcel;
use App\Repositories\Modules\ZdCar\Interfaces;
use App\Searchs\Modules\Api\Car\CarSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

/**
 * Class CarController
 *
 * @package App\Http\Controllers\Api
 */
class CarController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 车辆列表
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
        $search = new CarSearch(
            $request->only(
                [
                    'driver_id',
                    'number',
                    'company_id',
                    'created_at',
                ]
            )
        );
        $make = [
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driver' => function($query) {
                $query->select('id', 'name', 'phone');
            }
        ];
        $searchArr = $search->toArray();
        $result = $this->repo->scope(['orderWith'])->make($make)->paginate(
            $searchArr,
            20,
            [
                'driver_id',
                'car_type_id',
                'company_id',
                'number',
                'parts',
                'created_at',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    public function export()
    {
        $make = [
            'carType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'driver' => function($query) {
                $query->select('id', 'name', 'phone');
            }
        ];
        $export = new CarExcel(
            $this->repo->make($make)
        );

        return $export->download("车辆列表.xlsx");
    }

}

