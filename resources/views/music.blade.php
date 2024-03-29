<!-- resources/views/music.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listen to Music</title>
</head>
<body>
    <h1>Listen to Music</h1>

    <div>
        @foreach ($tracks as $track)
            <div>
                <h3>{{ $track['track']['name'] }}</h3>
                <p>Artists: {{ implode(', ', array_column($track['track']['artists'], 'name')) }}</p>
                <audio controls>
                    <source src="{{ $track['track']['preview_url'] }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <hr>
        @endforeach
    </div>
</body>
</html>
