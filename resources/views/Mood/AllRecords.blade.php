<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Mood Records</title>
</head>
<body>

    <form action="{{ route('mood.search') }}" method="GET" style="display: inline;">
        <label for="search_date">Search by Date:</label>
        <input type="text" id="search_date" name="date" value="{{ request('date') }}">
        <button type="submit">Search</button>
    </form>

    <form action="{{ route('mood.all') }}" method="GET" style="display: inline;">
        <button type="submit">Reset</button>
    </form>

    <br><br>
    @if(session('success'))
        <div style="color: green; font-size: 0.9rem;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red">{{ session('error') }}</div>
    @endif


    <h1>Your Mood Records</h1>

    
    @if(isset($searchedDate) && $moods->isEmpty())
        <div style="color: red">
            No mood records found for {{ $searchedDate }}.
        </div>
    @endif

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
            @forelse($moods as $mood)
                <tr>
                    <td>
                        <a href="{{ route('mood.details', $mood->id) }}">*</a>
                    </td>
                    <td>{{ $mood->created_at }}</td>
                    <td>{{ ucfirst($mood->moodState) }}</td>
                    <td>{{ $mood->note ?? '—' }}</td>
                    <td>
                        <a href="{{ route('mood.edit', $mood->id) }}">
                            <button type="button">Edit</button>
                        </a>
                        <form action="{{ route('mood.delete', $mood->id) }}" method="POST" style="display:inline">
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
     <a href="{{ route('dashboard') }}">
        <button type="button">Home</button>
    </a><br><br>
    <a href="{{ route('trash') }}"><button type="button">Bin</button></a>
    <br><br>
   

</body>
</html>
