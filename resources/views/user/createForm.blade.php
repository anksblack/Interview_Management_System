@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb" class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                    <li class="breadcrumb-item active">User Create</li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($user, ['route' => $submitRoute, 'method' => $method]) }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter Name']) }}
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('email', 'E-Mail') }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Enter Email']) }}
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footerScripts')


@endsection
