@extends('layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <nav aria-label="breadcrumb" class="float-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permission</a></li>
                        <li class="breadcrumb-item active">Permission Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($permission, ['route' => ['permission.update', $permission->id], 'method' => 'PUT']) }}
                        <div class="form-group row">
                            {{ Form::label('module_id', 'Select Module:', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-10">
                                {{ Form::select('module_id', $modules, $selectedModule, ['id' => 'module', 'class' => 'form-control select2', 'required' => 'required']) }}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {{ Form::label('access', 'Access:', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('access', null, ['class' => 'form-control', 'placeholder' => 'Enter Access', 'required']) }}
                                @error('access')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('description', 'Description:', ['class' => 'col-sm-2 col-form-label']) }}
                            <div class="col-sm-10">
                                {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'required']) }}
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footerScripts')
@endsection
