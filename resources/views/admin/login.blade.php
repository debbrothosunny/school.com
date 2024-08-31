<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>
  
  <!-- Google Font: Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
  
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f2f4f7;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      width: 100%;
      max-width: 1000px;
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      overflow: hidden;
    }

    .illustration {
      flex: 1;
      background: #4e3efc;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      color: #ffffff;
      text-align: center;
    }

    .illustration h1 {
      font-size: 1.5em;
      font-weight: 600;
      margin: 0;
    }

    .login-form {
      flex: 1;
      padding: 40px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .login-form h2 {
      margin-bottom: 20px;
      font-weight: 600;
      color: #333333;
    }

    .form-control {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    .btn-primary {
      background-color: #4e3efc;
      border-color: #4e3efc;
      padding: 15px;
      border-radius: 5px;
      width: 100%;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #3729d1;
    }

    .login-form .forgot-password {
      text-align: right;
      width: 100%;
      margin-top: -10px;
      margin-bottom: 20px;
      color: #666;
    }

    .login-form .forgot-password a {
      color: #4e3efc;
      text-decoration: none;
    }

    .login-form .forgot-password a:hover {
      text-decoration: underline;
    }

    .login-form .remember-me {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 100%;
      margin-bottom: 20px;
      color: #666;
    }

    .login-form .remember-me input {
      margin-right: 10px;
    }
  </style>
</head>
<body>    

  <div class="container">
    <div class="illustration">
      <h1>School Management System</h1>
    </div>
    <div class="login-form">
      <h2>Welcome</h2>
      <form action="{{ route('login') }}" method="post">
        @csrf

        <!-- Display error message -->
        @if(session('error'))
          <div style="color: red; margin-bottom: 20px;">
              {{ session('error') }}
          </div>
        @endif

        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <div class="remember-me">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Remember Me</label>
        </div>

        <div class="forgot-password">
          <!-- <a href="{{ route('forget_password') }}">Forgot Password?</a> -->
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>

<!-- jQuery -->
<script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
