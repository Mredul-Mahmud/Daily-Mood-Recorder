<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Mood Records</title>
</head>
<body>
    <div style="margin-bottom: 1rem;">
        <form action="{{route('mood.search')}}" method="GET" style="display: inline;">
            <label for="search_date">Search by Date:</label>
            <input type="string" id="search_date" name="date" value="{{request('date')}}">
            <button type="submit">Search</button>
        </form>
    </div>
<div>
    <p style="color: green;font-size: 1.2rem;">*You can also search date with filter</p>
</div>
    <div style="margin-bottom: 1rem;">
        <form action="{{route('mood.filter')}}" method="GET" style="display: inline;">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="{{request('start_date')}}">

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="{{request('end_date') }}">

            <button type="submit">Filter</button><br><br>

            <a href="{{ route('mood.all') }}">
                <button type="button">Reset List</button>
            </a>
        </form>
    </div>
<!--Success and error messages-->
    @if(session('success'))
        <div style="color: green; font-size: 0.9rem;">{{session('success')}}</div>
    @endif

    @if(session('error'))
        <div style="color: red">{{session('error')}}</div>
    @endif

    @if(isset($searchedDate))
        <div style="margin-bottom: 1rem;">
            Showing records for <strong>{{$searchedDate}}</strong>.
        </div>
    @endif

    @if(isset($startDate) || isset($endDate))
        <div style="margin-bottom: 1rem;">
            Showing records
            @if($startDate && $endDate)
                from <strong>{{$startDate}}</strong> to <strong>{{$endDate}}</strong>.
            @elseif($startDate)
                starting from <strong>{{$startDate}}</strong>.
            @elseif($endDate)
                up to <strong>{{$endDate}}</strong>.
            @endif
            
        </div><br><br>
    @endif
    <h1>Your Mood Records</h1><br>

    @if(!empty($streakLength) && $streakLength >= 2)
    <div style="color: green; font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem;">
         Congratulations! You have a {{$streakLength}}-day streak badge!
    </div>
    @endif


    <table border="1" style="width: 100%; border-collapse: collapse;">
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
            @forelse($moods as $mood)
                <tr>
                    <td>
                        <a href="{{route('mood.details', $mood->id)}}">*</a>
                    </td>
                    <td>{{ $mood->created_at }}</td>
                    <td>{{ ucfirst($mood->moodState) }}</td>
                    <td>{{ $mood->note ?? '—' }}</td>
                    <td>
                        <a href="{{route('mood.edit', $mood->id)}}">
                            <button type="button">Edit</button>
                        </a>
                        <form action="{{route('mood.delete', $mood->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">
                        No records to display.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <a href="{{route('dashboard')}}">
        <button type="button">Home</button></a><br><br>

        <a href="{{route('trash')}}">
        <button type="button">Trash</button></a><br><br>
        <a href="{{route('moodOfMonth')}}">
        <button type="button">Your Mood Of The Month</button></a>

</body>
</html>
