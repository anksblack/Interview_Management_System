<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create(Interview $interview)
{
    $feedbacks = $interview->feedback()->get();
    // dd($feedbacks);
    return view('feedback.create', compact('interview', 'feedbacks'));
}

public function store(Request $request, Interview $interview)
{
    // Validating the new fields: strengths, weaknesses, and recommendation
    $request->validate([
        'strengths' => 'required|string',
        'weaknesses' => 'required|string',
        'recommendation' => 'required|string'
    ]);

    // Storing the new fields in the feedback
    $interview->feedback()->create([
        'strengths' => $request->strengths,
        'weaknesses' => $request->weaknesses,
        'recommendation' => $request->recommendation,
        'interviewer_id'=>auth()->user()->id,
    ]);

    return redirect()->route('feedback.create', $interview)->with('success', 'Feedback submitted successfully.');
}

    
}
