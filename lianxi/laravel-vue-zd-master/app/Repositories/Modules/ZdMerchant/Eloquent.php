<?php

namespace App\Repositories\Modules\ZdMerchant;

use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 更新
     * @param Model $model
     * @param array $values
     * @param array $attributes
     * @return Model
     */
    public function update(Model $model, array $values, array $attributes = [])
    {
        $model = parent::update($model, $values, $attributes);

        if (isset($values['user'])) {
            if (isset($values['user']['password']) && $values['user']['password']) {
                $values['user']['password'] = bcrypt($values['user']['password']);
            }
            $model->user()->update($values['user']);
        }

        return $model;
    }

    /**
     * 创建
     * @param array $attributes
     * @return Model|void
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);
        if (isset($attributes['user'])) {
            if (isset($attributes['user']['password']) && $attributes['user']['password']) {
                $attributes['user']['password'] = bcrypt($attributes['user']['password']);
            }
            $attributes['user']['merchant_id'] = $model->id;
            $model->user()->create($attributes['user']);
        }
    }

    /**
     * 还款
     * @param Model $model
     * @param array $input
     */
    public function repay(Model $model, array $input)
    {
        DB::transaction(
            function () use ($model, $input) {
                $money = (float)$input['money'];
                $billRepo = app(\App\Repositories\Modules\ZdMerchantBill\Interfaces::class);

                $model->checkedWaitBill->each(
                    function ($item) use ($billRepo, &$money) {
                        if ($money > 0) {
                            $money = $billRepo->repay($item, $money);
                        } else {
                            return false;
                        }
                    }
                );

                // 剩余的钱存起来
                if ($money > 0) {
                    $model->account->update(
                        [
                            'account' =>DB::Raw( '`account`+'.$money),
                        ]
                    );
                }

                // 写入记录
                $model->repayLog()->create(
                    [
                        'repay_money' => $input['money'],
                        'type' => 1,
                        'remark' => $input['remark'],
                    ]
                );
            }
        );
    }
}
