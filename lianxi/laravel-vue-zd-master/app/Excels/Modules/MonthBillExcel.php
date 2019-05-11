<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdMonthBill\Interfaces;
use App\Searchs\Modules\Api\Bill\MonthSearch;

class MonthBillExcel extends ExcelAbstract
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
            '账单编号',
            '商户简称',
            '账单时间',
            '账单金额',
            '还款金额',
            '最后还款时间',
            '还款状态',
            '逾期状态'
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
            $row->bill_no,
            $this->getMerchantNameAttr($row),
            $row->bill_time,
            $row->money,
            $row->repayment_money,
            $row->last_repayment_time,
            $this->getStatusAttr($row),
            $this->getOverdueAttr($row)
        ];
    }


    /**
     * 商户姓名
     *
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
     *
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/23 15:21
     */
    public function getOverdueAttr($row)
    {
        if ($row->money== $row->repayment_money
        ) {
            return '已完成';
        } else {
            if (time() - strtotime($row['bill_time'])
                < $row->merchant->repayment_day * 86400
            ) {
                return '账期内';
            } else {
                return '账期未还款';
            }
        }
    }

    public function getStatusAttr($row)
    {
        switch ($row->status){
            case 0:
                return "待还款";
            case 1:
                return "部分还款";
            case 2:
                return "已经还款";
            case 3:
                return "无需还款";
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
        $search = new MonthSearch(
            request()->only(
                ['merchant_id', 'create_time']
            )
        );

        return $search->toArray();
    }


}