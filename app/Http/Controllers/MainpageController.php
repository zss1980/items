<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mpobject;
use App\Mpobject_element;
use App\Image;
use Input;
use File;

class MainpageController extends Controller
{
    
 	public function __construct()
	{
    	$this->middleware('auth');
	}
    
    public function index()
    {
    	//check the records if they don't exist, than seed it
    	if (!Mpobject::first())
    	{
    		$nextobjects=['sliders', 'headings', 'explanation'];
    		$type=2;
    		foreach ($nextobjects as $object) 
    		{
    			
    		
    			for ($count=0; $count<3; $count++)
    			{
    				$mpobject=new Mpobject;
    				$mpobject->objectnames=$object;
    				$mpobject->record_type=$type;
    				$mpobject->save();

    				$nextobjectelement=['caption', 'info'];
    				foreach ($nextobjectelement as $element) 
    				{
    					$mpobject_element = new Mpobject_element;
    					$mpobject_element->record_id=$mpobject->id;
    					$mpobject_element->element_id=$element;
    					$mpobject_element->text='empty string';
    					$mpobject_element->save();
    				}
    				$mpobject_image=new Image;
    				$mpobject_image->record_id=$mpobject->id;
    				$mpobject_image->filename='noimage.png';
    				$mpobject_image->output=1;
    				$mpobject_image->record_type=$type;
    				$mpobject_image->save();



       			}
       			$type++;
    		}	

       	} 
    	
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

        

/*
    	$mparray = array();
    	$objectnumber=1;
    	$oldobject='';

    	foreach ($mpobjects as $object) 
    	{
    		$objectarraykeys=['caption', 'info'];
    		$objectarray=array();
    		foreach ($objectarraykeys as $objectarraykey) 
    		{
    			$objectarray[$objectarraykey] = 
    		}
    		$objectarray['filename']=$object->imageEntry()->where('record_id', $object->id)
    															->where('record_type',  $object->record_type)
    															->first()->filename;
    		$objectarray['type']=$object->record_type;

    		if ($oldobject=='')
    		{
    			$oldobject=$object->objectnames;
    		}
    		elseif ($oldobject!=$object->objectnames) 
    		{														
    			
    			$oldobject=$object->objectnames;

    			$objectnumber=1;
    		} else
    		{
    			$objectnumber++;
    		}

    		$mparray[$object->objectnames . $objectnumber] = $objectarray;
    		$oldobject=$object->objectnames;
    	}
*/
    	//return $mpobjects;	
    	return view('pages.adminmainpage')->with('mpobjects', $mpobjects);
	}
	public function update(Request $request, $id)
    {
    	$mpobject = Mpobject::find($id);

    	


    	
    		$mpobject_caption=$mpobject->entries()->where('record_id', $id)
    															->where('element_id', 'caption')
    															->first();
    		$mpobject_caption->text = $request->formData['caption'];
    		$mpobject_caption->save();

    		$mpobject_info=$mpobject->entries()->where('record_id', $id)
    															->where('element_id', 'info')
    															->first();
    		$mpobject_info->text = $request->formData['info'];
    		$mpobject_info->save();

    		/*if (($request->formData['file']))
            { 

                $file = $request->formData['caption'];

                $rules = array('imag' => 'required',);

                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/storage/app/img/', $filename);

                //image to DB
                $image = $mpobject->imageEntry()->where('record_id', $id)
                								->where('record_type', $mpobject->record_type)
                								->first();
                 $image->filename=$filename;
                 $image->save();
    	   }*/

    		if (($request->file('imag')))
            { 

                $file = $request->file('imag');

                $rules = array('imag' => 'required',);

                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/storage/app/img/', $filename);

                //image to DB
                $image = $mpobject->imageEntry()->where('record_id', $id)
                								->where('record_type', $mpobject->record_type)
                								->first();
                 $image->filename=$filename;
                 $image->save();
    	   }


    		//$mpobject_file=$mpbject->imageEntry()->where('record_id', $id)
    															//->where('record_type',  $object->record_type)
    															//->first();
    		//$mpobject_file=$request->filename;

			$data1=-1;
    		//$data1 = $request->hasFile('imag');
			if ($request->hasFile('imag')) 
			{
				$data1=1;
			}
    		
        return "good !!! ";
    	//return $image->filename;
    	//return redirect()->action('MainpageController@index');
    }

    public function store(Request $request)
    {
    	$data1=-1;
    		
			if (Input::file('imag')) 
			{
				$file = Input::file('imag');

                $rules = array('imag' => 'required',);

                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/storage/app/img/', $filename);

                //image to DB
                $image = $mpobject->imageEntry()->where('record_id', $id)
                								->where('record_type', $mpobject->record_type)
                								->first();
                 $image->filename=$filename;
                 $image->save();
			}
    		
        return $data1;
    }

    public function ajax(Request $request)
    {
        $mpobject = Mpobject::find($request->input('id'));
        $mpobject_caption=$mpobject->entries()->where('record_id', $mpobject->id)
                                                                ->where('element_id', 'caption')
                                                                ->first();
            $mpobject_caption->text = $request->input('caption');
            $mpobject_caption->save();

        $mpobject_info=$mpobject->entries()->where('record_id', $mpobject->id)
                                                                ->where('element_id', 'info')
                                                                ->first();
            $mpobject_info->text = $request->input('info');
            $mpobject_info->save();

            

        if ($request->hasFile('imag'))
            { 

                $file = $request->file('imag');

                $rules = array('imag' => 'required',);

                $filename = time() . '.' . $file->getClientOriginalExtension();
        
                $file->move(base_path() . '/storage/app/img/', $filename);

                //image to DB
                $image = $mpobject->imageEntry()->where('record_id', $mpobject->id)
                                                ->where('record_type', $mpobject->record_type)
                                                ->first();
                 $image->filename=$filename;
                 $image->save();
           }



        $data1=-1;
            //$data1 = $request->hasFile('imag');
            $response=array();
            $response[0] = "All records are updated! Have a good Day!";
            
            
            if ($request->hasFile('imag')) 
            {
                $response[1]= $filename;
            }


        return $response;
    }
}
