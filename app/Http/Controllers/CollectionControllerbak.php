<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    protected $table='collections';
    //public $timestamps = false;
    //
   public function index()
    {
        

        return view('pages.addcollection');
    } 

   public function create()
    {
        

        return view('pages.addCollection');
    }
    public function show()
    {
        

        return view('pages.addCollection');
    }
    public function store(Request $request)
    {
    	return view('pages.addCollection');
    }
}
