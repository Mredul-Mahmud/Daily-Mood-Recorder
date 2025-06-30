<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <title>Mood of the Month</title>
</head>
<body>
    <div class="container mt-4">

    <h1>Mood of the Month Report</h1>
    <br>

    @if($moodOfTheMonth)
        <div style="color: darkblue; font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem;">
             Your Mood of the Month is <strong>{{ucfirst($moodOfTheMonth)}}</strong>!
        </div>
    @else
        <div style="color: red; font-size: 1.1rem;">
            No mood entries in the past 30 days.
        </div>
    @endif

    @if($totalEntries > 0)
        <h3>All moods in the past 30 days ({{$totalEntries}} entries):</h3>
        <table border="1" style="width:100%; border-collapse: collapse;">

            <thead>
                <tr>
                    <th>Mood</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($moodCounts as $mood => $count)
                    <tr>
                        <td>{{ucfirst($mood)}}</td>
                        <td>{{$count}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br><br>
    <a href="{{route('dashboard')}}" class="btn btn-primary">Back to Dashboard</a>
        </div>

</body>
</html>
