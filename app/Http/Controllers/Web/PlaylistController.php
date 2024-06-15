<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PlaylistSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index()
    {
        if(empty(Auth::user())) {
            return redirect()->intended('login');
        }
        
        $artist_like = '';
        $user_id = Auth::user()->id;
        $artist_like = DB::table('followers')
            ->join('artists', 'artists.id', '=', 'followers.artist_id')
            ->where('user_id', '=', $user_id)
            ->get();
            
        foreach($artist_like as $like) {
            $url_image = (json_decode($like->images)[0])->url;
            $like->image= $url_image;
        }
        $count_song_like = PlaylistSong::where('user_id', $user_id)->count();


        $result_song_like = DB::table('playlist_songs')
                            ->join('artist_albums', 'artist_albums.id','=','playlist_songs.album_id')
                            ->where('playlist_songs.user_id',$user_id)
                            ->get();

        foreach($result_song_like as $result) {
            $url_image = (json_decode($result->images)[0])->url;
            $result->image= $url_image;
        }

        return view('playlist.index',compact('artist_like','count_song_like','result_song_like'));
    }
}
