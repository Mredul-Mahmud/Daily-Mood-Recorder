<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Mood Records</title>
</head>
<body>

    <form action="{{route('mood.search')}}" method="GET">
        <label for="search_date">Search by Date:</label>
        <input type="text" id="search_date" name="date" value="{{ request('date') }}">
        <button type="submit">Search</button>
       
    </form><br>

<h1>Your Mood Records</h1>

@if(session('success'))
    <div  style="color: green;font-size: 0.9rem;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif

@if($moods->isEmpty())
    <p>You haven't recorded any moods yet.</p>
@else
    <table border="1">
        <thead>
            <tr>
                <th>Details</th>
                <th>Date & Time</th>
                <th>Mood</th>
                <th>Short Notes</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($moods as $mood)
                <tr>
                    <td>
                        <a href="{{route('mood.details',$mood->id)}}">*</a>
                    </td>
                    <td>{{$mood->created_at}}</td>
                    <td>{{ucfirst($mood->moodState)}}</td>
                    <td>{{$mood->note ?? '—'}}</td>
                    <td>
    
                        <a href="{{route('mood.edit', $mood->id)}}"><button>Edit </button></a>
                        <form action="{{route('mood.delete', $mood->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
@endif
    <a href="{{route('mood.all')}}"><button> Back </button></a><br>
    <a href="{{route('trash')}}">Trash</a><br>
<br><br>
    <a href="{{route('dashboard')}}"><button> Home </button></a><br>
</body>
</html>