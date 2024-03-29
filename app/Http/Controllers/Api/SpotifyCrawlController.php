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
            'client_id' => '5bbe8428ba114b76aaa0bc1d9c408b5e',
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
                'client_id' => '5bbe8428ba114b76aaa0bc1d9c408b5e',
                'client_secret' => '84e9e19d15404aec81bf7a1c951268b7',
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
            dd($albums);
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

    public function getUrlAlbums()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/browse/new-releases', [
            'headers' => [
                'Authorization' => 'Bearer BQAEACjWxhdzhUUH0hso55nrHKOV3X6AvPXLv-EudkrvI3YV7YzAx49OHvoesvFib0tr_BN3DZZ69Ep0MOegsxPll8JRCoDlefgWHeHDq1iNH4I4K1RFxSPljjEoE4syZZL6Mh0L_lV_Ec80x2OpycDu197r8K1Bwm_ddi54uey_GEVREAgh21R0NghBY7wmFhI_LJe5p6mlIuKyBnHtEK8B_5Auloq7vJvtYYn4jAfev5WD0eQjkC_F9PkSrqlrbjOKzND2p5uIUPOi65UR-0v8BbXWw4PyPSXnTz2AhLNeqLbuZm3tFjcSuaLa5mCDbkPNKOnW-xaRVAu0hi1chY029Eqc',
                'Accept' => 'application/json',
            ],
        ]);

        $albums = json_decode($response->getBody()->getContents(), true);

        return view('albums', ['albums' => $albums['albums']['items']]);
    }
}
