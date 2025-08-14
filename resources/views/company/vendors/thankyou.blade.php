<!-- <!DOCTYPE html>
<html>
<head>
    <title>Form Submitted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4 text-center">
                <h2 class="text-success mb-3">Form Submitted Successfully!</h2>
                @if(session('success'))
                    <p class="mb-2">{{ session('success') }}</p>
                @endif
                <p class="fw-bold">Thank you, {{ $vendor->name }}.</p>
                <a href="{{ route('vendor.showForm', ['token' => $vendor->token]) }}" class="btn btn-primary mt-3">Go Back to Form</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
