@extends('layouts.admin')

@section('content')
<!-- Dashboard Container -->
<div class="container mt-5">
    <h1 class="mb-5 text-center fw-bold">🚀 Admin Dashboard</h1>

    <div class="row g-4 justify-content-center">

        <!-- Total Companies Card -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.companies.index') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 text-white bg-gradient-primary shadow h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-building display-4 mb-3"></i>
                        <h5 class="card-title">Total Companies</h5>
                        <h2 class="fw-bold">{{ $totalCompanies }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Paid Companies Card -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.companies.paid') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 text-white bg-gradient-success shadow h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-cash-coin display-4 mb-3"></i>
                        <h5 class="card-title">Paid Companies</h5>
                        <h2 class="fw-bold">{{ $paidCompanies }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Unpaid Companies Card -->
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.companies.unpaid') }}" class="text-decoration-none">
                <div class="card dashboard-card border-0 text-white bg-gradient-danger shadow h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-exclamation-circle display-4 mb-3"></i>
                        <h5 class="card-title">Unpaid Companies</h5>
                        <h2 class="fw-bold">{{ $unpaidCompanies }}</h2>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>


<style>
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a, #138f65);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74a3b, #be261a);
    }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
