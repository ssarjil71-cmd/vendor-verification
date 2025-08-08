@extends('layouts.company')

@section('content')
<div class="container">
    <h2>Add Vendor</h2>
    
    <form action="{{ route('company.vendors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
