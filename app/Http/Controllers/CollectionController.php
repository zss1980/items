<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Collection;
use App\Item;
use App\Image;
use App\Colletio;
use Input;
use UploadedFile;


class CollectionController extends Controller
{
    protected $table='collections';
    public function __construct()
{
    $this->middleware('auth');
}
    //public $timestamps = false;
    //
   public function index()
    {
        $collections = Collection::all();

        return view('pages.collection') -> with('collections', $collections);
    } 

   public function create()
    {
        

        return view('pages.addCollection');
    }
    public function show($id)
    {
        $collections = Collection::find($id);
        $collectionimage = Image::where('record_id', $id)
        							->where('record_type', 1)
        							->first();
        $infos = Colletio::where('record_id', $id)->where('element_id', 'description')->first();

      
        	$items = Item::where('collection_id', $id)->get();
        
        $itemsout = Item::where('collection_id', '!=', $id)
        					->where('collection_id', 0)->get();

        return view('pages.showcollection') -> with('collections', $collections)
        									->with('items', $items)
                                            ->with('description', $infos)
        									->with('image', $collectionimage)
        									->with('itemsout', $itemsout);
    }
    public function store(Request $request)
    {
    	$newcollection = new Collection;
    	$newcollection->title=$request->title;
    	$newcollection->date=$request->date;
    	$newcollection->save();

    	$newimage = new Image;
         $newimage->record_id=$newcollection->id;
         $newimage->record_type=1;
         $newimage->output=1;
         $newimage->filename='noimage.png';
         $newimage->save();

         $infos = new Colletio;
         $infos->record_id=$newcollection->id;
         $infos->element_id="description";
          $infos->text="Enter description";
         $infos->save();


    	return redirect()->action('CollectionController@index');
    }

    public function update(Request $request, $id)
    {
    	
    	if ($request->collection=='out')
    	{
    		$item=Item::find($request->item);
    		$item->collection_id=0;
    		$item->save();
    	}
    	elseif ($request->collection=='in')
    	{
    		$item=Item::find($request->item);
    		$item->collection_id=$id;
    		$item->save();
    	} 
    	elseif ($request->collection=='info') 
    	{
    		$collection = Collection::find($id);
    		$collection->title=$request->collection_title;
    		$collection->save();

    		if (Colletio::where('record_id', $id)->where('element_id', 'description')->first()) {
    			$infos = Colletio::where('record_id', $id)->where('element_id', 'description')->first();
    			$infos->text=$request->description;
    			$infos ->save();
    		}
    		else {
    			$infos = new Colletio;
    			$infos->record_id=$id;
    			$infos->element_id='description';
    			$infos->text=$request->description;
    			$infos ->save();
    		}
        }


    		if ((Input::file('imag')))
            { 

                $file = Input::file('imag');

                $rules = array('imag' => 'required',);

                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/storage/app/img/', $filename);

                //image to DB
                $image = Image::where('record_id', $id)->where('record_type', 1)->first();
                 $image->filename=$filename;
                 $image->save();
    	   }
    	/*$collection = new Collection;
    	$newcollection->title=$request->title;
    	$newcollection->date=$request->date;
    	$newcollection->save();*/


    	return redirect()->action('CollectionController@show', [$id]);
    	//return Item::where('collection_id', 3)->get();
    }

     public function destroy($id)
    {
        Collection::destroy($id);

        //clear items
        $items=Item::where('collection_id', $id)->get();
        foreach ($items as $item) {
            $item->collection_id=0;
            $item->save();
        }
        $collections_elements = Colletio::where('record_id', $id)->get();
        foreach ($collections_elements as $element) {
           $id_destroy=$element->id;
           Colletio::destroy($id_destroy);
        }
        return redirect()->action('CollectionController@index');
    }
}
