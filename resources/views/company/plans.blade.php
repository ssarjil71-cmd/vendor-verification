@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Select a Plan</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('company.plans.submit') }}" class="mt-4">
        @csrf

        <div class="form-check">
            <input class="form-check-input" type="radio" name="plan_name" id="basic" value="Basic" required>
            <label class="form-check-label" for="basic">
                Basic Plan - ₹199/month
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="plan_name" id="premium" value="Premium">
            <label class="form-check-label" for="premium">
                Premium Plan - ₹499/month
            </label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
    </form>
</div>
@endsection
