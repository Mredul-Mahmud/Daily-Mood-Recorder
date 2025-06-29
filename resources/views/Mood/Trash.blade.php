<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trashed Entries</title>
</head>
<body>
    <h1>Trash</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    @if($trashedMoods->isEmpty())
        <p>No deleted mood records found.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Date of recording</th>
                    <th>Mood</th>
                    <th>Note</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashedMoods as $mood)
                    <tr>
                        <td>{{$mood->created_at}}</td>
                        <td>{{ucfirst($mood->moodState)}}</td>
                        <td>{{$mood->note ?? '—'}}</td>
                        <td>
                            <form action="{{route('mood.restore', $mood->id)}}" method="POST">
                                @csrf
                                <button type="submit">Restore</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{route('mood.all')}}">Back to All Records</a>
</body>
</html>
