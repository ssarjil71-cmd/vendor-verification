@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Companies List</h2>

    <a href="{{ route('admin.companies.create') }}" class="btn btn-success mb-3">+ Add Company</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.companies.pdf', 'all') }}" class="btn btn-dark btn-sm">Download All</a>
        <a href="{{ route('admin.companies.pdf', 'paid') }}" class="btn btn-success btn-sm">Download Paid</a>
        <a href="{{ route('admin.companies.pdf', 'unpaid') }}" class="btn btn-warning btn-sm">Download Unpaid</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->plan_name ?? 'Not Selected' }}</td>
                        <td>
                            @if($company->is_paid)
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-danger">Unpaid</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.companies.activate', $company->id) }}" class="btn btn-sm btn-primary">Activate</a>

                            <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
