@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <nav aria-label="breadcrumb" class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($user, ['route' => ['user.update', $user->id]]) }}
                    @method('PUT')
                    {{Form::hidden('id',null)}}
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'E-Mail Address') }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Assign Roles</h4>
                    {{ Form::open(['route' => 'assignRole']) }}

                    <div class="form-group">
                        {{ Form::hidden('user', $user->id) }}
                        <div class="row">
                            @foreach ($roles as $role)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="form-check">
                                        {{ Form::checkbox('role[]', $role->id, $user->hasRole($role->name), ['class' => 'form-check-input']) }}
                                        <label class="form-check-label">{{ $role->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footerScripts')
@endsection
