<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;

class Participent extends Model
{
    protected $fillable = ['name','position','address','mobile','type','client_id','event_id'];
}
