@extends('layouts.admin_layout')

@section('title')
{{ $item->title }}
@stop
@section('scripts')
<script> 

  $(document).ready(function(){
    $(".btn1J").click(function(){
        $(".details").hide();
    });
    $(".btn2J").click(function(){
        $(".details").show();
    });
});  
</script>


@stop

@section('body')

<div class="well">
<h1>Item</h1>


{!!Form::open([
	'method'=>'patch',
	'files' => true,
	'route'=>['admin.item.update', $item]
	])!!}
{!!Form::label('title', 'Title')!!}
{!!Form::text('title', $item->title, ['class'=>'form-control'])!!}
{!!Form::label('type', 'Type')!!}
{!!Form::text('type', $item->type, ['class'=>'form-control'])!!}
{!!Form::label('created', 'Created')!!}
{!!Form::text('created', $item->created, array('class'=>'form-control', 'id' => 'datepicker'))!!}
{!!Form::label('public', 'Published (0-no;1-yes)')!!}
{!!Form::text('public', $item->public, ['class'=>'form-control'])!!}
<br>
    <?php $countim=0?>
    @foreach($imageview as $imageviews)
    <div class='itim-image'> <a href="javascript:void(0)" onclick = "document.getElementById('light{{$item->id}}{{$countim}}').style.display='block';document.getElementById('fade').style.display='block'"><img src="../../images/{{$imageviews->filename}}?w=110&h=110&fit=crop"></a>

    {!!Form::label('public', 'active: ')!!}
    <?php if ($imageviews->output==1)
    {
        $checked=true;
    }
    else 
    {
        $checked=false;
    }
    ?>
    {!!Form::radio('output', $imageviews->filename, $checked)!!}
    {!!Form::checkbox('delete', $imageviews->filename)!!}
    {!!Form::label('delete', '- delete ')!!}
    </div>
    <div id="light{{$item->id}}{{$countim}}" class="white_content"><img src="../../images/{{$imageviews->filename}}"><a href = "javascript:void(0)" onclick = "document.getElementById('light{{$item->id}}{{$countim}}').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
    <?php $countim++?>
    @endforeach
    {!! Form::label('upload the item image ') !!}
    {!! Form::file('image', null) !!}

<br>
<?php 
    $data=array();
    $count=0;
    if ($dublin) 
    {
        
        foreach ($dublin as $dublino)
        {
            if ($dublino) 
            {
                $data[]=$dublino['text'];
            }   
            else 
            {
                $data[]="no data";
            }
            $count++;
    

        }
    }
         if ($count == 12) 
         {
            list($item->subject, $item->source, 
         $item->rights, $item->relation, $item->publisher, 
            $item->language, $item->identifier, $item->format, 
            $item->description, $item->creator, $item->coverage,
            $item->contributor) = $data;
        } 
        else {
            for ($count=0;$count<13;$count++)
            {
            
                $data[]="no data";
            }
            list($item->subject, $item->source, 
         $item->rights, $item->relation, $item->publisher, 
            $item->language, $item->identifier, $item->format, 
            $item->description, $item->creator, $item->coverage,
            $item->contributor) = $data;
        }
    
       
?></div><h3>Dublin Core Meta Data</h3>
<div class="well"><div id="tabs">
  <ul>
    <li><a href="#tabs-1">Subject</a></li>
    <li><a href="#tabs-2">Source</a></li>
    <li><a href="#tabs-3">Rights</a></li>
    <li><a href="#tabs-4">Relation</a></li>
    <li><a href="#tabs-5">Publisher</a></li>
    <li><a href="#tabs-6">Language</a></li>
    
</ul>

  <div id="tabs-1">
    <p>
{!!Form::textarea('subject', $item->subject, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-2">
    <p>
{!!Form::textarea('source', $item->source, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-3">
    <p>
{!!Form::textarea('rights', $item->rights, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-4">
    <p>
{!!Form::textarea('publisher', $item->publisher, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-5">
    <p>
{!!Form::textarea('relation', $item->relation, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-6">
    <p>
{!!Form::textarea('language', $item->language, ['size' => '80x3'])!!}<br></p>
  </div>
  
</div>

<div id="tabsi">
  <ul>
    <li><a href="#tabs-7">Identifier</a></li>
    <li><a href="#tabs-8">Format</a></li>
    <li><a href="#tabs-9">Description</a></li>
    <li><a href="#tabs-10">Creator</a></li>
    <li><a href="#tabs-11">Coverage</a></li>
    <li><a href="#tabs-12">Contributor</a></li>
</ul>
  
  <div id="tabs-7">
    <p>
{!!Form::textarea('identifier', $item->identifier, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-8">
    <p>
{!!Form::textarea('format', $item->format, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-9">
    <p>
{!!Form::textarea('description', $item->description, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-10">
    <p>
{!!Form::textarea('creator', $item->creator, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-11">
    <p>
{!!Form::textarea('coverage', $item->coverage, ['size' => '80x3'])!!}<br></p>
  </div>
  <div id="tabs-12">
    <p>
{!!Form::textarea('contributor', $item->contributor, ['size' => '80x3'])!!}</p>
  </div>
</div>
</div>
<div class="details"></div>
{!!Form::submit('Update', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}

{!!Form::open([
	'method'=>'delete',
	'route'=>['admin.item.destroy', $item->id]
	])!!}
{!!Form::submit('Delete', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}


@stop