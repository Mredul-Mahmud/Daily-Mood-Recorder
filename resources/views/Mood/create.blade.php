<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>New Mood</title>
</head>
<body>
    <h1>Record Today's Mood</h1>

    <form action="{{route('mood.createRecord')}}" method="POST">
        @csrf
        <label for="moodState">Mood:</label>
        <select name="moodState" id="moodState" required>
            <option value="">Select Mood</option>
            <option value="Happy">Happy</option>
            <option value="Sad">Sad</option>
            <option value="Angry">Angry</option>
            <option value="Excited">Excited</option>
            <option value="Anxious">Anxious</option>
        </select>
        <br/><br/>
        <label for="note">Add a short Note:</label><br/>
        <textarea name="note" id="note" rows="4" cols="50" placeholder="Write a short note..."></textarea>

        <br/><br/>

        <button type="submit">Save Record</button>
    </form>
    <div>
        <a href="{{route('dashboard')}}">Return to home</a>
    </div>
</body>
</html>
