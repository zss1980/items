<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;
    protected $primaryKeys="id";

    public function pageRoute()
    {
    	 return $this->hasMany('App\Route', 'record_id');
    } 
}
