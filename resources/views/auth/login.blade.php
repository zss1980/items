@extends('layouts.layout_it_sh')
@section('body')

<div class="login-form well" >
<form method="POST" action="login">
    {!! csrf_field() !!}
<div>
    <div>
        Email
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit" class="btn btn-default">Login</button>
    </div>
</form>
</div>
<div>
@stop