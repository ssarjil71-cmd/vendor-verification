@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Pay Now</h2>

    <p class="mt-3">You have selected the <strong>{{ $company->plan_name }}</strong> plan.</p>

    <p>Scan the QR code below to complete your payment:</p>

    <img src="{{ asset('images/payment_qr.png') }}" alt="Payment QR" class="img-fluid" style="max-width: 300px;">

    <p class="mt-3 text-muted">After payment, the admin will verify and activate your account.</p>
</div>
@endsection
