@extends('layouts.admin_layout')

@section('title')
Admin-PageManager
@stop

@section('body')
<h1>Admin Section</h1>
@stop

@section('itemsi')
PageManager


<h2 class="sub-header">All pages</h2>

<table id="table_id" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Page Name</th>
                  <th>Published(0-no;1-yes)</th>
                  <th>Page Section</th>
                  
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $count=0;
                  //$imageview = current($images);
                  //$itemcreator = current($dublin)?>
                  @foreach($pages as $page)
                  <th>{{++$count}}</th>{!!Form::open([
                        'method'=>'PATCH',
                        'route'=>['admin.page-manager.update', $page->id]
                        ])!!}
                  <td>{{Form::input('text', 'title', $page->title, ['class'=>'form-control'])}}</td>
                  <td>{{Form::input('text', 'activated', $page->activated, ['class'=>'form-control'])}}</td>
                  <td>{!!Form::select('section', $selections, $page->section, ['class'=>'form-control'])!!}</td>
                  
                  
                  <td>
                      {!! Form::submit('Modify', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                      {!!Form::open([
                        'method'=>'delete',
                        'route'=>['admin.page-manager.destroy', $page->id]
                        ])!!}
                      {!! Form::submit('Delete', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                      {!!Form::open([
                        'method'=>'GET',
                        'route'=>['admin.page-manager.edit', $page->id]
                        ])!!}
                        {!!Form::hidden('status', 'before')!!}
                      {!! Form::submit('Edit Content', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                    </td>
                </tr>
                <?php //$imageview = next($images);
                //$itemcreator = next($dublin);?>
                @endforeach
              </tbody>
            </table>
<div class="well">
<h2 class="sub-header">Add New Page</h2>


{!!Form::open(['route'=>'admin.page-manager.store'])!!}
{!!Form::label('title', 'Page Name:')!!}
{!!Form::text('title','', ['class'=>'form-control'])!!}
{!!Form::select('section', $selections, '', ['class'=>'form-control'])!!}
{{ Form::hidden('type', '1') }}
{!!Form::submit('Add', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
</div>
<h2 class="sub-header">All sections</h2>

<table id="table_id2" class="display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Section Name</th>
                  <th>Published (0-no, 1-yes)</th>
                  
                  
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $count=0;
                  //$imageview = current($images);
                  //$itemcreator = current($dublin)?>
                  @foreach($sections as $section)
                  <th>{{++$count}}</th> {!!Form::open([
                        'method'=>'PATCH',
                        'route'=>['admin.page-manager.update', $section->id]
                        ])!!}
                  <td>{{Form::input('text', 'title', $section->title, ['class'=>'form-control'])}}</td>
                  <td>{{Form::input('text', 'activated', $section->activated, ['class'=>'form-control'])}}</td>
                  
                  
                  
                  <td>
                      
                      {!! Form::submit('Modify', ['class'=>'btn btn-default'])  !!}
                      {!!Form::close()!!}
                      {!!Form::open([
                        'method'=>'delete',
                        'route'=>['admin.page-manager.destroy', $section->id]
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
<div class="well">
<h2 class="sub-header">Add New Section</h2>


{!!Form::open(['route'=>'admin.page-manager.store'])!!}
{!!Form::label('title', 'Section Name:')!!}
{!!Form::text('title','', ['class'=>'form-control'])!!}
{{ Form::hidden('type', '0') }}
{!!Form::submit('Add', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
</div>

@stop