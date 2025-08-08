<!DOCTYPE html>
<html>
<head>
    <title>Company Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #4e73df;
            font-weight: 600;
        }
        .form-control {
            height: 45px;
            border-radius: 5px;
        }
        .btn-login {
            background-color: #4e73df;
            border: none;
            height: 45px;
            font-weight: 600;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2>Company Login</h2>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('company.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required />
                </div>

                <button type="submit" class="btn btn-primary btn-login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>