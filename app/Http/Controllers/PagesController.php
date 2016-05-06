<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\Route;

class PagesController extends Controller
{
    public function index($pag)
    {
    	
    	
    	$menu = $this->buildmenu();

        if(Page::where('title', $pag)->first())
        {
            $page = Page::where('title', $pag)->first();
            $page->url = $page->pageRoute()->where('record_id', $page->id)->first()->name;

            $layouts = 'layouts.layout_dyn';
            

        return view('pages._blank')->with('layouts', $layouts)
                                    ->with('page_content', $page->content)
                                    ->with('currenturl', $page->url)
                                    ->with('pages', $menu);

        } else 
        {
            return view('errors.404_')->with('pages', $menu);
        }

   }


    public function buildmenu()
    {
    	$pages = Page::where('activated', 1)->get();
    	foreach ($pages as $page) 
    	{
    		
	    		$page->route=$page->pageRoute()->where('record_id', $page->id)->first()->name;
	    		$page->caption=$page->pageRoute()->where('record_id', $page->id)->first()->caption;
	    		//$page->parent=$page->pageRoute()->where('record_id', $page->id)->first()->parent;//wrong logic
	    		
                if ($page->issection!=0)
	    		{
	    			$children = Route::where('parent', $page->id)->get();

                    $count=0;

                    //if (is_array($children))
                    //{

                    foreach ($children as $child)
                    {
                        if (Page::find($child->id))
                        {
                            if (Page::find($child->id)->activated!=1)
                            {
                                unset($children[$count]);

                            }
                        }
                        $count++;
                    }
                $page->children = $children;
                //} else 
                //{
                    /*if (Page::find($children->id)->activated==1)
                    {
                        $page->children = $children;
                    }*/
                  //  $page->children =array();
                //}


                    
	    		}
	    		$page->position=$page->pageRoute()->where('record_id', $page->id)->first()->position;
	    		$page->ischild=$page->pageRoute()->where('record_id', $page->id)->first()->ischild;
	    		$page->isparent=$page->pageRoute()->where('record_id', $page->id)->first()->isparent;
    		

    	
    	}

    	return $pages;
    }
}
