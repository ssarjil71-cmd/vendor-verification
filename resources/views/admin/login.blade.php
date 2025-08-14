<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        }

        .login-box h2 {
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            color: #343a40;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .btn-custom {
            background-color: #343a40;
            color: white;
            font-weight: 500;
        }

        .btn-custom:hover {
            background-color: #212529;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Login</button>
                </div>
              <div class="d-grid">
                    <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
                    
                </div>
            </form>
        </div>
    </div>

</body>
</html>
