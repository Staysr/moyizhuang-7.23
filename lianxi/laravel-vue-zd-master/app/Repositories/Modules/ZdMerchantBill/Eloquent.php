<?php

namespace App\Repositories\Modules\ZdMerchantBill;

use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use Closure;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;


    }

    /**
     * 统计和
     * @param $column
     * @return mixed
     * @author Mark
     * @date 2018/5/7 17:29
     */
    public function sum($column)
    {
        return $this->model->sum($column);
    }

    /**
     * 还款
     * @param Model $model
     * @param float $money
     * @return float|mixed
     */
    public function repay(Model $model, float $money){
        $arrears = $model->money - $model->repayment_money;
        parent::update($model, [
            'repayment_money' =>DB::Raw( '`repayment_money`+' . ($arrears > $money ? $money : $arrears)),
            'status' => $arrears > $money ? 1 : 2,
            'last_repayment_time' => date('Y-m-d H:i:s')
        ]);
        return $money - $arrears;
    }

}
