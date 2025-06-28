<?php

namespace App\Http\Controllers\Mood;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MoodController extends Controller
{
    //
    public function create()
    {
        return view('Mood.create');
    }
    public function createRecord(Request $request)
    {
        $request->validate([
            'moodState' => 'required',
            'note' => 'nullable',
        ]);

        Mood::create([
            'user_id' => Auth::id(),//$request->user()->id
            'moodState' => $request->moodState,
            'note' => $request->note,
        ]);  
        
        
        return redirect()->route('dashboard')->with('success', 'Mood recorded successfully!');;
    }
}
