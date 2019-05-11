<?php

namespace App\Http\Controllers\Api;

use App\Excels\Modules\AwardExcel;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Award\StoreRequest;
use App\Http\Requests\Api\Award\UpdateRequest;
use App\Repositories\Modules\ZdDriverReward\Interfaces as Interfaces;
use App\Searchs\Modules\Api\Award\AwardSearch;
use Illuminate\Http\Request;

class AwardController extends ApiController
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 列表
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/23 11:37
     */
    public function index(Request $request)
    {
        $search = new AwardSearch(
            $request->only(
                [
                    'driver_id',
                    'merchant_id',
                    'type',
                    'create_time',
                ]
            )
        );
        $make = [
            'driver'   => function ($query) {
                $query->select(['id', 'name', 'phone']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'order'    => function ($query) {
                $query->select(
                    [
                        'id',
                        'order_no',
                    ]
                );
            },
            'user'     => function ($query) {
                $query->select(
                    [
                        'id',
                        'name',
                    ]
                );
            },
        ];
        $result = $this->repo->make($make)->paginate(
            $search->toArray(),
            20,
            [
                'id',
                'reward_no',
                'driver_id',
                'merchant_id',
                'order_id',
                'type',
                'fee',
                'reason',
                'user_id',
                'create_time',
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 新增
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 17:51
     */
    public function store(
        StoreRequest $request
    ) {
        $award = $this->repo->create(
            $request->only(
                [
                    'merchant_id',
                    'order_id',
                    'type',
                    'fee',
                    'reason',
                ]
            )
        );

        return $this->respondWithSuccess($award, '创建奖惩成功');

    }


    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param               $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        UpdateRequest $request,
        $id
    ) {
        $award = $this->repo->find($id);
        $this->repo->update(
            $award,
            $request->only(
                [
                    'type',
                    'fee',
                    'reason',
                ]
            )
        );

        return $this->respondWithSuccess($award, '编辑司机奖惩成功');
    }


    /**
     * 显示
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/9/4 14:49
     */
    public function show($id)
    {
        $make = [
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
        ];
        $award = $this->repo->make($make)->find($id);

        return $this->respondWithSuccess($award, '编辑司机奖惩成功');
    }


    /**
     * 删除
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/23 12:12
     */
    public function destroy($id)
    {
        $model = $this->repo->find($id);
        $this->repo->delete($model);

        return $this->respondWithSuccess([], '删除司机奖惩成功');
    }


    /**
     * 导出
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/8 14:10
     */
    public function export()
    {
        $make = [
            'driver'   => function ($query) {
                $query->select(['id', 'name', 'phone']);
            },
            'merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            },
            'order'    => function ($query) {
                $query->select(
                    [
                        'id',
                        'order_no',
                    ]
                );
            },
        ];
        $export = new AwardExcel($this->repo->make($make));
        return $export->download("司机奖惩列表.xlsx");
    }


}
