<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignForm extends Model
{
	protected $table = "event_forms";
    protected $fillable = ['event_id','form_id','status'];
}
