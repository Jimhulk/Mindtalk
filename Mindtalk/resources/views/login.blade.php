@extends('layout')

@section('title', 'Log in')

@section('main-style', 'grid-template-rows:25% 280px')

@section('content')
    <form method="POST" action=" {{ route('loginCheck') }} ">
        {{csrf_field()}}
        <text>Login</text>
        <br>
        <br>
        <input type="email" name="log_email" placeholder="Email" required>
        <br>
        <br>
        <input type="password" name="log_psw" placeholder="Password" required>
        <br>
        <br>
        <button type="submit">Log in</button>
    </form>
    <br>
    <a href=" {{ route('registrationPage') }} ">Create a new account</a>
    <br>
    <a href=" {{ route('homepage') }} ">Continue as a guest</a>

@if(Session::has('success'))
    <div style="color:white"><br><br>{{Session::get('success')}}</div>
@endif
@if(Session::has('fail'))
    <div style="color:white"><br><br>{{Session::get('fail')}}</div>
@endif
@endsection