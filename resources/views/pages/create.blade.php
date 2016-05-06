@extends('layouts.admin_layout')

@section('title')
Admin-Add New Item
@stop

@section('body')
<div class="register-form well">
<h1>Add New Item</h1>


{!!Form::open(['route'=>'admin.item.store'])!!}
{!!Form::label('title', 'Title')!!}
{!!Form::text('title','', ['class'=>'form-control'])!!}
{!!Form::label('type', 'Type')!!}
{!!Form::text('type', '', ['class'=>'form-control'])!!}
{!!Form::label('created', 'Created')!!}

{!!Form::text('created', '', array('id' => 'datepicker', 'class'=>'form-control')) !!}
{!!Form::submit('Add', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}
</div>
@stop