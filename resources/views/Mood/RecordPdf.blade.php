<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mood Entries PDF</title>
    <style>
        body {font-family: sans-serif; font-size: 12px;}
        table {width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td {border: 1px solid #ddd; padding: 8px;}
        th {background: #f2f2f2;}
    </style>
</head>
<body>
    <h2>{{$user->name}}'s Mood Entries</h2>
    <p>Generated on: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Mood</th>
                <th>Short Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($moods as $mood)
                <tr>
                    <td>{{$mood->created_at->format('Y-m-d H:i')}}</td>
                    <td>{{ucfirst($mood->moodState)}}</td>
                    <td>{{$mood->note ?? '—'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
