<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Collection;
use App\Item;
use App\Image;
use App\Colletio;
use App\Dublin;

class CollectionsController extends Controller
{
    public function index()
    {
    	$collections = Collection::paginate(4);

    	$images = array();
        $description=array();
        foreach ($collections as $collection) {
            $infos = Colletio::where('record_id', $collection->id)->where('element_id', 'description')->first();
            $description[]=$infos->text;

            if (Image::where('record_id', $collection->id)
        							->where('record_type', 1)
        							->first())
            {
                $imagesDB=Image::where('record_id', $collection->id)
        							->where('record_type', 1)
        							->first();
                $images[]=$imagesDB->filename;
            }
            else 
            {
                $images[]="noimage.png";
            }
        

    	}

        $menus = new PagesController;
        $menu = $menus->buildmenu();

        return view('pages.collections') -> with('collections', $collections)
                                        ->with('description', $description)
        								->with('image', $images)
                                        ->with('pages', $menu);
            
        
    }
     public function show($id)
    {
        $items = Item::where('collection_id', $id)
        				->where('public', 1)
        				->paginate(6);
        $collection = Collection::find($id);
        $description = Collection::find($id)->entry()->where('element_id', 'description')->first();
        

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

    	return view('pages.itemscollections')->with('items', $items)
                                ->with('images', $images)
                                ->with('description', $description)
                                ->with('collection', $collection)
                                ->with('pages', $menu);
    }
    public function items($id)
    {
            
           $item=Item::find($id);
           $collection = Collection::find($item->collection_id);
           $description=Colletio::where('record_id', $collection->id)
                                ->where('element_id', 'description')->first();

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
                        return view('pages.collectionitemshow')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('collection', $collection)
                                ->with('description', $description)
                                ->with('imageview', $imageview)->with('pages', $menu);
            }
            else 
            {
                $dublin=Dublin::where('record_id', $id)->get();
                        return view('pages.collectionitemshow')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('collection', $collection)
                                ->with('description', $description)
                                ->with('imageview', $imageview)->with('pages', $menu);
            }
        }
        else 
        {
            return view('pages.collectionitemshow')->with('collection', $collection)
                                                    ->with('description', $description)
                                                    ->with('item', $item)->with('pages', $menu);
        }
    }
}
