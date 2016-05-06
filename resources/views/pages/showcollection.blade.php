@extends('layouts.admin_layout')

@section('title')
Admin
@stop

@section('body')
<h1>Admin Section</h1>
@stop

@section('itemsi')

<h2 class="sub-header">The Collection</h2>
	<div class="well">
		{!!Form::open([
                        'method'=>'patch',
                        'files' => true,
                        'route'=>['admin.collection.update', $collections->id]
                        ])!!}
                  {!! Form::hidden('collection', 'info')!!}
                  
                      
		{!!Form::label('collection_id', 'Id')!!}
		{!!Form::label('collection_id', $collections->id)!!}
		{!!Form::label('collection_title', 'Title')!!}
		{!!Form::text('collection_title', $collections->title, ['class'=>'form-control'])!!}<br>
		{!!Form::label('description', 'Description')!!}
		
		{!!Form::textarea('description', $description->text, ['class'=>'form-control', 'size' => '80x3'])!!}
     {!! Form::label('upload the item image ') !!}
    {!! Form::file('imag', null) !!}
		{!! Form::submit('Update', ['class'=>'btn btn-default'])  !!}
        {!!Form::close()!!}</td>
	</div>
	<div class="itemshow-image">
			@if (isset($image->filename))
				{{-- expr --}}<img src="../../images/{{$image->filename}}?w=120&h=120&fit=crop-top">
			@endif
	</div>
	<div>
		<h2 class="sub-header">Items in collection</h2>
          
            <table id="table_id" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Type</th>
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>

                  <?php $count=0;
                  //$imageview = current($images);
                  //$itemcreator = current($dublin)?>
                  @foreach($items as $itemsi)
                  <td>{{++$count}}</td>
                  <td>{{$itemsi->id}}</td>
                  <td>{{$itemsi->title}}</td>
                  <td>{{$itemsi->type}}</td>
                  <td>{!!Form::open([
                        'method'=>'patch',
                        'route'=>['admin.collection.update', $collections->id]
                        ])!!}
                  {!! Form::hidden('collection', 'out')!!}
                  {!! Form::hidden('item', $itemsi->id)!!}
                      {!! Form::submit('Remove', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}</td>
                </tr>
                <?php //$imageview = next($images);
                //$itemcreator = next($dublin);?>
                @endforeach
              </tbody>
            </table>
        </div>
            <h2 class="sub-header">Items out of collection</h2>
          <div>
            <table id="table_id2" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Type</th>
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $count=0;
                  //$imageview = current($images);
                  //$itemcreator = current($dublin)?>
                  @foreach($itemsout as $itemsiout)
                  <td>{{++$count}}</td>
                  <td>{{$itemsiout->id}}</td>
                  <td>{{$itemsiout->title}}</td>
                  <td>{{$itemsiout->type}}</td>
                  <td>{!!Form::open([
                        'method'=>'patch',
                        'route'=>['admin.collection.update', $collections->id]
                        ])!!}
                  {!! Form::hidden('collection', 'in')!!}
                  {!! Form::hidden('item', $itemsiout->id)!!}
                      {!! Form::submit('Add', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}</td>
                </tr>
                <?php //$imageview = next($images);
                //$itemcreator = next($dublin);?>
                @endforeach
              </tbody>
            </table>
	</div>
@stop