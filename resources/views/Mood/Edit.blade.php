<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <title>Edit Mood Record</title>
</head>
<body>
    <div class="container mt-4">


<h1>Edit Mood Record</h1>

<form action="{{route('mood.update', $mood->id)}}" method="POST" >
    @csrf
    <p>
        <strong>Mood:</strong> {{ ucfirst($mood->moodState) }}<br>
        <strong>Date:</strong> {{ $mood->created_at->format('F j, Y h:i A') }}
    </p><br>
    <div style="color: red;font-size: 0.9rem;">
        <p style="color: red;font-size: 0.9rem;">You can only update your Short Note</p>
         <p style="color: red;font-size: 0.9rem;">*You may want to make a note if your mood changes</p>
    </div>
    

    <label for="note" class="form-label" >Edit Note:</label><br>
    <textarea name="note" id="note" rows="4" cols="40" class="form-control">{{ old('note', $mood->note) }}</textarea>

    <br><br>
    <button type="submit" class="btn btn-success">Update Note</button>
</form><br>
    <div>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Return back to home</a>
    </div>
</div>
</body>
</html>
