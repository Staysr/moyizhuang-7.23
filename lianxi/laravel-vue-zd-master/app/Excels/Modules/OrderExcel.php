<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Foundations\Util;
use App\Repositories\Modules\ZdTaskOrder\Interfaces;
use App\Searchs\Modules\Api\Order\OrderSearch;

class OrderExcel extends ExcelAbstract
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
            '商户简称',
            '出车单号',
            '到仓时间',
            '任务编号',
            '线路名称',
            '仓名称',
            '司机姓名',
            '所属队长',
            '司机手机号',
            '车型',
            '车牌号码',
            '迟到时间',
            '签到时间',
            '离仓时间',
            '配送完成时间',
            '出车单状态',
            '配送点数量',
            '未妥投点个数',
            '代签到',
            '一键完成',
            '改派司机',
            '司机保价',
            '司机保险费',
            '运费',
            '管理费',
            '商户保险费',
            '司机总金额',
            '商户总金额',
            '备注',
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
            $row->merchant->short_name,
            $row->order_no,
            $row->arrival_warehouse_time,
            $row->task_id,
            $row->task->name,
            $row->warehouse->title,
            $row->driver->name,
            $this->getSupervisorNameAttr($row),
            $row->driver->phone,
            $row->carType->name,
            $row->driver->car_number,
            $this->getLateTimeAttr($row),
            $row->punch_time,
            $row->leaves_warehouse_time,
            $row->finish_time,
            $this->getStatusAttr($row),
            $row->point_count,
            $row->exception_count,
            $this->getIsAgentAttr($row),
            $this->getIsOneStepFinishAttr($row),
            $this->getIsReassignedAttr($row),
            $this->getDriverSafeAttr($row),
            $row->safe_fee,
            $row->unit_price,
            $row->manage_fee,
            $row->merchant_safe_fee,
            $row->total_fee,
            $this->getTotalMerchantFeeAttr($row),
            $row->remark,

        ];
    }


    /**
     * 队长姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getSupervisorNameAttr($row)
    {
        return empty($row->driver->supervisor) ? "" : $row->driver->supervisor->name;
    }


    /**
     * 迟到时间
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:24
     */
    public function getLateTimeAttr($row)
    {
        if (empty($row->punch_time)) {
            $diff = time() - strtotime($row->arrival_warehouse_time);
        } else {
            $diff = strtotime($row->punch_time) - strtotime($row->arrival_warehouse_time);
        }
        $format = Util::Sec2Time($diff);
        if ($format["seconds"] > 0) {
            $format["minutes"]++;
        }
        return $format["days"]."天".$format["hours"]."小时".$format["minutes"]."分钟";
    }


    /**
     * 代签到
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:23`=
     */
    public function getIsAgentAttr($row)
    {
        return ($row->is_agent == 1) ? "是" : "否";
    }


    /**
     * 一键完成
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:23
     */
    public function getIsOneStepFinishAttr($row)
    {
        return ($row->is_one_step_finish == 1) ? "是" : "否";
    }


    /**
     * 是否改派
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:24
     */
    public function getIsReassignedAttr($row)
    {
        return ($row->is_reassigned == 1) ? "是" : "否";
    }


    /**
     * 出车单状态
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:24
     */
    protected function getStatusAttr($row)
    {
        switch ($row['status']) {
            case '0':
                return '未签到';
                break;
            case '1':
                return '已签到';
                break;
            case '2':
                return '配送中';
                break;
            case '3':
                return '配送完成';
                break;
            case '4':
                return '设置不配送';
                break;
            case '5':
                return '无责任解约';
                break;
            case '6':
                return '运营取消';
                break;
            default:
                return "-";
        }
    }


    /**
     * 司机保价
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:17
     */
    public function getDriverSafeAttr($row)
    {
        if (empty($row->safe_id)) {
            return "否";
        } else {
            return "是";
        }
    }


    /**
     * 商户总价格
     * @param $row
     *
     * @return mixed
     * @author Mark
     * @date   2018/8/7 15:16
     */
    public function getTotalMerchantFeeAttr($row)
    {
        return $row->merchant_safe_fee + $row->unit_price;
    }


    /**
     * 查询
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/31 16:03
     */
    protected function getAttributes()
    {
        $search = new OrderSearch(
            request()->only(
                [
                    'merchant_id',
                    'order_no',
                    'task_id',
                    'warehouse_id',
                    'driver_id',
                    'order_date',
                    'exception_count',
                    'is_agent',
                    'is_one_step_finish',
                    'is_reassigned',
                ]
            )
        );

        return $search->toArray();
    }


}