@extends('layouts.company')

@section('content')
<div class="container mt-4">
    <!-- Welcome Section -->
    <div class="alert alert-success">
        <h4 class="mb-1">Welcome, {{ Auth::guard('company')->user()->name }} 👋</h4>
        <p class="mb-0">This is your company dashboard. You can manage vendors, update your profile, and track your business.</p>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <!-- Vendors Count -->
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Vendors</h5>
                    <h2 class="display-6 fw-bold">{{ $vendorsCount }}</h2>
                    <p class="text-muted">Vendors onboarded so far</p>
                    <a href="{{ route('company.vendors.index') }}" class="btn btn-primary btn-sm">Manage Vendors</a>
                </div>
            </div>
        </div>

        <!-- Profile Button -->
        <div class="col-md-4">
            <div class="card shadow-sm border-info">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">Profile</h5>
                    <p class="text-muted">View or edit your company profile</p>
                    <a href="{{ route('company.profile') }}" class="btn btn-info btn-sm">View Profile</a>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-md-4">
            <div class="card shadow-sm border-warning">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">Security</h5>
                    <p class="text-muted">Change your account password</p>
                    <a href="{{ route('company.profile') }}#change-password" class="btn btn-warning btn-sm">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
