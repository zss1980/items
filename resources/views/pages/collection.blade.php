@extends('layouts.admin_layout')

@section('title')
Admin
@stop

@section('body')
<h1>Admin Section</h1>
@stop

@section('itemsi')

<h2 class="sub-header">All Collections</h2>

<table id="table_id" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Date</th>
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $count=0;
                  //$imageview = current($images);
                  //$itemcreator = current($dublin)?>
                  @foreach($collections as $collection)
                  <th>{{++$count}}</th>
                  <td>{{$collection->id}}</td>
                  <td>{{$collection->title}}</td>
                  <td>{{$collection->date}}</td>
                  
                  <td>
                      {!!Form::open([
                        'method'=>'get',
                        'route'=>['admin.collection.show', $collection->id]
                        ])!!}
                      {!! Form::submit('View', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                      {!!Form::open([
                        'method'=>'delete',
                        'route'=>['admin.collection.destroy', $collection->id]
                        ])!!}
                      {!! Form::submit('Delete', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                    </td>
                </tr>
                <?php //$imageview = next($images);
                //$itemcreator = next($dublin);?>
                @endforeach
              </tbody>
            </table>

@stop