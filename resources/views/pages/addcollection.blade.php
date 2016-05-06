@extends('layouts.admin_layout')

@section('title')
Admin-Add New Collection
@stop

@section('body')
<div class="well">
<h1>Add New Collection</h1>


{!!Form::open(['route'=>'admin.collection.store'])!!}
{!!Form::label('title', 'Title')!!}
{!!Form::text('title','', ['class'=>'form-control'])!!}
{!!Form::label('date', 'Date')!!}
{!!Form::text('date', '', array('id' => 'datepicker', 'class'=>'form-control')) !!}
{!!Form::submit('Add', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
</div>
@stop