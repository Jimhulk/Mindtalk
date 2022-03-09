@extends('layout')

@section('title', 'Registration')

<style>
	.alert{
		text-align: center;
		color:white;
	}
</style>

@section('content')
    <text>Registration</text>
		<br>
		<br>
		<form method="post" action=" {{route('registrationCheck')}} ">
			{{csrf_field()}}
			<input type="text" name="fname" placeholder="First Name" required>
			<span>@error('reg_fname') {{$message}}@enderror</span>
			<br>
			<br>
			<input type="text" name="lname" placeholder="Last Name" required>
			<span>@error('reg_lname') {{$message}}@enderror</span>
			<br>
			<br>
			<input type="text" name="username" placeholder="Username" required>
			<span>@error('reg_usr') {{$message}}@enderror</span>
			<br>
			<br>
			<input type="email" name="email" placeholder="Email" required>
			<span>@error('reg_email') {{$message}}@enderror</span>
			<br>
			<br>
			<input type="password" name="password" placeholder="Password" required>
			<span>@error('reg_psw') {{$message}}@enderror</span>
			<br>
			<br>
			<button type="submit">Submit</button>
		</form>
        <br>
		<a href=" {{ route('loginPage') }} ">Already have an account?</a>

@if(Session::has('success'))
	<div style="color:white"><br><br>{{Session::get('success')}}</div>
@endif
@if(Session::has('fail'))
	<div style="color:white"><br><br>{{Session::get('fail')}}</div>
@endif

@if ($errors->any())
    <div class="alert">
		<br>
		<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection