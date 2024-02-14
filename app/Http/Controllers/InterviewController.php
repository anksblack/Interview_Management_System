<?php

namespace App\Http\Controllers;

use App\Mail\InterviewEdit;
use App\Models\Interview;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\InterviewScheduled;
use Illuminate\Support\Facades\Mail;


class InterviewController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Interview());
    
        // Check if the authenticated user is an admin or interviewer
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('Interviewer')) {
            $interviews = Interview::all();
        } elseif (auth()->user()->hasRole('Candidate')) {
            // Fetch interviews where the user_id matches the authenticated user's id
            $interviews = Interview::where('user_id', auth()->id())->get();
        }
    
        return view('interviews.index', compact('interviews'));
    }
    

    public function create()
    {
        $this->authorize('create', new Interview());
        $users = User::havingRole('Candidate', 'name');
        return view('interviews.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Interview());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'result' => 'required',
            'type' => 'required|in:technical,hr',
        ]);

        $interview = Interview::create($request->all());

        // Send email
        Mail::to($interview->user->email)->send(new InterviewScheduled($interview));

        return redirect()->route('interviews.index')->with('success', 'Interview scheduled successfully.');
    }

    public function edit($id)
    {
        $this->authorize('update', new Interview());
        $interview = Interview::findOrFail($id);
        $users = User::havingRole('Candidate', 'name');

        return view('interviews.edit', compact('interview', 'users'));
    }

    public function update(Request $request, Interview $interview)
{
    $this->authorize('update', new Interview());
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'time' => 'required',
        'result' => 'required',
        'type' => 'required|in:technical,hr',
    ]);

    $interview->update($request->all());

    // Check the result of the interview before sending an email
    if (!in_array($request->input('result'), ['rejected', 'selected'])) {
        // Send email only if result is not 'rejected' or 'selected'
        Mail::to($interview->user->email)->send(new InterviewEdit($interview));
    }

    return redirect()->route('interviews.index')->with('success', 'Interview updated successfully.');
}


    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect()->route('interviews.index')->with('success', 'Interview deleted successfully.');
    }
}
