<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdMerchantAccount\Interfaces as Interfaces;
use App\Searchs\Modules\Api\Account\MerchantAccountSearch;

class MerchantAccountExcel extends ExcelAbstract
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
            '商户手机号',
            '欠款金额',
            '逾期未付款金额',
            '账户余额',
            '结算方式',
            '承诺回款天数',
            '最近还款时间',
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
            $this->getMerchantNameAttr($row),
            $this->getMerchantPhoneAttr($row),
            $this->getBorrowAttr($row),
            $this->getOverdueAttr($row),
            $this->getAccountAttr($row),
            '月结',
            $this->getMerchantDayAttr($row),
            $row->latest_repayment_time
        ];
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
    public function getMerchantNameAttr($row)
    {
        return empty($row->merchant) ? "" : $row->merchant->short_name;
    }

    /**
     * 司机手机
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getMerchantPhoneAttr($row)
    {
        return empty($row->merchantUser) ? "" : $row->merchantUser->phone;
    }


    /**
     * 欠款金额
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getBorrowAttr($row)
    {
        $left = $total_fee = 0;
        foreach ($row->orderFinish as $key => $cast) {
            $total_fee += $cast->unit_price + $cast->merchant_safe_fee;
        }
        foreach ($row->month as $index => $value) {
            $left += $value->money - $value->repayment_money;

        }

        return (string)($total_fee + $left);
    }


    /**
     * 逾期未还款
     * @param $row
     *
     * @return int
     * @author Mark
     * @date   2018/8/13 16:10
     */
    public function getOverdueAttr($row)
    {
        $result=0;
        foreach ($row->month as $index => $value) {
            $less = $value->money - $value->repayment_money;
            if(time()-strtotime($value->bill_time)>86400* $value->merchant->repayment_day){
                $result+=$less;
            }
        }
        return  (string)$result;
    }

    /**
     * 商户还款天数
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getMerchantDayAttr($row)
    {
        return empty($row->merchant) ? "" : $row->merchant->repayment_day;
    }


    /**
     * 商户帐号金额
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getAccountAttr($row)
    {
        return empty($row->account) ? "" : $row->account;
    }


    /**
     * 司机手机
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getDriverPhoneAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->phone;
    }

    public function getCarTypeAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->carType->name;
    }


    public function getCarNumberAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->car_number;
    }


    public function getTotalFeeAttr($row)
    {
        if (empty($row->order)) {
            return "0";
        } else {
            $total = 0;
            foreach ($row->order as $index => $item) {
                $total += $item->total_fee;
            }

            return (string)$total;
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
        $search = new MerchantAccountSearch(
            request()->only(
                [
                    'merchant_id',
                ]
            )
        );

        return $search->toArray();
    }


}