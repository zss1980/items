<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Dublin;

class ItemsController extends Controller
{
     public function index()
    {
    	$items = Item::where('public', 1)
    				->get();
		$images = array();
        foreach ($items as $item) {
            if (Item::find($item->id)->imageEntry()->where('record_id', $item->id)
                                                        ->where('output', 1)->first())
            {
                $imagesDB=Item::find($item->id)->imageEntry()->where('record_id', $item->id)
                                                        ->where('output', 1)->first();
                $images[]=$imagesDB->filename;
            }
            else 
            {
                $images[]="noimage.png";
            }
            
        }
        

    	
    	return view('pages.items')->with('items', $items)
                                ->with('images', $images);
    }
     public function show($id)
    {
        $item=Item::find($id);
        

        if (Dublin::where('record_id', $id)->get())
        {
            if (Item::find($id)->imageEntry()->where('record_id', $id)->get())
            {
                $imageview=Item::find($id)->imageEntry()->where('record_id', $id)
                										->where('output', 1)
                										->first();
                $dublin=Dublin::where('record_id', $id)
                        ->get();
                        return view('pages.itemshow')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('imageview', $imageview);
            }
            else 
            {
                $dublin=Dublin::where('record_id', $id)->get();
                        return view('pages.itemshow')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('imageview', $imageview);
            }
        }
        else 
        {
            return view('pages.itemshow')->with('item', $item);
        }

        /*return view('pages.show')->with('item', $item)
                                ->with('dublin', $dublin);*/
    }
}
