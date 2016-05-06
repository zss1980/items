<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Input;
use App\Dublin;
use App\Image;
use Auth;



class ItemController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    public function index()
    {
    	$items = Item::all();

        
        $images = array();
        $creator = array();
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

            if (Item::find($item->id)->entries()->where('record_id', $item->id) 
                                                        ->where('element_id', 'subject')->first())
            {
                $dublinDB=Item::find($item->id)->entries()->where('record_id', $item->id) 
                                                        ->where('element_id', 'subject')->first();
                $creator[]=$dublinDB->text;                                            
            }
            else 
            {
                $creator[]='no data';
            }
            
        }
        

    	
    	return view('pages.admin')->with('items', $items)
                                ->with('images', $images)
                                ->with('dublin', $creator);
    }

    public function create()
    {
    	

    	return view('pages.create');
    }

    public function addcollection()
    {
        

        return view('pages.addcollection');
    }
    public function storecollection()
    {
        

        return "view('pages.addcollection')";
    }
    

    public function store(Request $request)
    {
       $item = new Item;

        $item->title = $request->title;
        $item->type = $request->type;
        $item->created = $request->created;
        $item->save();
        
       
        
        $dublin = new Dublin;
        $dublin->record_id=$item->id;
        $arraytopush = array('subject', 'source', 
    'rights', 'relation', 'publisher', 
     'language', 'identifier', 'format', 
     'description', 'creator', 'coverage',
     'contributor');
        $element_ids = current($arraytopush);
        for($count=10; $count<22;$count++) {
            $dublin = new Dublin;
            $dublin->record_id=$item->id;
            $dublin->element_id=$element_ids;
            $dublin->text="empty_string";
            $dublin->save();
            $element_ids = next($arraytopush);
        }
         
         $newimage = new Image;
         $newimage->record_id=$item->id;
         $newimage->output=1;
         $newimage->filename='noimage.png';
         $newimage->save();

        //return $this->index();
        //return redirect()->route('admin.index');
        return redirect()->action('ItemController@index');
    }

    public function show($id)
    {
        $item=Item::find($id);
        

        if (Dublin::where('record_id', $id)->get())
        {
            if (Item::find($id)->imageEntry()->where('record_id', $id)->get())
            {
                $imageview=Item::find($id)->imageEntry()->where('record_id', $id)->get();
                $dublin=Dublin::where('record_id', $id)
                        ->get();
                        return view('pages.show')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('imageview', $imageview);
            }
            else 
            {
                $dublin=Dublin::where('record_id', $id)->get();
                        return view('pages.show')->with('item', $item)
                                ->with('dublin', $dublin)
                                ->with('imageview', $imageview);
            }
        }
        else 
        {
            return view('pages.show')->with('item', $item);
        }

        /*return view('pages.show')->with('item', $item)
                                ->with('dublin', $dublin);*/
    }
    public function edit($id)
    {
        

        return $id;
    }

    public function update(Request $request, $id)
    {
        $item=Item::find($id);
        $item->title = $request->title;
        $item->type = $request->type;
        $item->created = $request->created;
        $item->public = $request->public;
        $item->save();

        $arraytopush = array($request->subject, $request->source, 
    $request->rights, $request->relation, $request->publisher, 
     $request->language, $request->identifier, $request->format, 
     $request->description, $request->creator, $request->coverage,
     $request->contributor);

        $input=current($arraytopush);
        

            $arrayvalue = array('subject', 'source', 
    'rights', 'relation', 'publisher', 
     'language', 'identifier', 'format', 
     'description', 'creator', 'coverage',
     'contributor');
        $element_ids = current($arrayvalue);
            if (Item::find($id)->entries()->where('element_id', 'subject')->first())
            {
                for ($count=10; $count<22; $count++)
                {
                    $dublinupdate=Item::find($id)->entries()->where('element_id', $element_ids)->first();
                    $dublinupdate->text = $input;
                    $dublinupdate->save();
                    $input=next($arraytopush);
                    $element_ids=next($arrayvalue);
                }
            }
            else 
            { 
                $dublin = new Dublin;
                $dublin->record_id=$item->id;
                $arrayvalues = array('subject', 'source', 
    'rights', 'relation', 'publisher', 
     'language', 'identifier', 'format', 
     'description', 'creator', 'coverage',
     'contributor');
        $element_idss = current($arrayvalues);
                for ($count=10; $count<22; $count++) 
                {
                    $dublin = new Dublin;
                    $dublin->record_id=$item->id;
                    $dublin->element_id=$element_idss;
                    $dublin->text=$input;
                    $dublin->save(); 
                    $input=next($arrayvalues);

                }    
        
            }
       

        if ((Input::file('image'))){ 

        $file = Input::file('image');

        $rules = array('image' => 'required',);

        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        $file->move(base_path() . '/storage/app/img/', $filename);

        //image to DB
        $image = new Image;
        $image->record_id=$item->id;
        $image->filename=$filename;
        $image->output=0;
        $image->save();

        }

        if ($request->output)
        {
            $imagestoCheckout=Item::find($id)->imageEntry()->where('record_id', $item->id)->get();
            foreach ($imagestoCheckout as $imgcheck) 
            {
                $imgcheck->output=0;
                $imgcheck->save();  
            }
            $imageupdate=Item::find($id)->imageEntry()->where('filename', $request->output)->first();
            $imageupdate->output=1;
            $imageupdate->save();

        }
        if ($request->delete)
        {
           // unlink(base_path() . '/storage/app/img/' . $request->delete);
           $imagedelete=Image::where('filename', $request->delete)->first();
            
            Dublin::destroy($imagedelete->id);
                        
        }



        return redirect()->action('ItemController@show', [$item->id]);
    }
    public function destroy($id)
    {
        Item::destroy($id);

        return redirect()->action('ItemController@index');
    }
}
