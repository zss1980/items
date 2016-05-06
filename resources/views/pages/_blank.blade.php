@extends($layouts)

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

@section('body')
<div class="content-wrapper">
<div class="container">

{!! $page_content !!}


@stop