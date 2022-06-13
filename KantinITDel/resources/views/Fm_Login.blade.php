<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset ('img/na3.png') }}">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset ('img/na3.png') }}">
	<div class="container">
		<div class="img">
			{{-- <img src="{{ asset('img/bg.svg') }}" alt=""> --}}
		</div>
		<div class="login-content">
			<form action="{{ route('login') }}" method="POST">
                @csrf
				<img src="{{ asset('img/avatar.svg') }}">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5 @error('email')
							  class="text-danger" role="alert"
						  @enderror>
                          Email
                        @error('email')
                          | {{ $message }}
                        @enderror
                        </h5>
           		   		<input type="Email" class="input" name="email">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5 @error('password')
                           class="text-danger" role="alert"
                       @enderror>
                       Password
                       @error('password')
                        | {{ $message }}
                        @enderror
                        </h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
                <a href="{{ route('register') }}">Belum Memiliki Akun ?</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>
