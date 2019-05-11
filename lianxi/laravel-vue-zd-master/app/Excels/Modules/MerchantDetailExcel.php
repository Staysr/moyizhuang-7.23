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
use App\Searchs\Modules\Api\Account\MerchantDetailSearch;

class MerchantDetailExcel extends ExcelAbstract
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
            '任务编号',
            '出车单号',
            '到仓时间',
            '商户简称',
            '运费',
            '商户保险费',
            '金额',
            '计费类型',
            '司机姓名',
            '任务类型',
            '线路名称',
            '仓名称',
            '配送完成时间',
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
            $row->arrival_warehouse_time,
            $this->getMerchantNameAttr($row),
            $this->getUnitPriceAttr($row),
            $this->getMerchantSafeFeeAttr($row),
            $this->getTotalFeeAttr($row),
            '出车',
            $this->getDriverNameAttr($row),
            $this->getTaskTypeAttr($row),
            $this->getTaskNameAttr($row),
            $this->getWarehouseNameAttr($row),
            $row->create_time,
        ];
    }


    /**
     * 出车单
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getOrderNoAttr($row)
    {
        return empty($row->order) ? "" : $row->order->order_no;
    }


    /**
     * 任务id
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getTaskIdAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task_id;
    }


    /**
     * 司机姓名
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getDriverNameAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->name;
    }


    /**
     * 商户姓名
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getMerchantNameAttr($row)
    {
        return empty($row->merchant) ? "" : $row->merchant->short_name;
    }


    /**
     * 任务类型
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getTaskTypeAttr($row)
    {
        if(empty($row->order)){
            return "";
        }else{
            return $row->order->task->type == 1 ? "主任务" : "临时任务";

        }
    }


    /**
     * 任务名字
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getTaskNameAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task->name;
    }

    /**
     * 仓库名
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/13 11:01
     */
    public function getWarehouseNameAttr($row)
    {
        return empty($row->order) ? "" : $row->order->task->warehouse->title;
    }


    /**
     * 金额
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/13 11:01
     */
    public function getTotalFeeAttr($row)
    {
        if(empty($row->order)){
             return "0";
        }else{
            $total_fee =  $row->order->unit_price + $row->order->merchant_safe_fee;
            return empty($total_fee) ? "0" : $total_fee;
        }

    }


    /**
     * 报价
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/13 11:01
     */
    public function getUnitPriceAttr($row)
    {
        if(empty($row->order)){
            return "0";
        }else {
            $unit_price = $row->order->unit_price;
            return empty($unit_price) ? "0" : $unit_price;
        }
    }


    /**
     * 商户保险费
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/13 11:01
     */
    public function getMerchantSafeFeeAttr($row)
    {
        if(empty($row->order)){
            return "0";
        }else {
            $merchant_fee = $row->order->merchant_safe_fee;
            return empty($merchant_fee) ? "0" : $merchant_fee;
        }
    }

    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {

        $search = new MerchantDetailSearch(
            request()->only(
                [
                    'driver_id',
                    'merchant_id',
                    'create_time'
                ]
            )
        );

        return $search->toArray();
    }


}