<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdMerchantBill\Interfaces;
use App\Searchs\Modules\Api\Bill\MonthSearch;

class WaitBillExcel extends ExcelAbstract
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
            '任务编号','出车单号','到仓时间','商户简称','运费','商户保险费','金额','计费类型','司机姓名','仓名称','线路名称','客户顾问','配送完成时间'
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
            $this->getTaskIdAttr($row),
            $this->getOrderNoAttr($row),
            $this->getArrivalWarehouseTimeAttr($row),
            $this->getMerchantNameAttr($row),
            $this->getUnitPriceAttr($row),
            $this->getMerchantSafeFeeAttr($row),
            $this->getTotalFeeAttr($row),
            $this->getChargeTypeAttr($row),
            $this->getDriverNameAttr($row),
            $this->getTaskNameAttr($row),
            $this->getDriverNameAttr($row),
            $this->getFinishTimeAttr($row),
        ];
    }


    /**
     * 任务编号
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getTaskIdAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task_id;
    }

    /**
     * 出车单号
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getOrderNoAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task_id;
    }


    /**
     * 到仓时间
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getArrivalWarehouseTimeAttr($row)
    {
        return empty($row->order) ? "" : $row->order->arrival_warehouse_time;
    }

    /**
     * 商户简称
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getMerchantNameAttr($row)
    {
        return empty($row->order) ? "" : $row->order->arrival_warehouse_time;
    }


    /**
     * 金额
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getUnitPriceAttr($row)
    {
        return empty($row->order) ? "" : $row->order->unit_price;
    }

    /**
     * 商户保险费
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getMerchantSafeFeeAttr($row)
    {
        return empty($row->order) ? "" : $row->order->merchant_safe_fee;
    }

    /**
     * 运费
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getTotalFeeAttr($row)
    {
        return empty($row->order) ? "" : $row->order->unit_price+ $row->order->merchant_safe_fee;
    }

    /**
     * 计费类型
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getChargeTypeAttr($row)
    {
        return "计费";
    }

    /**
     * 司机姓名
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getDriverNameAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->name;
    }

    /**
     * 任务名称
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getTaskNameAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task->name; ;
    }

    /**
     * 仓名称
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getWarehouseNameAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task->warehouse->title;
    }

    /**
     * 配送完成时间
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getFinishTimeAttr($row)
    {
        return empty($row->order) ? "" : $row->order->finish_time;
    }


    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {
        $search = new MonthSearch(
            request()->only(
                ['bill_time', 'merchant_id', 'status', 'overdue']
            )
        );

        return $search->toArray();
    }


}