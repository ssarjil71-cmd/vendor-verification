<h2>Verify OTP</h2>
<form method="POST" action="{{ route('company.verify.otp') }}">
    @csrf
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <button type="submit">Verify</button>
</form>
