<div class="container">
	<form action="{{url('login')}}" method="POST">
	<h1 class='center'>Login</h1>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="form-group center">
			<button class="btn">LOGIN</button>
		</div>
	</form>
</div>