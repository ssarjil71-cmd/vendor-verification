<h2>Reset Password</h2>
<form method="POST" action="{{ route('company.reset.password') }}">
    @csrf
    <input type="password" name="password" placeholder="New Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Reset Password</button>
</form>

