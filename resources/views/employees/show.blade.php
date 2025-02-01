@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Details about the employee</h1>
                <a href="{{ route('companies.show', $employee->company_id) }}" class="btn btn-secondary">Back to employee company</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $employee->id }}</p>
                <p><strong>Name:</strong> {{ $employee->first_name }}</p>
                <p><strong>Email:</strong> {{ $employee->last_name }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                <p><strong>Created at:</strong> {{ $employee->created_at }}</p>
                <p><strong>Updated at:</strong> {{ $employee->updated_at }}</p>
            </div>
        </div>
    </div>

@endsection
