@extends('layouts.company')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Your Vendors</h2>
        <a href="{{ route('company.vendors.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Vendor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="width: 220px;">Form Link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>
                                @if($vendor->token)
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control form-control-sm text-truncate" 
                                               readonly 
                                               value="{{ url('/vendor/form/'.$vendor->token) }}">
                                        <button class="btn btn-outline-secondary btn-sm copy-btn" 
                                                data-link="{{ url('/vendor/form/'.$vendor->token) }}">
                                            Copy
                                        </button>
                                    </div>
                                @else
                                    <span class="text-muted">Not generated</span>
                                @endif
                            </td>
                            <td>
                                @if($vendor->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($vendor->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($vendor->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($vendor->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($vendor->form_filled)
                                    <a href="{{ route('company.vendors.show', $vendor->id) }}" 
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>
                                    @if($vendor->status === 'pending')
                                        <a href="{{ route('company.vendors.approve', $vendor->id) }}" 
                                           class="btn btn-success btn-sm">
                                            Approve
                                        </a>
                                        <a href="{{ route('company.vendors.reject', $vendor->id) }}" 
                                           class="btn btn-danger btn-sm">
                                            Reject
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted">Form not filled yet</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No vendors found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Copy Button Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.copy-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const link = this.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Copied!';
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-success');
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-secondary');
                    }, 1500);
                });
            });
        });
    });
</script>
@endsection
