<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mpobject;
use App\Mpobject_element;
use App\Image;

class MainpagesController extends Controller
{
    public function index()
    {
    	
    	
    	$mpobjects = Mpobject::all();

    	foreach ($mpobjects as $object) 
    	{
    		$object->caption=$object->entries()->where('record_id', $object->id)
    															->where('element_id', 'caption')
    															->first()->text;	
    		
    		$object->info=$object->entries()->where('record_id', $object->id)
    															->where('element_id', 'info')
    															->first()->text;

    		$object->filename=$object->imageEntry()->where('record_id', $object->id)
    															->where('record_type',  $object->record_type)
    															->first()->filename;
    	}			

        $menus = new PagesController;
        $menu = $menus->buildmenu();									

    	return view('pages.index')->with('mpobjects', $mpobjects)->with('pages', $menu);
	}
}
