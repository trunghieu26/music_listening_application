<?php

namespace App\Http\Controllers\Web;

use Aerni\Spotify\Spotify as SpotifySpotify;
use Aerni\Spotify\SpotifyAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Aerni\Spotify\Spotify;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Artist_album;
use App\Models\Top_track;

class HomeController extends Controller
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
        $access_token = "BQBgfaspSu8r3PDHyjYh-IsmN2KRMXWSSR_HZEc7pGd3BgnLfhSEUZXQ4-LkWLjrjh9bsQVZVTCpDIn97G2qyl_F8qpr7pQS33CFVh-Ec5tKfgmwtSkp8YAeR-L0bnwmUTiqGwIpthm2ECJAxO9SrFGgNRwYq_p6JkeLDvg6ebSVIY6QpuRHW6rUE-73gwpLzUA4uug6R5CpoDLFpRnPnp4o3NQTZYjJKwfnnxbanN7hqziZdxsbq3v8AALZcQ6FAWmWs131L69ekZjl3hFoIR0Dg4SMqatsyDZENcd_yAiVi0kkQt-v55Rs7w1ERO5xkgnyTM5zr12pM2roVp5qP2Ncjadd";
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/artists?ids=6NF9Oa4ThQWCj6mogFSrVD,6d0dLenjy5CnR5ZMn2agiV,3E6LGptA8lBEXPHAQCE3vr,4APrfmUo8KRrjCVuyoKvwY,4QC9UUJeYEo4wnbTvuOHLo,2Xlia1jlI7JDki4Xa42uyK,52UlQPpkuAzH3BTfRDevYc,6Ca5ccx9CM1kd0LBz1T83U,7LLfmKhGZI11XO0dO4xDI7', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return $albums = json_decode($response->getBody()->getContents(), true);
        
    }

    public function getAlbumsArtist()
    {
        $access_token = "BQBDBkdsUvVXhzERKcMmre6Hb6Ao45gKR3jcPfbD_BlpjeU8VbrXdJJjYXVTYebNHSlqVF00RIt6T8-BfebkprmuYFVV1Xtuc1o8JnysFG1FV2Qcg-YOZyrEJuVB9AD3q9KTQGUSaEsPkjIXp5WbIz_wUa8rKvIuKqaRlEe7YwdrYemPDqXxurb35tCVqppm2OEs90x_oZ5O1u5Vk4vgT03bL2T2eLY8ocXmYypdcjxZwHGqCuxARhr86kOS7tXKgW7L_T71julss9IMozYHkMWfFcsICJ6TPbfyvgrBBj_9O9EP9-8maY9v7UvjlaOnIWSh1B7h2TiSqZRskaOA7ikNPm61";
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/artists/6Ca5ccx9CM1kd0LBz1T83U/albums', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return $albums = json_decode($response->getBody()->getContents(), true);
        
    }
    public function getTopTrack()
    {
        $access_token = "BQAUO-ZGYi1tro2_sUWIYsMJki9pcHfKrgiDixRcGUogoyHpkuHqjn41azy3abCC-FU7pG4QeEHVdUML9_YTmMR44lhQMWf-3J599ldhLMAT0olCpBVE5eo4xah8V6_Gey8OA-OtKg-R5Kjz0f2WRMnSy_hR1rcd5SJHOSAdfFkSga4joTG2UOxvIk_ISibSTlGMkCP6VOuIG5UMAIYK17pGmc3a2cXFns6qaOJwTJ2NKxbdilTH1ozp4gs2wJHfZOjmnRLWihOm8qvHLY5AZi35Yn2vfFyAl_WtqWoU31xx0jXY0aNyB4YVt_KAb8Zy33zG6cUuNINn82atybuDxesX8GB5";
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/artists/7LLfmKhGZI11XO0dO4xDI7/top-tracks', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return $albums = json_decode($response->getBody()->getContents(), true);
        
    }

    public function getTrack()
    {
        $access_token = "BQCpJFLVkkweHgVzJo4XLIh_lB5kV9aSadrdlDXxAPVV-Oct4uMh1IPstGU5a6ZBGQ4IqT29hhPFfbkql1larAWO2Z6u5I8UUVPgAbgP53I2JklNBTcF3if2aYF_atSK-7v8CQKpuHucCwn4eMI40OgpwV0CZnTHE40GMtvb0oByheum8TCyKtP46J8PzgnxEzCTZCaBBXhql-pvNeCvLwglA9iCw7jG31SZ393_NSjMMCIxiAEniSJsow_bhAvsbWnE6k8ZyvX75iE1scWhyWBYPXnsT9f7LFBH6F6SU1sBTeD8Cs9XeKbuf_cYZjWEuJEn74Eb9AGVQGLOLHo_fp3MLthm";
        $client = new Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/tracks/7jLSThU5Kg1RWt19Leiaxm', [
            'headers' => [
                'Authorization' => 'Bearer '.$access_token,
                'Accept' => 'application/json',
            ],
        ]);

        return $albums = json_decode($response->getBody()->getContents(), true);
    }

    public function index()
    {   
        
        // $artist = $this->getTrack();
        // dd($artist);
        // foreach($artist as $ar) {
        //     // Artist::create([
        //     //     "id" => $ar['id'],
        //     //     "external_urls" => json_encode($ar['external_urls']),
        //     //     "followers" => json_encode($ar['followers']),
        //     //     "genres" => json_encode($ar['genres']),
        //     //     "images" => json_encode($ar['images']),
        //     //     "name" => $ar['name'],
        //     //     "type" => $ar['type']
        //     // ]);
        //     // Top_track::create([ 
        //     //     'id' => $ar['id'],
        //     //     'album_id' => $ar['album']['id'],
        //     //     'artist_id' => '7LLfmKhGZI11XO0dO4xDI7',
        //     //     'preview_url' => $ar['preview_url'],
        //     //     'href' => $ar['href'],
        //     //     'name' => $ar['name'],
        //     // ]);
        // }
        
        $top_hits = Album::inRandomOrder()->distinct()->limit(6)->get();
        foreach($top_hits as $top_hit) {
            $top_hit['image'] = (json_decode($top_hit->images)[0])->url;
        }

        $eps =  Album::where('album_type', 'album')->inRandomOrder()->distinct()->limit(6)->get();
        foreach($eps as $ep) {
            $ep['image'] = (json_decode($ep->images)[0])->url;
        }
        
        $artists = Artist::inRandomOrder()->distinct()->limit(6)->get();
        foreach($artists as $artist) {
            $url_external = json_decode($artist['external_urls'])->spotify;
            $explode_url = (explode('/', $url_external));
            $artist['id_new'] = end($explode_url);
            $artist['image'] = (json_decode($artist->images)[0])->url;
        }

        return view("welcome",compact('top_hits','eps', 'artists'));
    }
}
