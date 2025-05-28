@extends('layouts.app')

@section('title', 'Superadmin Dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Superadmin Dashboard</h1>

    <div class="row">
        <!-- Create Admin Accounts -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Admin Accounts</h5>
                    <p class="card-text">Create and manage admin users who can access the admin dashboard.</p>
                    <a href="{{ route('superadmin.admins.index') }}" class="btn btn-primary">Manage Admins</a>
                </div>
            </div>
        </div>

        <!-- Update Barbershop Info -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Barbershop Information</h5>
                    <p class="card-text">Update barbershop profiles and details.</p>
                    <a href="{{ route('superadmin.barbershops.index') }}" class="btn btn-primary">Manage Barbershops</a>
                </div>
            </div>
        </div>

        <!-- Edit Users -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">User Management</h5>
                    <p class="card-text">Edit personal and business user information.</p>
                    <a href="{{ route('superadmin.users.index') }}" class="btn btn-primary">Manage Users</a>
                </div>
            </div>
        </div>

        <!-- View All Bookings -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Bookings</h5>
                    <p class="card-text">View and manage all bookings across the platform.</p>
                    <a href="{{ route('superadmin.bookings.index') }}" class="btn btn-primary">View Bookings</a>
                </div>
            </div>
        </div>

        <!-- Assign Roles -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Role Assignment</h5>
                    <p class="card-text">Assign or update roles for admin accounts.</p>
                    <a href="{{ route('superadmin.roles.index') }}" class="btn btn-primary">Manage Roles</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
