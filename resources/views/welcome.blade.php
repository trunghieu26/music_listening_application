@push('styles')
    <link href="assets/css/style.css" rel="stylesheet">
@endpush
@include('layouts.header')
<div style="display: flex; justify-content : space-between;" class="">
    <div style="width: 300px;" class="">
        @include('layouts.left-sidebar')
    </div>
    <div class="">
        @include('layouts.navbar')
        <div class="content-home">
            @if(Auth::user() == '')
                <h1 style="color : #fff; font-weight: 700;">Danh sách phát trên Sunlʌv</h1>
                <div class="playlist-albums">
                    <div class="detail-playlist">
                        <img src="/assets/img/lofi.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">lofi beats</span>
                            <span class="content-detail-playlist">The biggest songs of the 2010s. Cover: Rihanna</span>
                        </div>
                    </div>
                    <div class="detail-playlist">
                        <img src="/assets/img/chillout.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">Chillout Lounge</span>
                            <span class="content-detail-playlist">A mega mix of 75 favorites from the last few years! </span>
                        </div>
                    </div>
                    <div class="detail-playlist">
                        <img src="/assets/img/chills.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">Chill Hits</span>
                            <span class="content-detail-playlist">Kick back to the best new and recent chill hits.</span>
                        </div>
                    </div>
                    <div class="detail-playlist">
                        <img src="/assets/img/piano.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">Peaceful Piano</span>
                            <span class="content-detail-playlist">Peaceful piano to help you slow down, breathe, and relax. </span>

                        </div>
                    </div>
                    <div class="detail-playlist">
                        <img src="/assets/img/rock.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">Rock Classics</span>
                            <span class="content-detail-playlist">Rock legends & epic songs that continue to inspire generations. Cover: Foo Fighters</span>
                        </div>
                    </div>
                    <div class="detail-playlist">
                        <img src="/assets/img/tophits.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">Today's Top Hits</span>
                            <span class="content-detail-playlist">Get happy with today's dose of feel-good songs!</span>
                        </div>
                    </div>
                </div>
            @else
            <div style="height:80vh; overflow-y: auto;">
                <div style="margin-top:24px;">
                    <a href="#" style="color: #fff; background-color:#363636;border-radius:16px; padding : 6px 10px; text-decoration: none;">Tất cả</a>
                    <a href="#" style="color: #fff; background-color:#363636;border-radius:16px; padding : 6px 10px; text-decoration: none;">Nhạc</a>
                    <a href="#" style="color: #fff; background-color:#363636;border-radius:16px; padding : 6px 10px; text-decoration: none;">Podcasts</a>
                </div>
                <div style="margin-top:24px;">
                    <a style="color : #fff; font-weight: 700; font-size: 28px;">Tuyển tập hàng đầu của bạn</a>
                    <div class="playlist-albums">
                        @foreach ($top_hits as $top_hit)
                        <div class="detail-playlist">
                            <div class="image-container">
                                <img class="image-top-hit" src="{{$top_hit->image}}">
                                <div class="play-button">
                                    <img class="play-image-top-hit" style="height: 52px; width : 52px;" src="/assets/img/play.png">
                                </div>
                            </div>
                            <div class="group-title">
                                <span class="title-detail-playlist">{{$top_hit->name}}</span>
                                <span class="content-detail-playlist">{{$top_hit->album_type}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="margin-top:24px;">
                    <a style="color : #fff; font-weight: 700; font-size: 28px;">Album phổ biến</a>
                    <div class="playlist-albums">
                        @foreach ($eps as $ep)
                        <div class="detail-playlist">
                            <img src="{{$ep->image}}">
                            <div class="group-title">
                                <span class="title-detail-playlist">{{$ep->name}}</span>
                                <span class="content-detail-playlist">{{$ep->album_type}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="margin-top:24px;">
                    <a style="color : #fff; font-weight: 700; font-size: 28px;">Nghệ sĩ phổ biến</a>
                    <div class="playlist-albums">
                        @foreach ($artists as $artist)
                        <div data-id="{{$artist->id_new}}" class="detail-artist">
                            <div class="image-container">
                                <img src="{{$artist->image}}" alt="Image">
                            </div>
                            <div class="group-title">
                                <span class="title-detail-artist">{{$artist->name}}</span>
                                <span class="content-detail-artist">Nghệ sĩ</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::user() == '')
                @include('layouts.footer')
            @endif
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/js/home.js"></script>
</body>
</html>