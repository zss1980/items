@extends('layouts.layout_it')

@section('title')
404- Not found
@stop
@section('body')
<div class="content-wrapper"><div class="container">
<div class="well">
<h1><small>Ups, it seems that there is no such page...</small></h1></div>


@stop

@section('menu')

<ul class="nav navbar-nav">

           @foreach ($pages as $page)


           @if ($page->parent==0) 
           <li class="{{ Request::path() ==  $page->route ? 'active' : ''}}"><a href="{{ url($page->route) }}">{{ $page->caption }}</a></li>
           @endif

           @if ($page->parent!=0)
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