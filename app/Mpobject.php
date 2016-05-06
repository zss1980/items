<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpobject extends Model
{
    
    public $timestamps = false;
    protected $primaryKeys="id";

    public function entries()
    {
    	 return $this->hasMany('App\Mpobject_element', 'record_id');
    } 
     public function imageEntry()
    {
    	 return $this->hasMany('App\Image', 'record_id');
    }
}
