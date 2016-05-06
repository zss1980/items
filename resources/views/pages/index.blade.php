@extends('layouts.layout_')

@section('title')
Home
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


<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
@foreach ($mpobjects as $mpobject)

@if ($mpobject->record_type==2)
 <?php 
    if (!isset($count))
    {
      $count=1;
      $active = 'active';
     
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
        $active = '';
      }
    }

  ?> 
<div class="item {{ $active }}">
          <img class="first-slide img-responsive" src="./images/{{ $mpobject->filename }}"  alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>{{ $mpobject->caption }}</h1>
              <p>{{ $mpobject->info }}</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>


<?php 
    if ($count==3) {

      unset($count);
      unset($active);
      echo "</div><a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
        <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
        <span class='sr-only'>Previous</span>
      </a>
      <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
        <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
        <span class='sr-only'>Next</span>
      </a>
    </div><!-- /.carousel -->";
    }
    
  ?>
   
 @endif

@if ($mpobject->record_type==3)
 <?php 
    if (!isset($count))
    {
      $count=1;
      $active = 'active';
      echo "<!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class='container marketing'>

      <!-- Three columns of text below the carousel -->
      <div class='row'>";
     
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
        
      }
    }

  ?> 
<div class="col-lg-4">
          <img class="img-circle" src="./images/{{ $mpobject->filename }}" alt="Generic placeholder image" width="140" height="140">
          <h2>{{ $mpobject->caption }}</h2>
          <p>{{ $mpobject->info }}</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>




<?php 
    if ($count==3) {

      unset($count);
      
      echo "</div><!-- /.row -->";
    }
    
  ?>
   
 @endif


@if ($mpobject->record_type==4)
 <?php 
    if (!isset($count))
    {
      $count=1;
      
     
    } 
    else 
    {
      if ($count<3) 
      {
        $count++;
        
      }
    }
    if ($count==2)
    {
    	$right1='col-md-push-5';
    	$right2='col-md-pull-7';

    } else
    {
    	$right1='';
    	$right2='';
    }

  ?> 
<hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 {{ $right1 }}">
          <h2 class="featurette-heading">{{ $mpobject->caption }} <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">{{ $mpobject->info }}</p>
        </div>
        <div class="col-md-5 {{ $right2 }}">
          <img class="img-rounded featurette-image img-responsive center-block" src="./images/{{ $mpobject->filename }}?w=500&h=500&fit=crop" alt="Generic placeholder image">
        </div>
      </div>




<?php 
    if ($count==3) {

      unset($count);
      
      echo "<hr class='featurette-divider'>";
    }
    
  ?>
   
 @endif


 @endforeach

    


      

     
@stop
