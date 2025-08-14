<!DOCTYPE html>
<html>
<head>
    <title>Admin Password Reset Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 15px;">
            
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">🔐 Admin Forgot Password</h3>
                <p class="text-muted">Enter your email to receive a reset link</p>
            </div>

            {{-- Success Message --}}
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Admin Email</label>
                    <input type="email" name="email" id="email" 
                        class="form-control form-control-lg" 
                        placeholder="Enter admin email" 
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('admin.login') }}" class="text-decoration-none">⬅ Back to Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
