<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_title','start_date','end_date','start_time','end_time','address','description','venue','recurring','status','recurring_remarks','client_id'];
}
