@extends('layouts.admin_layout')

@section('title')
Admin
@stop

@section('body')
<h1>Admin Section</h1>
@stop

@section('itemsi')

<h2 class="sub-header">All Items</h2>
          
            <table id="table_id" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th>Published</th>
                  <th>Creator</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $count=0;
                  $imageview = current($images);
                  $itemcreator = current($dublin)?>
                  @foreach($items as $itemsi)
                  <th>{{++$count}}</th>
                  <td>{{$itemsi->id}}</td>
                  <td>{{$itemsi->title}}</td>
                  <td>{{$itemsi->type}}</td>
                  <td>{{$itemsi->created}}</td>
                  <td>{{$itemsi->public}}</td>
                  <td>{{$itemcreator}}</td>
                  <td><img src=".././images/{{$imageview}}?w=110&h=110&fit=crop"></td>
                  <td>
                      {!!Form::open([
                        'method'=>'get',
                        'route'=>['admin.item.show', $itemsi->id]
                        ])!!}
                      {!! Form::submit('View', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                    </td>
                </tr>
                <?php $imageview = next($images);
                $itemcreator = next($dublin);?>
                @endforeach
              </tbody>
            </table>
        
          {{ base_path() }}
@stop