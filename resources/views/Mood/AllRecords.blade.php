<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <title>All Mood Records</title>
</head>
<body>

    <div class="container mt-4">
        <div style="margin-bottom: 1rem;">

        <form action="{{ route('mood.search') }}" method="GET" class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="search_date" class="form-label">Search by Date:</label>
        <input type="text" id="search_date" name="date" class="form-control form-control-lg" value="{{ request('date') }}">
    </div>
    <div class="col-auto align-self-end">
        <button type="submit" class="btn btn-success">Search</button>
    </div>
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

            <button type="submit" class="btn btn-primary">Filter</button><br><br><br>

            <a href="{{route('mood.all')}}" class="btn btn-success">Reset List</a>
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


    <table class="table table-striped table-bordered table-hover">

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
                        <a href="{{route('mood.edit', $mood->id)}}" class="btn btn-warning">Edit</a>
                        <form action="{{route('mood.delete', $mood->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
    <a href="{{route('mood.downloadRecord')}}" class="btn btn-primary">Download a copy of your Mood Entries</a><br><br><br>
    <a href="{{route('dashboard')}}" class="btn btn-primary">Home</a><br><br>

        <a href="{{route('trash')}}">
        <button type="button" class="btn btn-primary">Trash</button></a><br><br>
        <a href="{{route('moodOfMonth')}}" class="btn btn-primary">Your Mood Of The Month</a>

        

</div>

</body>
</html>
