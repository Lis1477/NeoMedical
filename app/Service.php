<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'text',
        'pic',
        'display',
        'order'
	];

    public $timestamps = false;
}
