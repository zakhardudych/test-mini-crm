@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Create company</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter company name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@company.com" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website<span class="text-danger">*</span></label>
                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="https://company.com" value="{{ old('website') }}" required>
                @error('website')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
