@extends('layouts.master')

@push('title')
<title>
    Role
</title>
@endpush

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <nav aria-label="breadcrumb" class="float-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role List</li>
            </ol>
        </nav>
    </div>
<div class="col-12 mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h5 class="card-title">All Roles</h5>
                </div>
                <div class="col-6">
                    <div class="card-tools float-right">
                        <a href="{{ route('role.create') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="moduleTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this module?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('footerScripts')
<script>
    $(document).ready(function() {
        $('#moduleTable').DataTable();
    });
</script>
@endsection