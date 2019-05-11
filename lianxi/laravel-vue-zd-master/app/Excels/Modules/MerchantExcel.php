<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdMerchant\Interfaces;
use App\Searchs\Modules\Api\Merchant\MerchantSearch;

class MerchantExcel extends ExcelAbstract
{

    public function __construct(Interfaces $repo)
    {
        parent::__construct($repo);
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '商户编号',
            '商户手机号',
            '商户全称',
            '商户简称',
            '品质交付经理',
            '客户经理',
            '运作经理',
            '行业',
            'SOP',
            '所属城市',
            '仓库录入数',
            '发任务数',
            '任务作废数',
            '商户账号状态',
            '是否开票',
            '创建日期',
            '创建人',
        ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->telephone,
            $row->title,
            $row->short_name,
            $this->getQualityStatsAttr($row),
            $this->getAdviceAttr($row),
            $this->getRunningAttr($row),
            $row->trade,
            $this->getSopAttr($row),
            $row->city,
            $this->getWarehouseCountAttr($row),
            $this->getTaskCountAttr($row),
            $this->getUnlessTaskCountAttr($row),
            $this->getStatusAttr($row),
            $this->getInvoiceCountAttr($row),
            $row->create_time,
            $this->getCreatorAttr($row),
        ];
    }


    public function getQualityStatsAttr($row)
    {
        return empty($row->quality) ? '' : $row->quality->name;
    }


    public function getAdviceAttr($row)
    {
        return empty($row->advice) ? '' : $row->advice->name;
    }

    public function getRunningAttr($row)
    {
        return empty($row->running) ? '' : $row->running->name;
    }

    public function getSopAttr($row)
    {
        return $row->sop == 1 ? '是' : '否';
    }

    public function getWarehouseCountAttr($row)
    {
        return empty($row->warehouse_count) ? '0' : $row->warehouse_count;
    }

    public function getTaskCountAttr($row)
    {
        return empty($row->task_count) ? '0' : $row->task_count;
    }

    public function getUnlessTaskCountAttr($row)
    {
        return empty($row->unless_task_count) ? '0' : $row->unless_task_count;
    }

    public function getStatusAttr($row)
    {
        return $row->status == 1 ? '是' : '否';
    }


    public function getInvoiceCountAttr($row)
    {
        return $row->invoice == 1 ? '是' : '否';
    }

    public function getCreatorAttr($row)
    {
        return empty($row->creator) ? '' : $row->creator->name;
    }


    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {
        $search = new MerchantSearch(
            request()->only(
                [
                    'short_name',
                    'id',
                    'merchant_id',
                    'number',
                    'company_id',
                    'create_time',
                ]
            )
        );

        return $search->toArray();
    }


}