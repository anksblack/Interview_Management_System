@extends('layouts.master')

@push('title')
<title>

</title>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 mt-3">
        <nav aria-label="breadcrumb" class="float-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('modules.index') }}">Module</a></li>
                <li class="breadcrumb-item active">Module Edit</li>
            </ol>
        </nav>
    </div>
 <div class="container">
        <form action="{{ route('modules.update', ['module' => $module->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $module->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection