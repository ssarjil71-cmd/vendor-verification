<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px; border-radius: 15px;">
        <h3 class="text-center mb-4 text-primary">Company Forgot Password</h3>
        <form method="POST" action="{{ route('company.forgot.sendOtp') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Registered Email</label>
                <input type="email" name="email" id="email" 
                       class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 py-2">
                Send OTP
            </button>

            <!-- Back to Login -->
            <div class="text-center mt-3">
                <a href="{{ route('company.login') }}" class="text-decoration-none">Back to Login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
