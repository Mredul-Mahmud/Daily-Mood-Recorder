<?php

namespace App\Http\Controllers\Mood;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
//use App\Models\User;


class MoodController extends Controller
{
    //create a mood entry
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

        $userId = Auth::id();
        $existingMood = Mood::where('user_id', $userId)
        ->where('created_at', '>=', Carbon::now()->subDay())
        ->first();

        if($existingMood)
        {
            return redirect()->route('dashboard')->with('error', 'You have already chosen your mood today.  You can only record your mood status once every day.');
        }

        Mood::create([
            'user_id' => $userId,
            'moodState' => $request->moodState,
            'note' => $request->note,
        ]);  
        
        
        return redirect()->route('dashboard')->with('success', 'Mood recorded successfully!');;
    }
    //view all records of user
    public function allRecords()
    {
        $moods = Mood::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('Mood.AllRecords', compact('moods'));
    }
    //edit a mood status entry
    public function editRecord($id)

    {
        $mood = Mood::where('user_id', Auth::id())->findOrFail($id);
        return view('Mood.Edit', compact('mood'));
    }

    public function updateRecord(Request $request, $id)
    {
        $mood= Mood::findOrFail($id);
        $request->validate([
            'note' => 'nullable|string',
        ]);

        $mood = Mood::where('user_id', Auth::id())->findOrFail($id);
        $mood->note = $request->note;
        $mood->save();

        return redirect()->route('mood.all')->with('success', 'Note updated successfully!');
    }
    //view individual entry
    public function moodDetails($id)
    {
        $mood = Mood::where('id', $id)
                    ->where('user_id', auth()->id())  
                    ->firstOrFail();

        return view('Mood.Details', compact('mood'));
    }

    public function searchByDate(Request $request)
    {
        $user = auth()->user();
        $date = $request->input('date');

        if (!$date)
        {
            return redirect()->route('mood.all')->with('error', 'Please provide a date.');
        }

        $moods = Mood::where('user_id', $user->id)
            ->whereDate('created_at', $date)
            ->latest()
            ->get();
            if ($moods->isEmpty()) {
        return redirect()->route('mood.all')->with('error', 'No records found for this date.');
    }

        return view('Mood.AllRecords', compact('moods'));
    }

    //soft delete functionality
    public function delete($id)
    {
        $mood = Mood::where('user_id', auth()->id())->findOrFail($id);
        $mood->delete();
        return redirect()->route('mood.all')->with('success', 'Mood status entry moved to trash.');
    }

 
        public function trash()
    {
        $trashedMoods = Mood::onlyTrashed()->where('user_id', auth()->id())->get();
        return view('Mood.Trash', compact('trashedMoods'));
    }
    

    public function restore($id)
    {
        $mood = Mood::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
        $mood->restore();
        return redirect()->route('trash')->with('success', 'Mood status entry restored successfully.');
    }

}
