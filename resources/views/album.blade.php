<!DOCTYPE html>
<html>

<head>
    <title>{{ $album['name'] }}</title>
</head>

<body>
    <h1>{{ $album['name'] }}</h1>
    <h2>Artists: {{ implode(', ', array_column($album['artists'], 'name')) }}</h2>
    <h2>Release Date: {{ $album['release_date'] }}</h2>
    <h2>Tracks:</h2>
    <ul>
        @foreach ($tracks as $track)
            <li>{{ $track['name'] }}</li>
            <p>Artists: {{ implode(', ', array_column($track['artists'], 'name')) }}</p>
            <audio controls>
                <source src="{{ $track['preview_url'] }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        @endforeach

    </ul>
</body>

</html>
