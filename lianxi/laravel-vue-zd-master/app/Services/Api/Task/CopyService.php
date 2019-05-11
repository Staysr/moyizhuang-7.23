<?php

namespace App\Services\Api\Task;

use Exception;

/**
 * Class CopyService
 *
 * @package App\Services\Api\Task
 */
class CopyService
{

    /**
     * 复制任务
     * @param $replicate
     *
     * @return mixed
     * @author Mark
     * @date   2018/8/17 15:33
     */
    public function handle($replicate)
    {
        $replicate->push();
        $replicate->offer_count++;
        $replicate->save();
        $replicate->setting->each(
            function ($item) use ($replicate) {
                $item->task_id = $replicate->id;
                $item->save();
            }
        );
        $replicate->delivery->each(
            function ($item) use ($replicate) {
                $item->task_id = $replicate->id;
                $item->save();
            }
        );
        return $replicate;
    }
}
