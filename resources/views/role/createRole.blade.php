@extends('layouts.master')

@push('title')
<title>User

</title>
@endpush

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <nav aria-label="breadcrumb" class="float-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role create</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection