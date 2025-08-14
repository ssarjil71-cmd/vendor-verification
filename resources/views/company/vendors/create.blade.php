@extends('layouts.company')

@section('content')
<div class="container mt-4">
    <h2>Add Vendor</h2>

    <form method="POST" action="{{ route('company.vendors.store') }}">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Select Documents to Verify:</label>
            @foreach($verifications as $key => $doc)
                <div class="form-check">
                    <input type="checkbox" name="verifications[]" value="{{ $key }}" class="form-check-input" id="{{ $key }}">
                    <label class="form-check-label" for="{{ $key }}">{{ $doc['label'] }} (₹{{ $doc['price'] }})</label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Create Vendor</button>
    </form>
</div>
@endsection
