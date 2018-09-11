<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';

    public function product()
    {
    	return $this->hasMany('App\Product', 'template_id', 'id');
    }
}
