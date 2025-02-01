@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Companies</h2>
            <div class="btn-group">
                <a href="{{ route('companies.create') }}" class="btn btn-success">+ Add New</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>

        @if ($data->isEmpty())
            <div class="alert alert-info text-center">No results found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Logo</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ $item->website }}" target="_blank" class="text-decoration-none">{{ $item->website }}</a>
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo" class="img-thumbnail" width="50">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('companies.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('companies.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('companies.delete', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
