@extends('layouts.master')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Interview</h5>
        </div>
        <div class="card-body">
            {!! Form::model($interview, ['route' => ['interviews.update', $interview->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('user_id', 'Candidate') !!}
                    {{ Form::select('user_id', $users, null, ['class' => 'form-control select2','id'=>'user_id', 'placeholder' => 'Choose one']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('date', 'Date') !!}
                    {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'date']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('time', 'Time') !!}
                    {!! Form::time('time', null, ['class' => 'form-control', 'id' => 'time']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Interview Type') !!}
                    {!! Form::select('type', ['' => 'Select Interview Type', 'technical' => 'Technical', 'hr' => 'HR'], null, ['class' => 'form-control select2', 'id' => 'type']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('result', 'Interview Result') !!}
                    {!! Form::select('result', ['' => 'Choose Interview Result', 'pending' => 'Pending','selected' => 'Selected', 'rejected' => 'Rejected'], null, ['class' => 'form-control select2', 'id' => 'type']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update Interview', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('interviews.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
