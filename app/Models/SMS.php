<?php

namespace App\Models;

use App\Models\SMSStatus as SMSStatusAlias;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = 'sms';
    protected $primaryKey = 'id';
    protected $fillable = ['tries'];

    public static function boot()
    {
        parent::boot();

        static::saved(function (SMS $sms) {
            $smsStatus = new SMSStatusAlias();

            $smsStatus->sms_id = $sms->id;
            $smsStatus->status = $sms->status;
            $smsStatus->status_reason = $sms->status_reason;
            $smsStatus->save();
        });
    }
}
