@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Pending Companies for Approval</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pendingCompanies->isEmpty())
        <div class="alert alert-info">No pending companies found.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingCompanies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->created_at->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('admin.pending.companies.approve', $company->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('admin.pending.companies.reject', $company->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to reject?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
