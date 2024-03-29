@include('layouts.header')
<div style="display: flex; justify-content : space-between;" class="">
    <div style="width: 20%;" class="">
        @include('layouts.left-sidebar')
    </div>
    <div style="width: 79%;" class="">
        @include('layouts.navbar')
        <div class="content-home">
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
            @include('layouts.footer')
        </div>
    </div>
</div>