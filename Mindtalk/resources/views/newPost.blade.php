@extends('master')

@section('title', 'New Post')

<style>
    body{
        /*background-color:rgb(31, 41, 3);*/
        background-image: url('');
    }
</style>

@section('content')
    @if(Session::has('success'))
		<div>{{Session::get('success')}}</div>
	@endif
	@if(Session::has('fail'))
		<div>{{Session::get('fail')}}</div>
	@endif
    <h3>Create new post</h3>
    <br>
    <form id="form" action=" {{ route('addPost') }} " method="POST">
        {{csrf_field()}}
        Title: <input type="text" name="title" size="58" required>
        <button type="submit">Create new post</button>
        <br>
        <br>
        <textarea rows="20" cols="80" name="content" form="form" placeholder="Enter text here..." required></textarea>
    </form>
@endsection