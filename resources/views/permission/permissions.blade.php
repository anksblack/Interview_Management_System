@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <nav aria-label="breadcrumb" class="float-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permission List</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="card-title">All Permissions</p>
                <div class="col-12">
                    <div class="card-tools float-right">
                        <a href="{{ route('permission.create') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th class="text-center">Access</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->module->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $permission->access }}</td>
                                <td class="text-center">{{ $permission->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div
@endsection
