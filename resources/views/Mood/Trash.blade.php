<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <title>Trashed Entries</title>
</head>
<body>
    <div class="container mt-4">

    <h1>Trash</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    @if($trashedMoods->isEmpty())
        <p>No deleted mood records found.</p>
    @else
        <table class="table table-striped table-bordered table-hover">


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
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <div>
        <a href="{{route('mood.all')}}" class="btn btn-primary">Back to All Records</a>
    </div><br>
    <div>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Home</a>
    </div>
    </div>

</body>
</html>
