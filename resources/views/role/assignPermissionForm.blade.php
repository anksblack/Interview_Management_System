@extends('layouts.master')

@section('content')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role: {{ $role->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Assign Permission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assign Permissions</h3>
                    </div>
                    {{ Form::model($role, ['route' => $submitRoute, 'method' => 'PUT']) }}
                        <div class="card-body">
                            @if (!empty($permissions))
                                <div class="form-group">
                                    <button class="btn btn-info mb-3" type="button" id="clearAllSelected">Clear All</button>
                                    @foreach ($permissions as $module_name => $module_permissions)
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ strtoupper($module_name) }}</h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($module_permissions as $permission)
                                                    <div class="form-check form-check-inline">
                                                        {{ Form::checkbox('permission[]', $permission->id, $role->hasPermission($permission->module->name, $permission->access), ['class' => 'form-check-input', 'id' => 'permission_'.$permission->id]) }}
                                                        <label class="form-check-label" for="permission_{{ $permission->id }}" title="{{ $permission->description }}">{{ $permission->access }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </section>
@endsection

@section('footerScripts')
    <script>
        $(document).ready(function() {
            $('#clearAllSelected').click(function() {
                $('input[type=checkbox]').prop('checked', false);
            });
        });
    </script>
@endsection
