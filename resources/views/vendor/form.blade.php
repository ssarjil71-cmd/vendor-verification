<!DOCTYPE html>
<html>
<head>
    <title>Vendor Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
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
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Vendor Form</h3>
                    <small>For {{ $vendor->name }}</small>

                    <div class="mt-2">
                        @if($vendor->status == 'pending')
                            <span class="badge bg-danger">Form not filled yet</span>
                        @elseif($vendor->status == 'submitted')
                            <span class="badge bg-success">Form filled</span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ✅ Correct form action with token --}}
                    <form method="POST" action="{{ route('vendor.submit_form', ['token' => $vendor->token]) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">PAN Number</label>
                            <input type="text" name="pan_number" class="form-control"
                                   placeholder="Enter PAN Number" required
                                   value="{{ old('pan_number', $vendor->pan_number) }}">
                            @error('pan_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Aadhar Number</label>
                            <input type="text" name="aadhar_number" class="form-control"
                                   placeholder="Enter Aadhar Number" required
                                   value="{{ old('aadhar_number', $vendor->aadhar_number) }}">
                            @error('aadhar_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bank Account</label>
                            <input type="text" name="bank_account" class="form-control"
                                   placeholder="Enter Bank Account Number" required
                                   value="{{ old('bank_account', $vendor->bank_account) }}">
                            @error('bank_account') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">IFSC Code</label>
                            <input type="text" name="ifsc_code" class="form-control"
                                   placeholder="Enter IFSC Code" required
                                   value="{{ old('ifsc_code', $vendor->ifsc_code) }}">
                            @error('ifsc_code') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </form>

                    {{-- ✅ Go Back to Form button --}}
                    <div class="mt-3 text-center">
                        <a href="{{ route('vendor.showForm', ['token' => $vendor->token]) }}" class="btn btn-secondary">
                            Go Back to Form
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
