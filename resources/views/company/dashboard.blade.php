@extends('layouts.company')

@section('content')
    <div class="container">
        <h2>Welcome, {{ Auth::guard('company')->user()->name }}</h2>
        <p>This is your company dashboard where you can manage vendors.</p>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Total Vendors</h5>
                <p class="card-text">You have onboarded {{ $vendorsCount }} vendors.</p>
                <a href="{{ route('company.vendors.index') }}" class="btn btn-primary">Manage Vendors</a>
            </div>
        </div>
    </div>
@endsection
