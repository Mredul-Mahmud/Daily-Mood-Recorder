<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mood Details</title>
</head>
<body>

    <h1>Mood Details</h1>

    <table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Mood Record Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Date</strong>:<br>
            {{ $mood->created_at->format('F j, Y h:i A') }}<br><br>

            <strong>Mood</strong>:<br>
            {{ $mood->moodState }}<br><br>

            <strong>Note</strong>:<br>
            {{ $mood->note ?? 'No note provided' }}</td><br>
        </tr>
    </tbody>
    </table><br>

    <a href="{{ route('mood.all') }}">Back to All Records</a>

</body>
</html>
