<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\Route;

class PageManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::where('issection', '0')->where('owner', 1)->get();

        foreach ($pages as $page) 
        {
            $page->section = Page::find($page->pageRoute()->where('record_id', $page->id)->first()->parent)->id;

        }

        
        $sections = Page::where('issection', '1')->get();
        


        $sectionsselect=Page::where('issection', '1')->lists('title', 'id');


        return view('pages.adminpagemanager')->with('pages', $pages)
                                                ->with('sections', $sections)
                                                ->with('selections', $sectionsselect);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type==0)
        {
            $section = new Page;
            $sectionroute = new Route;
            $section->title=strtolower($request->title);
            $section->activated=0;
            $section->issection=1;
            $section->owner=1;
            $section->parent=1;
            $section->save();
            $sectionroute->record_id=$section->id;
            $sectionroute->name = 'show/' . $section->title;
            $sectionroute->caption = $section->title;
            $sectionroute->isparent=1;
            $sectionroute->parent=1;
            $sectionroute->save();

            

        }
        if ($request->type==1)
        {
            $page = new Page;
            $pageroute = new Route;
            $page->title=strtolower($request->title);
            $page->activated=0;
            $page->issection=0;
            $page->owner=1;
            $page->parent=0;
            $page->save();
            $pageroute->record_id=$page->id;
            $pageroute->name = 'show/' . strtolower($request->title);
            $pageroute->caption = $page->title;
            $pageroute->isparent=0;
            $pageroute->ischild=1;
            $pageroute->parent=$request->section;
            $pageroute->save();

            

        }

        if ($request->type==2)
        {
            $page = Page::find($request->id);
            
            $page->content=$request->content;
            $page->save();
           
            

        }

        return redirect()->action('PageManagerController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page=Page::find($id);

        return view('pages.admineditcontent')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Page::find($id)->owner!=0)
        {
            $page=Page::find($id);
            $page->title=strtolower($request->title);
            $page->activated=$request->activated;
             $page->save();

             $route=$page->pageRoute()->where('record_id', $id)->first();
             $route->caption=$request->title;
             $route->name='show/' . strtolower($request->title);
             if ($request->section)
            {   
                $route->parent=$request->section;
                        
            }


             $route->save();
        }

         return redirect()->action('PageManagerController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Page::find($id)->issection==1)
        {
            $orphants = Route::where('parent', $id)->get();
            foreach ($orphants as $orphant) 
            {
               $orphant->parent=21;
               $orphant->save();
            }
        }

        if (Page::find($id)->owner!=0)
        {
            Page::destroy($id);
            $idroute=Route::where('record_id', $id)->first()->id;
            Route::destroy($idroute);
        }
        return redirect()->action('PageManagerController@index');
    }
}
