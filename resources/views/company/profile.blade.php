@extends('layouts.company')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Company Profile</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Info --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Welcome:</strong> {{ Auth::guard('company')->user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::guard('company')->user()->email }}</p>
        </div>
    </div>

    <hr>

    {{-- Change Password Form --}}
    <h3 class="mb-3">Change Password</h3>
    <form action="{{ route('company.change.password') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
</div>
@endsection
