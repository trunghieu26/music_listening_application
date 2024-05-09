<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AlbumController extends Controller
{
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


    public function getAlbums()
    {
        $access_token = "BQDbyThHJL_1R05OhZOKym13kVr4tfZMHvf000Rd0L27VQeR7DZukqqGeq36s1P0iymo5IJyO0ptSGjNyIyEnOnQyJlMZGsNpx6KWcxroD5x0ME78N5KzOfea6kxhJRSljh9d1q9eK1eok1BNuORFR7GHtsbH1nURvp7SohOADA1SrePDXnUjTAgjJGEmRFZ1F5LU5izDMmSMX3WuXzPnqXHJXNeJIgEqO-g4alvR2X4ecprDyBQ1mrwXH6Rwjp3efFnyv-j2vipokPVkEYMNRWp59YQtTHMPdsj9wCO8lLKRD-iK_dfizCaKq2-tj9cIlbFV36mwxxPmq7czQf7xahPF0of";
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/browse/new-releases?offset=201&limit=50', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return $albums = json_decode($response->getBody()->getContents(), true);
        
    }
}
