@extends('layouts.company')

@section('content')
    <h2>Company Profile</h2>
    <p>Welcome, {{ Auth::guard('company')->user()->name }}</p>
    <p>Email: {{ Auth::guard('company')->user()->email }}</p>
@endsection
