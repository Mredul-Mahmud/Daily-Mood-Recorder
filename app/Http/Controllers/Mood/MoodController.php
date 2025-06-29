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
    //Streak Functionality
    private function hasThreeDayStreak($userId)
    {
        $moods = Mood::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        if($moods->count() < 3)
        {
            return false;
        }

        $dates = $moods->pluck('created_at')->map(function($dt) {
            return \Carbon\Carbon::parse($dt)->startOfDay();
        });

        for($i = 0; $i < 2; $i++)
        {
            $expectedDate = $dates[$i]->copy()->subDay();
            if(!$dates[$i + 1]->isSameDay($expectedDate))
            {
                return false;
            }
        }
            return true;
    }
    private function getCurrentStreakLength($userId)
    {
        $dates = Mood::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->pluck('created_at')
            ->map(fn($dt) => \Carbon\Carbon::parse($dt)->startOfDay())
            ->unique();

        if($dates->isEmpty())
        {
            return 0;
        }

        $streak = 0;
        $expectedDate = now()->startOfDay();

        foreach ($dates as $date)
        {
            if ($date->equalTo($expectedDate)) {
                $streak++;
                $expectedDate->subDay();
            } else {
            break;
            }
        }
         return $streak;
    }   

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
            $userId = Auth::id();
            $streakLength = $this->getCurrentStreakLength($userId);

    return view('Mood.AllRecords', [
        'moods' => $moods,
        'streakLength' => $streakLength,
    ]);
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
    //search by date
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

    //filter by date
    public function filterByDate(Request $request)
    {
        $user = auth()->user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate && !$endDate) 
        {
            return redirect()->route('mood.all')->with('error', 'Please select at least one date.');
        }

        $query = Mood::where('user_id', $user->id);

        if ($startDate)
        {
        $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate)
        {
        $query->whereDate('created_at', '<=', $endDate);
        }

        $moods = $query->latest()->get();

        return view('Mood.AllRecords', [
            'moods' => $moods,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
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

    //Mood of the month functionality
    public function moodOfMonth()
    {
        $userId = auth()->id();

        $moods = Mood::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(30))
            ->get();

        $moodCounts = $moods->pluck('moodState')->countBy();

        $moodOfTheMonth = null;
        if($moodCounts->isNotEmpty())
        {
        $moodOfTheMonth = $moodCounts->sortDesc()->keys()->first();
        }

        return view('Mood.MoodOfMonth', [
            'moodOfTheMonth' => $moodOfTheMonth,
            'moodCounts' => $moodCounts,
            'totalEntries' => $moods->count(),
        ]);
    }



}
