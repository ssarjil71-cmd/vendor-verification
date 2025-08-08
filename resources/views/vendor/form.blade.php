<!DOCTYPE html>
<html>
<head>
    <title>Vendor Form</title>
</head>
<body>
    <h2>Vendor Form for {{ $vendor->name }}</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST">
        @csrf
        <label>PAN Number:</label>
        <input type="text" name="pan_number" required><br><br>

        <label>Aadhar Number:</label>
        <input type="text" name="aadhar_number" required><br><br>

        <label>Bank Account:</label>
        <input type="text" name="bank_account" required><br><br>

        <label>IFSC Code:</label>
        <input type="text" name="ifsc_code" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
