<?php

namespace App\Model;

use App\Notifications\Push\Sms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ZdSms extends Model
{
    use Notifiable;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'modify_time';
    public $timestamps = true;
    protected $table = "sys_sms";

    protected $fillable = [
        'id',
        'mobile',
        'contents',
        'status',
        'remark',
        'type'
     ];

    public static function boot(){
        parent::boot();

        self::registerModelEvent('created', function (self $user){
            $user->notify(new Sms());
        });
    }
}
