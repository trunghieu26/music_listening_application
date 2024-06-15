<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\PlaylistSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        $artist_like = DB::table('followers')
            ->join('artists', 'artists.id', '=', 'followers.artist_id')
            ->where('user_id', '=', $id)
            ->get();
            
        foreach($artist_like as $like) {
            $url_image = (json_decode($like->images)[0])->url;
            $like->image= $url_image;
        }
        $count_song_like = PlaylistSong::where('user_id', $id)->count();

        $count_artist_like = Follower::where('user_id', $id)->count();
        return view('user.profile', compact('count_song_like','artist_like','count_artist_like'));

    }
}
