<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdDriverReward\Interfaces;
use App\Searchs\Modules\Api\Award\AwardSearch;

class AwardExcel extends ExcelAbstract
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
            '奖惩编号',
            '司机姓名',
            '司机手机号',
            '商户简称',
            '出车单号',
            '类型',
            '金额',
            '原因',
            '创建人',
            '创建日期',
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
            $row->reward_no,
            $this->getDriverNameAttr($row),
            $this->getDriverPhoneAttr($row),
            $this->getMerchantNameAttr($row),
            $this->getOrderNoAttr($row),
            $this->getTypeAttr($row),
            $this->getFeeAttr($row),
            $row->reason,
            $this->getUserNameAttr($row),
            $row->create_time
        ];
    }


    /**
     * 司机姓名
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
     * 司机手机
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getDriverPhoneAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->phone;
    }

    /**
     * 商户姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getMerchantNameAttr($row)
    {
        return empty($row->merchant) ? "" : $row->merchant->short_name;
    }

    /**
     * 商户姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getOrderNoAttr($row)
    {
        return empty($row->order) ? "" : $row->order->order_no;
    }

    /**
     * 商户类型
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getTypeAttr($row)
    {
        switch ($row->type){
            case 1:
                return "奖励";
            case 2:
                return "罚款";
            case 3:
                return "其他";
            default:
                return "-";
        }
    }


    /**
     * 金额
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getFeeAttr($row)
    {
        return empty($row->fee) ? "0" : $row->fee;
    }


    /**
     * 获取创建者名称
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:32
     */
    public function getUserNameAttr($row)
    {
        return empty($row->user) ? "0" : $row->user->name;
    }




    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {
        $search = new AwardSearch(
            request()->only(
                [
                    'driver_id',
                    'merchant_id',
                    'type',
                    'create_time',
                ]
            )
        );
        return $search->toArray();
    }


}