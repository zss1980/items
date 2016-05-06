<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table='collections';

    public function entry()
    {
    	 return $this->hasMany('App\Colletio', 'record_id');
    } 
}
