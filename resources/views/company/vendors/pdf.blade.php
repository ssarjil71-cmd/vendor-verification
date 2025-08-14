<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vendor #{{ $vendor->id }} Details</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        td, th { padding:6px; border:1px solid #ddd; vertical-align: top; }
        th { background:#f2f2f2; text-align:left; }
    </style>
</head>
<body>
    <h2>Vendor Details</h2>
    <table>
        <tr><th>ID</th><td>{{ $vendor->id }}</td></tr>
        <tr><th>Name</th><td>{{ $vendor->name }}</td></tr>
        <tr><th>Email</th><td>{{ $vendor->email }}</td></tr>
        <tr><th>Phone</th><td>{{ $vendor->phone }}</td></tr>
        <tr><th>Address</th><td>{{ $vendor->address }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($vendor->status) }}</td></tr>
        <!-- add other fields -->
    </table>
</body>
</html>

