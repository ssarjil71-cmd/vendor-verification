@extends('layouts.company')

@section('content')
<div class="container mt-4">
    <h2>Vendor Details</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $vendor->name }}</p>
            <p><strong>Email:</strong> {{ $vendor->email }}</p>
            <p><strong>Phone:</strong> {{ $vendor->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $vendor->address ?? 'N/A' }}</p>
            <p><strong>PAN Number:</strong> {{ $vendor->pan_number ?? 'N/A' }}</p>
            <p><strong>Aadhar Number:</strong> {{ $vendor->aadhar_number ?? 'N/A' }}</p>
            <p><strong>Bank Account:</strong> {{ $vendor->bank_account ?? 'N/A' }}</p>
            <p><strong>IFSC Code:</strong> {{ $vendor->ifsc_code ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="d-flex align-items-center">
    {{-- Approve Button --}}
    <form action="{{ route('company.vendors.approve', $vendor->id) }}" method="POST" class="me-2">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">Approve</button>
    </form>

    {{-- Reject Button --}}
    <form action="{{ route('company.vendors.reject', $vendor->id) }}" method="POST" class="me-2">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
    </form>

    {{-- PDF Download --}}
    <a href="{{ route('company.vendors.pdf', $vendor->id) }}" class="btn btn-primary btn-sm">Download PDF</a>
</div>

</div>
@endsection
