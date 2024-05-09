<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artist_album;
use App\Models\Follower;
use App\Models\Top_track;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function index($id)
    {

        if(Auth::user() == null) {
            return redirect()->intended('login');
        }
        
        $id_user = Auth::user()->id;
        dd($id_user);
        
        $artist = Artist::where('id', $id)->get()->toArray()[0];
        $artist_song = Artist_album::where('artists_id', $id)->inRandomOrder()->distinct()->limit(5)->get();
        $url_external = json_decode($artist['external_urls'])->spotify;
        $explode_url = (explode('/', $url_external));
        $artist['id_new'] = end($explode_url);
        foreach($artist_song as $ep) {
            $ep['image'] = ((json_decode($ep->images)[0]))->url;
            $top_track = DB::table('top_tracks')->where('name', $ep['name'])->get();
            if(!empty($top_track)) {
                foreach($top_track as $track) {
                    $ep['preview_url'] = $track->preview_url;
                }
            }
        }
        return view('artist.index', compact('artist', 'artist_song'));  
    }

    public function followArtist()
    {
        $is_artist = $_POST['id_artist'];
        $id_user = $_POST['id_user'];
        $check_exist_record = Follower::where('artist_id', $is_artist)->where('user_id', $id_user)->first();
        if(empty($check_exist_record)) {
            $result =  Follower::create([
                'user_id' => $id_user,
                'artist_id' => $is_artist
            ]);

            return response()->json([
                'status' => true,
                'result' => $result
            ]);
        }  
        return response()->json([
            'status' => false,
        ]);
    }
}
