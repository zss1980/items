@extends('layouts.admin_layout')

@section('title')
Admin-Content Edit of {{ $page->title }}
@stop

@section('body')
<h1>Editing of "{{ $page->title }}" page</h1>
@stop

@section('itemsi')
{!!Form::open(['route'=>'admin.page-manager.store'])!!}
{{ Form::textarea('content', $page->content, ['class'=>'form-control']) }}
{{ Form::hidden('type', '2') }}
{{ Form::hidden('id', $page->id) }}
{!!Form::submit('Save', ['class'=>'btn btn-default'])!!}
{!!Form::close()!!}

@stop