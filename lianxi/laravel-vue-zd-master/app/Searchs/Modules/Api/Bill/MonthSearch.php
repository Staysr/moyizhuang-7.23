<?php

namespace App\Searchs\Modules\Api\Bill;

use luffyzhao\laravelTools\Searchs\Facades\SearchAbstract;

class MonthSearch extends SearchAbstract
{
    protected $relationship
        = [
            'bill_time' => 'closure',
            'merchant_id' => '=',
            'status' => '=',
            'overdue' => 'closure',
        ];


    public function getBillTimeAttribute($value)
    {
        return function ($query) use ($value) {
            if (empty($value[0]) || empty($value[1])) {
                return false;
            }
            $query->where('bill_time', '>=', $value[0])->where(
                'bill_time',
                '<=',
                $value[1]
            );
        };
    }

    public function getOverdueAttribute($value)
    {
        return function ($query) use ($value) {
            switch ($value) {
                case 0:
                    return $query->whereRaw("money=repayment_money");
                case 1:
                    return $query->whereRaw("money!=repayment_money")->whereRaw("UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(CONCAT(bill_time, '', '-01')) < ((SELECT repayment_day FROM zd_merchant WHERE zd_merchant.id = zd_month_bill.merchant_id)) * 86400");
                case 2:
                    return $query->whereRaw("money!=repayment_money")->whereRaw("UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(CONCAT(bill_time, '', '-01')) > ((SELECT repayment_day FROM zd_merchant WHERE zd_merchant.id = zd_month_bill.merchant_id)) * 86400");
            }
        };
    }


}
