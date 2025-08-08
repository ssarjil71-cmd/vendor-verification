<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($type) }} Companies List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
        }

        th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h2>{{ ucfirst($type) }} Companies Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $index => $company)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->is_paid ? 'Paid' : 'Unpaid' }}</td>
                    <td>{{ $company->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
