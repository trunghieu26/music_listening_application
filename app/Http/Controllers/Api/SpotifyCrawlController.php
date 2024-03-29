<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\ApiResponse\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class SpotifyCrawlController extends Controller
{
    use ApiResponse;

    /**
     * Get list User
     *
     * @return void
     */

    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function authenticate()
    {
        return redirect()->away('https://accounts.spotify.com/authorize?' . http_build_query([
            'client_id' => '4d6c8ce7c33a4a28a8848c8211510c0a',
            'response_type' => 'code',
            'redirect_uri' => 'http://127.0.0.1:8000/callback',
            'show_dialog' => 'true',
            'scope' => 'user-library-read playlist-read-private user-follow-read user-read-email user-read-currently-playing',

        ]));
    }

    public function handleCallback(Request $request)
    {
        $code = $request->query('code');
        // dd($code);

        $response = $this->httpClient->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => 'http://127.0.0.1:8000/callback',
                'client_id' => '4d6c8ce7c33a4a28a8848c8211510c0a',
                'client_secret' => '02accbbeb99c410fb51afa0c488fa1db',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $accessToken = $data['access_token'];

        session(['access_token' => $accessToken]);

        return redirect()->route('music')->with('success', 'Successfully authenticated with Spotify!');
    }

    public function showMusic()
    {
        $accessToken = session('access_token');
        // dd($accessToken);

        $response = $this->httpClient->get('https://api.spotify.com/v1/me/tracks', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        $tracks = json_decode($response->getBody()->getContents(), true)['items'];

        return view('music', compact('tracks'));
        // return response()->json($tracks);
    }

    public function getAlbum($albumId)
    {
        $accessToken = session('access_token');
        $albumId = '0yU7VItpGPmPcvKmwLg0JT';

        $response = $this->httpClient->get("https://api.spotify.com/v1/albums/{$albumId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $album = json_decode($response->getBody()->getContents(), true);

            return view('album', compact('album'));
            // return response()->json($album);
        } else {
            return redirect()->route('home')->with('error', 'Failed to fetch album details. Unexpected response from Spotify API.');
        }
    }
    public function getSeveralAlbums()
    {
        $accessToken = session('access_token');
        $albumIds = '382ObEPsp2rxGrnsizN5TX,1A2GTWGtFfWp7KSQTwWOyo,2noRn2Aes5aoNVsU6iWThc';

        $response = $this->httpClient->get("https://api.spotify.com/v1/albums?ids=$albumIds", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $albums = json_decode($response->getBody()->getContents(), true)['albums'];

            return view('albums', compact('albums'));
            // return response()->json($albums);
        } else {
            return redirect()->route('home')->with('error', 'Failed to fetch albums. Unexpected response from Spotify API.');
        }
    }

    public function getNewReleases()
    {
        $accessToken = session('access_token');

        $response = $this->httpClient->get("https://api.spotify.com/v1/browse/new-releases", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $newReleases = json_decode($response->getBody()->getContents(), true)['albums']['items'];

            return view('new-release', compact('newReleases'));
            // return response()->json($newReleases);
        } else {
            return redirect()->route('home')->with('error', 'Failed to fetch new releases. Unexpected response from Spotify API.');
        }
    }

    public function getAlbumTracks($albumId)
    {
        $accessToken = session('access_token');

        $response = $this->httpClient->get("https://api.spotify.com/v1/albums/{$albumId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $album = json_decode($response->getBody()->getContents(), true);

            $response = $this->httpClient->get("https://api.spotify.com/v1/albums/{$albumId}/tracks", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $tracks = json_decode($response->getBody()->getContents(), true)['items'];

                return view('album', compact(['album', 'tracks']));
                // return response()->json([$album, $tracks]);

            } else {
                return redirect()->route('home')->with('error', 'Failed to fetch tracks for the album. Unexpected response from Spotify API.');
            }
        } else {
            return redirect()->route('home')->with('error', 'Failed to fetch album details. Unexpected response from Spotify API.');
        }
    }
}
