@extends('layouts.layout_it')

@section('title')
Collections
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
     	<li class="active">Collections</li>
    </ul>
			<div class="row">
			
				<?php $counts=0; $count=0;
				$images=current($image);
				$descriptions=current($description);?>

			@foreach($collections as $collection)
			@if ($counts<2)
				
				<div class="col-sm-6">

     				<div class="panel panel-info">
     					
     					<div class="panel-heading panel-heading-custom">{{ $collection->title }}
     					</div>
     						
     						<div class="panel-body">
     						<div class="row">
     							<div class="col-md-3">
     							@if (isset($images))
									<img src="../../images/{{$images}}?w=120&h=120&fit=crop-top"></div>
								@endif	
								<div class="col-md-9"><h5><b>Description:</b>{{$descriptions}}</h5></div>
								</div>
     						</div>
     					
     					<div class="panel-footer">{!!Form::open([
                       	 	'method'=>'get',
                        	'route'=>['collections.show', $collection->id]
                        	])!!}
                      		{!! Form::submit('Open Collection', ['class'=>'btn btn-default'])  !!}
                      		{!!Form::close()!!}
     					</div>

     				</div>

     			</div>

     			<?php $counts++;  $count++;
				$images=next($image);
				$descriptions=next($description);?>	
			@else
			</div>

			<div class="row">

				<div class="col-sm-6">

     				<div class="panel panel-info">
     					
     					<div class="panel-heading panel-heading-custom">{{ $collection->title }}</div>
     					
     					<div class="panel-body">
     						<div class="row">
     							<div class="col-md-3">
     							@if (isset($images))
									<img src="../../images/{{$images}}?w=120&h=120&fit=crop-top"></div>
								@endif	
								<div class="col-md-9"><h5><b>Description:</b>{{$descriptions}}</h5>
	     						</div>
     						</div>
     					</div>
     					<div class="panel-footer">{!!Form::open([
	                        'method'=>'get',
	                        'route'=>['collections.show', $collection->id]
	                        ])!!}
	                      	{!! Form::submit('Open Collection', ['class'=>'btn btn-default'])  !!}
	                     	 {!!Form::close()!!}
     					</div>

     				</div>
     				
     			</div>
     			
     			
     			<?php $counts=0; $count++;
				$images=next($image);
				$descriptions=next($description);?>		
			@endif
			
     		@endforeach
		</div>
	


<?php echo $collections->render();?>

                <h4>Total collections: <?php echo $count?></h4>
@stop