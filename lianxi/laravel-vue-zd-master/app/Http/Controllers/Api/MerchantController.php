<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Api;

use App\Excels\Modules\MerchantExcel;
use App\Http\Requests\Api\Merchant\IndexRequest;
use App\Http\Requests\Api\Merchant\SelectRequest;
use App\Http\Requests\Api\Merchant\StoreRequest;
use App\Repositories\Modules\ZdMerchant\Interfaces;
use App\Searchs\Modules\Api\Merchant\MerchantSearch;
use App\Searchs\Modules\Api\Merchant\SelectSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Merchant\UpdateRequest;
use Illuminate\Support\Facades\DB;

/**
 * Class CarController
 *
 * @package App\Http\Controllers\Api
 */
class MerchantController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 商户列表
     *
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/2 12:06
     */
    public function index(IndexRequest $request)
    {
        $search = new MerchantSearch($request->all());
        $make = [
            'quality' => function ($query) {
                $query->select(['id', 'name']);
            },
            'advice' => function ($query) {
                $query->select(['id', 'name']);
            },
            'running' => function ($query) {
                $query->select(['id', 'name']);
            },
            'creator' => function ($query) {
                $query->select(['id', 'name']);
            },
            'contract' => function ($query) {
                $query->select(['id','merchant_id','path']);
            }
        ];

        return $this->respondWithSuccess(
            $this->repo->scope(['orderWith','RelatedMerchant'])->make($make)->paginate(
                $search->toArray(),
                20,
                [
                    'zd_merchant.id',
                    'zd_merchant.quality_id',
                    'zd_merchant.advice_id',
                    'zd_merchant.running_id',
                    'zd_merchant.user_id',
                    'zd_merchant.title',
                    'zd_merchant.short_name',
                    'zd_merchant.city',
                    'zd_merchant.trade',
                    'zd_merchant.bank',
                    'zd_merchant.bank_no',
                    'zd_merchant.telephone',
                    'zd_merchant.agreement_start_time',
                    'zd_merchant.agreement_end_time',
                    'zd_merchant.invoice',
                    'zd_merchant.repayment',
                    'zd_merchant.repayment_day',
                    'zd_merchant.sop',
                    'zd_merchant.content',
                    'zd_merchant.task_count',
                    'zd_merchant.unless_task_count',
                    'zd_merchant.warehouse_count',
                    'zd_merchant.contract_count',
                    'zd_merchant.create_time',
                ]
            )
        );


    }

    /**
     * 获取全部的商户
     * @method select
     * @param SelectRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(SelectRequest $request)
    {
        $search = new SelectSearch(
            $request->only(['title'])
        );

        return $this->respondWithSuccess(
            $this->repo->scope(['RelatedMerchant'])->getWhere(
                $search->toArray(),
                [
                    "id",
                    'short_name as name',
                ]
            )
        );
    }

    /**
     * 查看
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/8/2 9:52
     */
    public function show(Request $request, $id)
    {
        $make = [
            'user' => function ($query) {
                $query->select(['phone', 'status', 'id', 'merchant_id']);
            },
        ];
        $result = $this->repo->make(
            $make
        )->find($id);

        return $this->respondWithSuccess($result);
    }


    /**
     * 新增商户
     *
     * @param StoreRequest $request
     *
     * @author Mark
     * @date   2018/8/2 15:37
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create($request->all())
        );
    }


    /**
     * 修改商户
     *
     * @param UpdateRequest $request
     * @param               $id
     *
     * @author Mark
     * @date   2018/8/2 15:36
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $model = $this->repo->update(
            $this->repo->find($id),
            $request->all()
        );

        return $this->respondWithSuccess($model);
    }


    /**
     * 导出
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @author Mark
     * @date   2018/8/8 14:10
     */
    public function export()
    {
        $make = [
            'quality' => function ($query) {
                $query->select(['id', 'name']);
            },
            'advice' => function ($query) {
                $query->select(['id', 'name']);
            },
            'running' => function ($query) {
                $query->select(['id', 'name']);
            },
            'creator' => function ($query) {
                $query->select(['id', 'name']);
            },
        ];
        $export = new MerchantExcel($this->repo->scope(['RelatedMerchant'])->make($make));

        return $export->download("商户列表.xlsx");
    }

}

