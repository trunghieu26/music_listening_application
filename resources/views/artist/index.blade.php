@push('styles')
    <link href="/assets/css/artist.css" rel="stylesheet">
@endpush
@include('layouts.header')
<div style="display: flex; justify-content : space-between; padding : 12px;" class="">
    <div style="width: 400px;" class="">
        @include('layouts.left-sidebar')
    </div>
    <div style="width: 100%; margin-left : 12px;" class="">
        <div style="background-image: linear-gradient(#948c8c, #3b3838); border-radius: 12px 12px 0 0;" class="body-artist">
            @include('layouts.navbar')
            <div style="    overflow-y: auto; max-height: calc(100vh - 84px);">
                <div style="" class="header-artist">
                    <img style="height: 232px; width : 232px; border-radius : 50%;" src="{{(json_decode($artist['images'])[0])->url}}">
                    <div class="right-header-artist">
                        <div class="title-header-artist" style="display: flex; align-items: center;">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.1392 2.40173C10.79 1.84526 11.8558 1.84526 12.5161 2.40173L14.0063 3.68446C14.2892 3.92969 14.8174 4.12776 15.1947 4.12776H16.7981C17.7979 4.12776 18.6184 4.94832 18.6184 5.9481V7.55151C18.6184 7.91935 18.8165 8.45696 19.0617 8.73992L20.3445 10.2301C20.9009 10.8809 20.9009 11.9467 20.3445 12.607L19.0617 14.0972C18.8165 14.3801 18.6184 14.9083 18.6184 15.2856V16.889C18.6184 17.8888 17.7979 18.7093 16.7981 18.7093H15.1947C14.8269 18.7093 14.2892 18.9074 14.0063 19.1526L12.5161 20.4354C11.8653 20.9918 10.7995 20.9918 10.1392 20.4354L8.64901 19.1526C8.36606 18.9074 7.83787 18.7093 7.4606 18.7093H5.8289C4.82912 18.7093 4.00856 17.8888 4.00856 16.889V15.2762C4.00856 14.9083 3.81049 14.3801 3.57469 14.0972L2.3014 12.5975C1.75435 11.9467 1.75435 10.8904 2.3014 10.2396L3.57469 8.73992C3.81049 8.45696 4.00856 7.92878 4.00856 7.56094V5.93866C4.00856 4.93889 4.82912 4.11832 5.8289 4.11832H7.4606C7.82844 4.11832 8.36606 3.92026 8.64901 3.67503L10.1392 2.40173Z" fill="#4285F4"/>
                                <path d="M10.177 14.3986C9.98834 14.3986 9.80914 14.3232 9.6771 14.1911L7.3946 11.9086C7.12107 11.6351 7.12107 11.1824 7.3946 10.9089C7.66812 10.6354 8.12084 10.6354 8.39437 10.9089L10.177 12.6915L14.2327 8.63581C14.5062 8.36228 14.9589 8.36228 15.2324 8.63581C15.506 8.90933 15.506 9.36206 15.2324 9.63558L10.6769 14.1911C10.5448 14.3232 10.3656 14.3986 10.177 14.3986Z" fill="#FFB31C"/>
                                </svg>                        
                            <span style="color: #fff; margin-left : 6px;">
                                Nghệ sĩ được xác minh
                            </span>
                        </div>
                        <h1 style="color: #fff;">
                            {{$artist['name']}}
                        </h1>
                        <h4 style="color: #fff;">
                            {{number_format(json_decode($artist['followers'])->total / 1000, 3, '.', '')}} người theo dõi
                        </h4>
                    </div>
                </div>
                <div class="content-artist">
                    <div class="play-list">
                        <img style="height: 64px; width : 64px;" src="/assets/img/play.png">
                        <button data-follow="{{$follower}}" alt="{{csrf_token()}}" data-user="{{Auth::user()->id}}" data-artist="{{$artist['id_new']}}" class="follow-artist" style="padding :6px 18px; border-radius : 18px; border : 0.5px solid #fff; color : #fff; background-color : transparent ; margin-left : 12px; margin-right : 12px;">{{$follower != null ? 'Đang theo dõi' : 'Theo dõi' }}</button>
                        <img style="color : #fff;" src="/assets/img/points.png">
                    </div>
                    <span style="color: #fff; font-size : 28px; font-weight : 700;">Phổ biến</span>
                    <table class="table">
                        <tbody style="border-style: none;">
                            @php
                                $id = 0;
                                $id_new = 1;
                            @endphp
                            @foreach ($artist_song as $song)
                            <tr data-id="{{$id_new + $id}}" data-url="{{$song->preview_url}}" class="list-song" style="border-style: none;border-width : 0;text-align: center; color : #fff; {{$id >= 5 ? 'display:none' : ''}}">
                                <th style="align-content: center;" scope="row">{{$id += 1}}</th>
                                <td style="text-align: justify">
                                    <img class="image-artist"  data-image="{{$song->image}}" style="width: 40px; height : 40px; border-radius : 8px;" src="{{$song->image}}">
                                    <span class="song-name">{{$song->name}}</span>
                                </td>
                                <td  class="image-container">
                                    <img  name="liked-song" alt="{{csrf_token()}}" data-user="{{Auth::user()->id}}" data-song="{{$song['id_new']}}" class="liked-song" style="color : #fff; width : 24px; margin-top : 8px;" src="{{ in_array($song['id_new'], $list_song_like) ? '/assets/img/like-song.png' : '/assets/img/dislike-song.png'}}">
                                    <div class="modal-new">
                                        <p>Thêm vào danh sách phát.</p>
                                    </div>
                                </td>
                                <td style="align-content: center">{{$song->release_date}}</td>
                                <td>
                                    <img style="color : #fff;" src="/assets/img/points.png">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="see-more" style="color: #fff; font-size : 14px; font-weight : 700;">Xem thêm</span>
                    <div style="margin-top: 24px" class="list-disc">
                        <span style="color: #fff; font-size : 28px; font-weight : 700;">Danh sách đĩa nhạc</span>
                        <div class="playlist-albums">
                            @foreach ($artist_album as $album)
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="{{$album->image}}">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">{{$album->name}}</span>
                                    <span class="content-detail-playlist">{{$album->album_type}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="append-artist">
                        <span style="color: #fff; font-size : 28px; font-weight : 700;">Có sự xuất hiện của {{$artist['name']}}</span>
                        <div class="playlist-albums">
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f000000022143ff19eac2ad6d19a61b0b">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">Thiên Hạ Nghe Gì</span>
                                    <span class="content-detail-playlist">Những gì mà người bên cạnh bạn đang nghe. Ảnh bìa: Sơn Tùng M-TP</span>
                                </div>
                            </div>
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f00000002d4d38b6f3160be3ef8b4b9b5">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">V-Pop Không Thể Thiếu</span>
                                    <span class="content-detail-playlist">V-Pop nở hoa trên những ca khúc này. Ảnh bìa: SOOBIN</span>
                                </div>
                            </div>
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f00000002b8d4b3c31e3c26dde1ec3917">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">lofi thật lâu phai</span>
                                    <span class="content-detail-playlist">Những 🎶 lãng đãng khó phai. </span>
                                </div>
                            </div>
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f00000002f3ea29d3969c45549cbc5eaa">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">Inđậm Indie</span>
                                    <span class="content-detail-playlist">Những ca khúc hay nhất từ dòng nhạc rất đa dạng. Ảnh bìa: Vũ.</span>
                                </div>
                            </div>
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f00000002711e87893529bd65ad345e73">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">Best of Inđậm Indie 2023</span>
                                    <span class="content-detail-playlist">Những dấu ấn Inđậm Indie nổi bật năm 2023. Ảnh bìa: Vũ.</span>
                                </div>
                            </div>
                            <div class="detail-playlist">
                                <div class="image-container">
                                    <img class="image-top-hit" src="https://i.scdn.co/image/ab67706f00000002a0bd130d41d65d8af061b9ac">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-playlist">Best of Hip-hop Việt 2023</span>
                                    <span class="content-detail-playlist">Những con track Hip-hop Việt nổi bật năm 2023. Ảnh bìa: Phúc Du</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 24px" class="artist-dif">
                        <span style="color: #fff; font-size : 28px; font-weight : 700;">Fan cũng thích</span>
                        <div class="playlist-albums">
                            @foreach ($list_artist as $artist)
                            <div data-id="{{$artist->id_new}}" class="detail-artist">
                                <div class="image-container">
                                    <img src="{{$artist->image}}" alt="Image">
                                    <div class="play-button">
                                        <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                    </div>
                                </div>
                                <div class="group-title">
                                    <span class="title-detail-artist">{{$artist->name}}</span>
                                    <span class="content-detail-artist">Nghệ sĩ</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="margin-top: 24px; display : grid; border-radius : 8px;" class="artist-dif">
                        <span style="color: #fff; font-size : 28px; font-weight : 700;">Giới thiệu</span>
                        <img style="border-radius : 8px;" src="https://i.scdn.co/image/ab6761670000ecd4f8d796f89d1a62296722cdd1">
                    </div>
                    <div style="height: 300px;"></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/artist.js"></script>
</body>
</html>