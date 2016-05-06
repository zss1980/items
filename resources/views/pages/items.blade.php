@extends('layouts.layout_it')

@section('title')
Items
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

@section('body')



<div class="content-wrapper">
<div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ url('/') }}">Home</a></li>
      <li class="active">Items</li>
    </ul>
 <?php $count=0; $counts=0;?>
 <div class="row">    
  @foreach($items as $itemsi)
  
    <?php
    $imageview=current($images); ?>

    @if ($count<3)
    	<div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading panel-heading-custom2">{{ $itemsi->title }}</div>
        <div class="panel-body"><div id="item-image{{ $itemsi->id }}"> 
	<a href="javascript:void(0)" onclick = "document.getElementById('light{{ $itemsi->id }}').style.display='block';  document.getElementById('fade').style.display='block'"><img src="./images/{{ $imageview }}?w=210&h=210&fit=crop" class="img-responsive" style="width:100%" alt="Image"></a></div>
	<div id="light{{ $itemsi->id }}" class="white_content"><img src="./images/{{ $imageview }}?w=600&h=600&fit=crop-top-left&mark=logo.png"><a href = "javascript:void(0)" onclick = "document.getElementById('light{{ $itemsi->id }}').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
	</div>
        <div class="panel-footer"><b>Type:</b>
				{{$itemsi->type}} <b>Created:</b>{{$itemsi->created}}{!!Form::open([
                        'method'=>'get',
                        'route'=>['items.show', $itemsi->id]
                        ])!!}
                      {!! Form::submit('Open Item', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}</div>
      </div>
    </div>
    @else
    	</div>
		<div class="row">
   <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading panel-heading-custom2">{{ $itemsi->title }}</div>
        <div class="panel-body"><div id="item-image{{ $itemsi->id }}"> 
	<a href="javascript:void(0)" onclick = "document.getElementById('light{{ $itemsi->id }}').style.display='block';  document.getElementById('fade').style.display='block'"><img src="./images/{{ $imageview }}?w=210&h=210&fit=crop" class="img-responsive" style="width:100%" alt="Image"></a></div>
	<div id="light{{ $itemsi->id }}" class="white_content"><img src="./images/{{ $imageview }}?w=600&h=600&fit=crop-top-left&mark=logo.png"><a href = "javascript:void(0)" onclick = "document.getElementById('light{{ $itemsi->id }}').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
        <div class="panel-footer"><b>Type:</b>
				{{$itemsi->type}} <b>Created:</b>{{$itemsi->created}}{!!Form::open([
                        'method'=>'get',
                        'route'=>['items.show', $itemsi->id]
                        ])!!}
                      {!! Form::submit('Open Item', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}</div>
      </div>
    </div>
    </div>
    <?php $count=0?>
    @endif

	<?php $count++; $counts++;
	$imageview=next($images); ?>
	
@endforeach
{{-- <img src='http://placehold.it/150x80?text=IMAGE' class='img-responsive' style='width:100%' alt='Image'> --}}
    {{-- row is closed here --}}
  </div>
<br>
<?php echo $items->render();?>

                <h4>Total items: <?php echo $counts?></h4>
@stop