@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <nav aria-label="breadcrumb" class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Interview List</li>
                </ol>
            </nav>
        </div>

        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h5 class="card-title">Scheduled Interviews</h5>
                        </div>
                        @can('update', new App\Models\Interview())
                            <div class="col-6">
                                <div class="card-tools float-right">
                                    <a href="{{ route('interviews.create') }}" class="btn btn-success btn-sm"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table id="interview" class="table">
                            <thead>
                                <tr>
                                    <th>Candidate</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>Result</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($interviews as $interview)
                                    <tr>
                                        <td>{{ $interview->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($interview->date)->format('F j, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($interview->time)->format('h:i A') }}</td>
                                        <td>{{ $interview->type }}</td>
                                        <td>{{ $interview->result }}</td>
                                        @can('view', new App\Models\Interview())
                                            <td>
                                                @can('update', new App\Models\Interview())
                                                    <a href="{{ route('interviews.edit', $interview->id) }}"
                                                        class="btn btn-sm btn-info">Edit</a>
                                                @endcan
                                                @can('delete', new App\Models\Interview())
                                                    <form action="{{ route('interviews.destroy', $interview->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @endcan
                                                <a href="{{ route('feedback.create', $interview->id) }}"
                                                    class="btn btn-sm btn-primary">Feedback</a>
                                            </td>
                                        @endcan
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
            $('#interview').DataTable();
        });
    </script>
@endsection
