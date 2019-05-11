<?php

namespace App\Http\Requests\Api\Task;

use App\Model\ZdTask;
use App\Model\ZdTaskOrder;
use App\Plugins\Task\Conflict;
use App\Services\Api\Task\TaskConflictService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AssignedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'drivers' => ['required', 'array'],
            'unit_price' => [
                'required',
                'money',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'drivers' => '选中司机',
        ];
    }

    /**
     * 验证冲突
     * @param ZdTask $task
     */
    public function isConflict(ZdTask $task){
        $drivers = $this->input('drivers');

        $myTask = ZdTask::valid($drivers)->get(['id','send_time','temp_start_date','temp_end_date','arrival_warehouse_time','estimate_time',]);

        $cancelOrders = ZdTaskOrder::cancelByDriver($drivers)->get(['arrival_warehouse_time', 'task_id']);
        try{
            Conflict::validator($myTask,  $task, $cancelOrders);
        }catch (\Exception $e){
            throw ValidationException::withMessages(['conflict'=>$e->getMessage()]);
        }
    }
}
