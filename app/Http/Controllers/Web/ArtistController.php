<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artist_album;
use App\Models\Follower;
use App\Models\PlaylistSong;
use App\Models\Top_track;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function index($id)
    {

        if(empty(Auth::user())) {
            return redirect()->intended('login');
        }
        
        
        $artist = Artist::where('id', $id)->get()->toArray()[0];
        $artist_song = Artist_album::where('artists_id', $id)->inRandomOrder()->distinct()->get();
        $url_external = json_decode($artist['external_urls'])->spotify;
        $explode_url = (explode('/', $url_external));
        $artist['id_new'] = end($explode_url);
        

        $list_artist = Artist::inRandomOrder()->distinct()->limit(6)->get();
        foreach($list_artist as $artists) {
            $url_external = json_decode($artists['external_urls'])->spotify;
            $explode_url = (explode('/', $url_external));
            $artists['id_new'] = end($explode_url);
            $artists['image'] = (json_decode($artists->images)[0])->url;
        }
        // dd($list_artist);

        $artist_like = '';
        if(!(Auth::user() == '')) {
            $id_user = Auth::user()->id;
            $user_id = Auth::user()->id;
            $artist_like = DB::table('followers')
            ->join('artists', 'artists.id', '=', 'followers.artist_id')
            ->where('user_id', '=', $user_id)
            ->get();
            
            foreach($artist_like as $like) {
                $url_image = (json_decode($like->images)[0])->url;
                $like->image= $url_image;
            }
        }

        foreach($artist_song as $ep) {
            $ep_external = json_decode($ep['external_urls'])->spotify;
            $explode_url_new = (explode('/', $ep_external));
            $ep['id_new'] = end($explode_url_new);
            // $explode_url = (explode('/', $url_external));
            $ep['image'] = ((json_decode($ep->images)[0]))->url;
            $top_track = DB::table('top_tracks')->where('name', $ep['name'])->get();
            if(!empty($top_track)) {
                foreach($top_track as $track) {
                    $ep['preview_url'] = $track->preview_url;
                    }
            }
            }
            // dd($artist_song);
            //get list song like
            $song_likes = PlaylistSong::where('user_id', $id_user)->get();
            $list_song_like = [];
            foreach($song_likes as $sl) {
                array_push($list_song_like, $sl['album_id']);
        }


        $artist_album = Artist_album::where('artists_id', $id)->limit(6)->get();
        foreach($artist_album as $top_hit) {
            $top_hit['image'] = (json_decode($top_hit->images)[0])->url;
        }
        $follower = Follower::where('artist_id', $id)->where('user_id', $id_user)->first();

        $count_song_like = PlaylistSong::where('user_id', $user_id)->count();
        return view('artist.index', compact('artist', 'artist_song','follower','artist_album', 'list_artist','artist_like', 'list_song_like','count_song_like'));  
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

    public function unFollowArtist()
    {
        $is_artist = $_POST['id_artist'];
        $id_user = $_POST['id_user'];
        $check_exist_record = Follower::where('artist_id', $is_artist)->where('user_id', $id_user)->delete();
        if($check_exist_record) {
            return response()->json([
                'status' => true,
            ]);
        }  
        return response()->json([
            'status' => false,
        ]);
    }

    public function likeSong()
    {
        $id_song = $_POST['id_song'];
        $id_user = $_POST['id_user'];

        $check_exist_record = PlaylistSong::where('album_id', $id_song)->where('user_id', $id_user)->first();

        if(!empty($check_exist_record)) {
            return response()->json([
                'status' => false,
            ]);
        }
        $result =  PlaylistSong::create([
            'user_id' => $id_user,
            'album_id' => $id_song
        ]);
        return response()->json([
            'status' => true,
            'result' => $result
        ]);
    }

    public function dislikeSong()
    {
        $id_song = $_POST['id_song'];
        $id_user = $_POST['id_user'];

        $check_exist_record = PlaylistSong::where('album_id', $id_song)->where('user_id', $id_user)->first();

        if(empty($check_exist_record)) {
            return response()->json([
                'status' => false,
            ]);
        } 
        PlaylistSong::where('album_id', $id_song)->where('user_id', $id_user)->delete();
        return response()->json([
            'status' => true,
        ]);
        // dd($is_artist, $id_user);
    }
}
