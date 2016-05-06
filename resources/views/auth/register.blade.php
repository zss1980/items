@extends('layouts.layout_it_sh')
@section('body')
<div class="register-form well">
<form method="POST" action="register">
    {!! csrf_field() !!}

    <div>
        Name
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" class="form-control" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" class="form-control" name="password_confirmation">
    </div>

    <div>
        <button type="submit" class="btn btn-default">Register</button>
    </div>
</form>
</div>
@stop