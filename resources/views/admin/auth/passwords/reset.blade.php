<!DOCTYPE html>
<html>
<head>
    <title>Admin Reset Password</title>
</head>
<body>
    <h2>Admin Reset Password</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" value="{{ $email ?? old('email') }}" required readonly>
        <br><br>

        <input type="password" name="password" placeholder="New password" required>
        <br><br>

        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
        <br><br>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
