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
    	//$items = Item::where('public', 1)->get();
       $items = Item::where('public', 1)
                    ->paginate(6);
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
        $menus = new PagesController;
        $menu = $menus->buildmenu();

    	
    	return view('pages.items')->with('items', $items)
                                ->with('images', $images)
                                ->with('pages', $menu);
    }
     public function show($id)
    {
        $item=Item::find($id);
        $menus = new PagesController;
        $menu = $menus->buildmenu();
        

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
                                ->with('imageview', $imageview)->with('pages', $menu);
            }
            else 
            {
                $dublin=Dublin::where('record_id', $id)->get();
                        return view('pages.itemshow')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('imageview', $imageview)->with('pages', $menu);
            }
        }
        else 
        {
            return view('pages.itemshow')->with('item', $item)->with('pages', $menu);
        }

        /*return view('pages.show')->with('item', $item)
                                ->with('dublin', $dublin);*/
    }
}
