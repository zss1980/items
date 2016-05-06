@extends('layouts.layout_it_sh')

@section('breadcrom')


@stop

@section('menu')

<ul class="nav navbar-nav">

           @foreach ($pages as $page)


           @if ($page->issection==0 && $page->parent==1) 
           <li class="{{ Request::path() ==  $page->route ? 'active' : ''}}"><a href="{{ url($page->route) }}">{{ $page->caption }}</a></li>
           @endif

           @if ($page->issection!=0)
<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{ $page->caption }}
              <b class="caret"></b>
            </a>
              <ul class="dropdown-menu">
           @foreach ($page->children as $subpage) 

                  <li class="{{ Request::path() ==  $subpage->name ? 'active' : ''}}"><a href="{{ url($subpage->name) }}">{{ $subpage->caption }}</a></li>
              

           


           @endforeach
           </ul>
          </li>
@endif
           @endforeach
              

</ul>

@stop

@section('title')
{{ $item->title }}
@stop
@section('body')

<div class="content-wrapper">
<div class="container">
<ul class="breadcrumb">
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('items') }}">Items</a></li>
      <li class="active">{{ $item->title }}</li>
    </ul>
<div class="row">
<div class="container text-center"><h2 >{{ $item->title }}</h2></div>
  <div class="col-sm-8">
    
        <div class="item active">
          <img class="img-responsive" style="width:100%" alt="Image" src=".././images/{{$imageview->filename}}?w=100%&h=100%&fit=crop-top">
         
          </div>      
        </div>
     

     
    
  

  <div class="col-sm-4">
    <div class="well">
      <p><b>Title:</b>{{ $item->title }}</p>
    
       <p><b>Created:</b>{{ $item->created }}</p>
   
       <p><b>Type:</b>{{ $item->type }}</h4></p>
       </div>
       @foreach ($dublin as $data)
       		@if ($data->text!="empty_string")
       			<div class="well">
       			<p><b>{{ $data->element_id }}:</b>{{ $data->text }}</h4></p>
       			</div>
       		@endif
       		

       @endforeach
    
  </div>
</div>
<hr>



	

@stop