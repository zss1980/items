<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table='items';
    public $timestamps = false;
    protected $primaryKeys="id";

    public function entries()
    {
    	 return $this->hasMany('App\Dublin', 'record_id');
    } 
     public function imageEntry()
    {
    	 return $this->hasMany('App\Image', 'record_id');
    }
      
}
