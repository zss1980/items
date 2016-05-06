@extends('layouts.layout_i')

@section('title')
all items
@stop

@section('itemsi')
<h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Type</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  {{$count=0}}
                  @foreach($items as $itemsi)
                  
                  
                  <td>{{++$count}}</td>
                  <td>{{$itemsi->id}}</td>
                  <td>{{$itemsi->title}}</td>
                  <td>{{$itemsi->type}}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
@stop