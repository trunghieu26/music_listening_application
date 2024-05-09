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
                    <button alt="{{csrf_token()}}" data-user="{{Auth::user()->id}}" data-artist="{{$artist['id_new']}}" class="follow-artist" style="padding :6px 18px; border-radius : 18px; border : 0.5px solid #fff; color : #fff; background-color : transparent ; margin-left : 12px; margin-right : 12px;">Theo dõi</button>
                    <img style="color : #fff;" src="/assets/img/points.png">
                </div>
                <span style="color: #fff; font-size : 28px; font-weight : 700;">Phổ biến</span>
                <table class="table">
                    <tbody style="border-style: none;">
                        @php
                            $id = 0;
                        @endphp
                        @foreach ($artist_song as $song)
                        <tr data-url="{{$song->preview_url}}" class="list-song" style="border-style: none;border-width : 0;text-align: center; color : #fff;">
                            <th style="align-content: center;" scope="row">{{$id += 1}}</th>
                            <td style="text-align: justify">
                                <img style="width: 40px; height : 40px; border-radius : 8px;" src="{{$song->image}}">
                                <span>{{$song->name}}</span>
                            </td>
                            <td style="align-content: center">{{$song->release_date}}</td>
                            <td><img style="color : #fff;" src="/assets/img/points.png"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="area-play-song">
    <div class="left-area-play">
        <img style="width: 64px; height : 64px; border-radius : 8px;" src="{{(json_decode($artist['images'])[0])->url}}">
        <div class="name-song-artist">
            <span>Nang co mang em ve</span>
            <span>Ca si</span>
        </div>
        {{-- <svg data-encore-id="icon" role="img" aria-hidden="true" viewBox="0 0 16 16" class="Svg-sc-ytk21e-0 dYnaPI"><path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"></path><path d="M11.75 8a.75.75 0 0 1-.75.75H8.75V11a.75.75 0 0 1-1.5 0V8.75H5a.75.75 0 0 1 0-1.5h2.25V5a.75.75 0 0 1 1.5 0v2.25H11a.75.75 0 0 1 .75.75z"></path></svg> --}}
    </div>
    <div class="middle-area-play">
        <audio controls>
            <source src="https://p.scdn.co/mp3-preview/2f37da1d4221f40b9d1a98cd191f4d6f1646ad17" type="audio/mpeg">
        </audio> 
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/artist.js"></script>
</body>
</html>