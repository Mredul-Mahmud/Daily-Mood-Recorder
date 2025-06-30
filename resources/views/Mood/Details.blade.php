<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <title>Mood Details</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Mood Details</h1>

        <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Mood Record Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Date</strong>:<br>
            {{$mood->created_at->format('F j, Y h:i A')}}<br><br>
            <strong>Mood</strong>:<br>
            {{$mood->moodState}}<br><br>
            <strong>Note</strong>:<br>
            {{$mood->note ?? 'No note provided'}}</td><br>
        </tr>
    </tbody>
    </table><br>

    <a href="{{ route('mood.all') }}" class="btn btn-primary">Back to All Records</a>
</div>

</body>
</html>
