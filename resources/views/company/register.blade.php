<h2>Company Register</h2>
<form method="POST" action="{{ route('company.register.submit') }}">
    @csrf
    <input type="text" name="name" placeholder="Company Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>
    <button type="submit">Register</button>
</form>
