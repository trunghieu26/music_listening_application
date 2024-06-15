@push('styles')
    <link href="/assets/css/profile.css" rel="stylesheet">
@endpush
@include('layouts.header')
<div style="display: flex; justify-content : space-between; padding : 12px;" class="">
    <div style="width: 400px;" class="">
        @include('layouts.left-sidebar')
    </div>
    <div style="width: 100%; margin-left : 12px;" class="">
        <div style="background-image: linear-gradient(#948c8c, #3b3838); border-radius: 12px 12px 0 0;" class="body-artist">
            @include('layouts.navbar')
            <div style="overflow-y: auto; max-height: calc(100vh - 84px); display : flex;">
                <div style="" class="header-artist">
                    <div class="avatar-input">
                        <label class="avatar-input__label" for="file-input">
                          <input type="file" id="file-input" class="avatar-input__input" />
                          <div class="avatar-input__icon">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink"
                              viewBox="0 0 460.8 460.8"
                              fill="currentColor"
                            >
                              <path
                                d="M230.432,239.282c65.829,0,119.641-53.812,119.641-119.641C350.073,53.812,296.261,0,230.432,0
                              S110.792,53.812,110.792,119.641S164.604,239.282,230.432,239.282z"
                              />
                              <path
                                d="M435.755,334.89c-3.135-7.837-7.314-15.151-12.016-21.943c-24.033-35.527-61.126-59.037-102.922-64.784
                              c-5.224-0.522-10.971,0.522-15.151,3.657c-21.943,16.196-48.065,24.555-75.233,24.555s-53.29-8.359-75.233-24.555
                              c-4.18-3.135-9.927-4.702-15.151-3.657c-41.796,5.747-79.412,29.257-102.922,64.784c-4.702,6.792-8.882,14.629-12.016,21.943
                              c-1.567,3.135-1.045,6.792,0.522,9.927c4.18,7.314,9.404,14.629,14.106,20.898c7.314,9.927,15.151,18.808,24.033,27.167
                              c7.314,7.314,15.673,14.106,24.033,20.898c41.273,30.825,90.906,47.02,142.106,47.02s100.833-16.196,142.106-47.02
                              c8.359-6.269,16.718-13.584,24.033-20.898c8.359-8.359,16.718-17.241,24.033-27.167c5.224-6.792,9.927-13.584,14.106-20.898
                              C436.8,341.682,437.322,338.024,435.755,334.89z"
                              />
                            </svg>
                          </div>
                        </label>
                    </div>
                </div>
                <div class="right-header-artist">
                    <div class="title-header-artist" style="display: grid; align-items: center;">                      
                        <span style="color: #fff;">
                            Hồ sơ
                        </span>
                        <span style="color: #fff; font-size: 48px;">
                            {{Auth::user()->name}}
                        </span>
                        <span style="color: #fff"> {{$count_artist_like}} đang theo dõi </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-profile">
            <div class="list-song-like">
                <span style="color: #fff; font-size : 28px; font-weight : 700;">Playlist Công khai</span>
                <div class="playlist-albums">
                    <div class="detail-playlist">
                        <img src="/assets/img/lofi.jpeg">
                        <div class="group-title">
                            <span class="title-detail-playlist">lofi beats</span>
                            <span class="content-detail-playlist">The biggest songs of the 2010s. Cover: Rihanna</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-artist-like">
                <span style="color: #fff; font-size : 28px; font-weight : 700;">Đang theo dõi</span>
            </div>
        </div>
    </div>
</div>