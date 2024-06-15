@push('styles')
    <link href="/assets/css/playlist.css" rel="stylesheet">
@endpush
@include('layouts.header')
<div style="display: flex; justify-content : space-between; padding : 12px;" class="">
    <div style="width: 400px;" class="">
        @include('layouts.left-sidebar')
    </div>
    <div style="width: 100%; margin-left : 12px;" class="">
        <div style="background-image: linear-gradient(#533c9e, #2b1f54); border-radius: 12px 12px 0 0;" class="body-playlist">
            @include('layouts.navbar')
            <div style="" class="header-playlist">
                <img style="height: 230px; width : 230px; border-radius : 12px;" src="/assets/img/liked_songs.png">
                <div class="right-header-playlist">
                    <div class="title-header-artist" style="display: flex; align-items: center;">                      
                        <span style="color: #fff; margin-left : 6px; font-size : 14px; font-weight : 600">
                            Playlist
                        </span>
                    </div>
                    <h1 style="visibility: visible; width: 100%; font-size: 6rem; white-space: nowrap; color : #fff;">
                        Bài hát đã thích
                    </h1>
                    <h4 style="color: #fff; font-size : 0.875rem; font-weight: 700;">
                        {{Auth::user()->name}} .
                    </h4>
                </div>
            </div>
        </div>
        <div class="body-list">
            <div class="play-list">
                <img style="height: 64px; width : 64px;" src="/assets/img/play.png">
                <div class="list-song-like" style="margin-top: 24px;">
                    <table style="background: none; color: #fff;" class="table">
                        <thead>
                          <tr style="border-style: hidden; font-size: 14px;
                          font-weight: 400;">
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col"> Album</th>
                            <th scope="col">Ngày thêm</th>
                            <th scope="col"><svg style="width: 18px; fill : #fff;" data-encore-id="icon" role="img" aria-hidden="true" viewBox="0 0 16 16" class="Svg-sc-ytk21e-0 dYnaPI"><path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"></path><path d="M8 3.25a.75.75 0 0 1 .75.75v3.25H11a.75.75 0 0 1 0 1.5H7.25V4A.75.75 0 0 1 8 3.25z"></path></svg></th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $id = 0;
                            @endphp
                            @foreach ($result_song_like as $result)
                                <tr style="border-style: hidden;">
                                    <th style="align-content: center;" scope="row">{{$id += 1}}</th>
                                    <td style="text-align: justify">
                                        <img class="image-artist"  data-image="{{$result->image}}" style="width: 40px; height : 40px; border-radius : 8px;" src="{{$result->image}}">
                                        {{$result->name}}
                                    </td>
                                    <td>{{$result->album_type}}</td>
                                    <td>{{$result->release_date}}</td>
                                    <td>3:40</td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="area-play-song">
    <div class="left-area-play">
        <img class="image-song" style="width: 64px; height : 64px; border-radius : 8px;" src="https://i.scdn.co/image/ab67616d0000b2737991cf825e351f06f1ad06f9">
        <div class="name-song-artist">
            <span class="name-song-add">Cuộc Sống Em Ổn Không</span>
            <span>Ca sĩ</span>
        </div>
    </div>
    <div class="middle-area-play">
        <audio src="" id="audio" class="audio audio_player" preload="metadata">
            <source id="source-audio" src="https://p.scdn.co/mp3-preview/23fdbc0c7ed6d069ee586dc5910d3db497d2b299?cid=d8a5ed958d274c2e8ee717e6a4b0971d" type="audio/mpeg">
        </audio>
        <div class="navigation">
            <button id="prev" class="action-btn" title="Previous">
              <i class="fas fa-backward"></i>
            </button>
            <button id="play" class="action-btn action-btn-big">
              <i class="fas fa-play"></i>
            </button>
            <button id="next" class="action-btn" title="Next">
              <i class="fas fa-forward"></i>
            </button>
    
            <button class="action-btn speaker">
              <i id="speaker_icon" class="fa fa-volume-up" aria-hidden="true"></i>
            </button>
            <input type="range" name="volume" class="player_slider" min="0" max="1" step="0.05" value="1"></input>
    
            <div class="time">
              <span class="time-elapsed">00:00</span>
              <span class="time-duration"> / 3:40</span>
            </div>
        </div>
    </div>
    <div class="end-area-play">
        <span>123</span>
    </div>
</div>