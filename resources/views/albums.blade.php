<!DOCTYPE html>
<html>

<head>
    <title>Albums</title>
</head>

<body>
    <h1>Albums</h1>
    @foreach ($albums as $album)
        <div>
            <h2><a href="{{ route('album.show', ['albumId' => $album['id']]) }}">{{ $album['name'] }}</a>
            </h2>
            <p>Artists: {{ implode(', ', array_column($album['artists'], 'name')) }}</p>
            <p>Release Date: {{ $album['release_date'] }}</p>
            <img src="{{ $album['images'][0]['url'] }}" alt="Album Cover">
        </div>
        <hr>
    @endforeach
</body>

</html>
