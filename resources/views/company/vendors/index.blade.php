@extends('layouts.company')

@section('content')
    <h2>Your Vendors</h2>

    <a href="{{ route('company.vendors.create') }}" class="btn btn-success mb-3">Add Vendor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Form Link</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>
                        @if($vendor->token)
                            <input type="text" class="form-control" readonly value="{{ url('/vendor/form/'.$vendor->token) }}">
                        @else
                            Not generated
                        @endif
                    </td>
                    <td>{{ ucfirst($vendor->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
