@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <nav aria-label="breadcrumb" class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                </ol>
            </nav>
        </div>

        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h5 class="card-title">All Users</h5>
                        </div>
                        <div class="col-6">
                            <div class="card-tools float-right">
                                <a href="{{ route('user.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="userTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                                            <td><a href="{{ route('user.edit', ['user' => $user->id]) }}"><i class="fas fa-edit" title="Edit"></i></a></td>
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
        $('#userTable').DataTable();
    });
</script>
@endsection
