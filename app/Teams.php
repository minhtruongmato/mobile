<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'title', 'image', 'slug', 'position', 'description'
    ];
}
