<!DOCTYPE html>
<html>

<head>
    <title>New Releases</title>
</head>

<body>
    <h1>New Releases</h1>
    @foreach ($newReleases as $newRelease)
        <div>
            <h2>{{ $newRelease['name'] }}</h2>
            <p>Artists: {{ implode(', ', array_column($newRelease['artists'], 'name')) }}</p>
            <p>Release Date: {{ $newRelease['release_date'] }}</p>
            <img src="{{ $newRelease['images'][0]['url'] }}" alt="Album Cover">
        </div>
        <hr>
    @endforeach
</body>

</html>
