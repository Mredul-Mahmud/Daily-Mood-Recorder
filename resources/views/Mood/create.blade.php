<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Mood</title>
</head>
<body>
    <div class="container mt-4">

    <h1>Record Today's Mood</h1>

    <form action="{{route('mood.createRecord')}}" method="POST" class="mb-3">
  <div class="col-auto">
        @csrf
        <label for="moodState" class="form-label">Mood:</label>
        <select name="moodState" id="moodState" class="form-select">
            <option value="">Select Mood</option>
            <option value="Happy">Happy</option>
            <option value="Sad">Sad</option>
            <option value="Angry">Angry</option>
            <option value="Excited">Excited</option>
            <option value="Anxious">Anxious</option>
        </select>
        @error('moodState')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
        <br/><br/>
        <label for="note" class="form-label">Add a short Note:</label><br/>
        <textarea name="note" id="note" rows="4" cols="40" class="form-control"  placeholder="Write a short note..."></textarea>

        <br/><br/>
        

        <button type="submit" class="btn btn-success">Save Record</button>
        </div>
    </form>
    <div>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Return to home</a>
    </div>
    </div>

</body>
</html>
