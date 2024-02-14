@extends('layouts.master')


@section('content')
<div class="container-fluid">
    <div class="row">
        @can('update', new App\Models\Interview())
        <div class="col-md-8 mt-3">
            <!-- Feedback Form -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Submit Feedback for {{ $interview->user->name }}</h3>
                </div>
                <form action="{{ route('feedback.store', $interview) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- Strengths -->
                        <div class="form-group">
                            <label for="strengths">Strengths</label>
                            <textarea name="strengths" id="strengths" class="form-control" rows="3" placeholder="Enter candidate's strengths here..." required></textarea>
                        </div>
                        <!-- Weaknesses -->
                        <div class="form-group">
                            <label for="weaknesses">Weaknesses</label>
                            <textarea name="weaknesses" id="weaknesses" class="form-control" rows="3" placeholder="Enter candidate's weaknesses here..." required></textarea>
                        </div>
                        <!-- Overall Recommendation -->
                        <div class="form-group">
                            <label for="recommendation">Overall Recommendation</label>
                            <textarea name="recommendation" id="recommendation" class="form-control" rows="3" placeholder="Enter candidate's overall recommendation here..." required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </div>
                </form>
            </div>
        @endcan
        <!-- Previous Feedback -->
        <div class="card mt-2">  
                @if($feedbacks->isEmpty())
                    <p>No feedback available.</p>
                @else
                    @foreach ($feedbacks as $feedback)
                    <div class="card-header">
                        <h3 class="card-title">Your Feedback by {{ $feedback->interviewer->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-info">
                            <p><strong>Strengths:</strong> {{ $feedback->strengths }}</p>
                            <p><strong>Weaknesses:</strong> {{ $feedback->weaknesses }}</p>
                            <p><strong>Recommendation:</strong> {{ $feedback->recommendation }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
