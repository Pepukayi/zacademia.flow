<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailStatus extends Model
{
    protected $table = 'mail_status';
    protected $guarded = ['id'];
}
