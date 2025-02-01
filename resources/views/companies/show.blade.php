@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Details about the company</h1>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to companies</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p><strong>ID:</strong> {{ $company->id }}</p>
                    <p><strong>Name:</strong> {{ $company->name }}</p>
                    <p><strong>Email:</strong> {{ $company->email }}</p>
                    <p><strong>Created at:</strong> {{ $company->created_at }}</p>
                    <p><strong>Updated at:</strong> {{ $company->updated_at }}</p>
                </div>
                <div>
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" class="img-fluid" style="max-width: 150px;">
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Employees of {{ $company->name }}</h2>
            <a href="{{ route('employees.create', ['company' => $company->id]) }}" class="btn btn-success">+ Add New Employee</a>
        </div>

        @include('employees.list', ['data' => $employees])
    </div>

@endsection
