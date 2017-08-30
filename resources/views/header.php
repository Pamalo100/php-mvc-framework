<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>WSC2017_DataManager</title>
	<link rel="stylesheet" href="{{assets('css/style.css')}}">
</head>
<body>
<div class='navbar'>
	<div class="container flex space">
		<nav>
			<ul class="flex">
				<li><a href="{{url('place')}}">Place</a></li>
			</ul>
		</nav>
		<nav>
			<ul class="flex">
			@use Kernel\Auth@
			@if(Auth::check()):@
				<li><a>Hi, {{Auth::user()['username']}}</a></li>
				<li><a href="{{url('logout')}}">Logout</a></li>
			@else:@
				<li><a href="{{url('login')}}">Login</a></li>
			@endif@
			</ul>
		</nav>
	</div>
</div>
<div class='container'>
	@use Kernel\Session @
	@if(Session::has('error')):@
		<div class='alert alert-danger'>
		{{Session::flash('error')}}
		</div>
	@endif@

	@if(Session::has('success')):@
		<div class='alert alert-success'>
		{{Session::flash('success')}}
		</div>
	@endif@
</div>