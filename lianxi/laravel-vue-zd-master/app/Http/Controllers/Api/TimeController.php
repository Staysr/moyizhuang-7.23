<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Time\IndexRequest;
use App\Repositories\Modules\ZdPointTime\Interfaces;
use App\Searchs\Modules\Api\Time\TimeSearch;
use App\Services\PointService;
use Illuminate\Http\Request;
use App\Repositories\Modules\ZdWarehouse\Interfaces as WarehouseInterfaces;
use App\Repositories\Modules\ZdMerchant\Interfaces as MerchantInterfaces;

class TimeController extends ApiController
{
    /**
     * @var Interfaces $repo
     */
    protected $repo;

    /**
     * @var PointService $service
     */
    protected $service;

    public function __construct(Interfaces $repo, PointService $service)
    {
        $this->repo = $repo;
        $this->service = $service;
    }


    /**
     * 配送点列表
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function index(IndexRequest $request)
    {
        $search = new TimeSearch($request->only(['merchant_id', 'date']));

        $make = [
            'warehouse' => function ($query){
                $query->select(['id', 'merchant_id', 'title']);
            },
            'warehouse.merchant' => function ($query) {
                $query->select(['id', 'short_name']);
            }
        ];

        $result = $this->repo->make($make)->scope(['orderWith', 'relatedWarehouse'])->paginate($search);

        return $this->respondWithSuccess($result);
    }

    /**
     * 导入
     * @param Request $request
     * @param WarehouseInterfaces $warehouse
     * @param MerchantInterfaces $merchant
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request, WarehouseInterfaces $warehouse, MerchantInterfaces $merchant)
    {
        $request->replace(
            array_merge(
                $request->all(),
                [
                    'warehouse_id'     => $warehouse->findValue(['id' => $request->input('warehouse_id')], 'id'),
                    'merchant_id'  => $merchant->findValue(['id' => $request->input('merchant_id')], 'id')
                ]
            )
        );
        $this->validate(
            $request,
            [
                'date' => ['required', 'date_format:Y-m-d H:i:s'],
                'merchant_id' => ['required', 'integer'],
                'merchant_name' => ['required', 'string'],
                'warehouse_id' => ['required', 'integer'],
                'warehouse_name' => ['required', 'string'],
                'contacts' => ['required', 'string'],
                'contact_way' => ['required', 'string'],
                'province' => ['string'],
                'city' => ['string'],
                'district' => ['string'],
                'address' => ['required', 'string'],
                'remark' => ['string']
            ],
            [],
            [
                'date' => '到仓时间',
                'merchant_id' => '商户ID',
                'merchant_name' => '商户简称',
                'warehouse_id' => '仓库ID',
                'warehouse_name' => '仓库名称',
                'contacts' => '联系人',
                'contact_way' => '联系电话',
                'province' => '省份',
                'city' => '城市',
                'district' => '地区',
                'address' => '收货地址',
                'remark' => '备注'
            ]
        );

        $data = $this->service->import([
                $request->only([
                    'date', 'merchant_id', 'merchant_name', 'warehouse_id', 'warehouse_name', 'contacts', 'contact_way', 'province', 'city', 'district', 'address', 'remark'
                ])
            ]);

        $result = $this->repo->create($data);

        return $this->respondWithSuccess($result);
    }

    /**
     * 保存排线
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(Request $request, $id)
    {
        $info = $request->only('data');

        try {
            $this->repo->change($this->repo->find($id), $info['data']);

            return $this->respondWithSuccess([], '保存全部排线成功');

        } catch (\Exception $e) {

            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function template()
    {
        return response()->download(storage_path('template') . '/time.xlsx');//文件名不能用中文（有疑问）
    }

}
