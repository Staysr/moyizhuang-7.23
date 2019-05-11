<?php

namespace App\Transformers;


use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{

    /**
     * @param User $model
     * @return array
     */
    public function getTransformer(User $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

}