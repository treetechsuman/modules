<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
 	protected $table = "images";
    protected $fillable = ['client_id','event_id','image','status'];

}
