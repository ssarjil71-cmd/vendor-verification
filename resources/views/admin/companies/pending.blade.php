@extends('layouts.admin') {{-- Or your main admin layout --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pending Companies</h2>

    @if($pendingCompanies->isEmpty())
        <div class="alert alert-info">No pending companies found.</div>
    @else
        <div class="row">
            @foreach($pendingCompanies as $company)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $company->name }}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> {{ $company->email }}<br>
                                <strong>Status:</strong> {{ ucfirst($company->status) }}<br>
                                <strong>Paid:</strong> {{ $company->is_paid ? 'Yes' : 'No' }}
                            </p>
                            <form method="POST" action="{{ route('admin.companies.destroy', $company->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
