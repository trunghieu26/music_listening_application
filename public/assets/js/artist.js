$( document ).ready(function() {
    var isClicked = false;
    $(".list-song").on("hover", function() {
        if($(this).hasClass('active')) {
            $(this).css("background-color", "5a5a5a")
        } else {
            $(this).css("background-color", "2c2c2b")
        }
    })
    var songs = [
      'https://p.scdn.co/mp3-preview/23fdbc0c7ed6d069ee586dc5910d3db497d2b299?cid=d8a5ed958d274c2e8ee717e6a4b0971d'
    ];

    $(".detail-artist").on("click", function () {
      let id = $(this).data('id')
      window.location.href = 'http://127.0.0.1:8000/artist/' + id
  })


    $(".list-song").on("click", function() {

        let linkSong = $(this).data('url');
        
        
        let linkImage = $(this).find('.image-artist').data('image')
        
        let nameSong = $(this).find('.song-name').text();
        
        songs.unshift(linkSong)

        $('.name-song-add').empty()
        $('.name-song-add').text(nameSong)

        $(".image-song").attr('src', linkImage);
        
        $("tr.list-song").removeClass('active')
        if($(this).hasClass('active')) {
          $(this).removeClass('active');
          } else {
            $(this).addClass('active');
            }
            })
          console.log(songs);

    $(".follow-artist").on("click", function () {
        let idArtist = $(this).data('artist')
        let idUser = $(this).data('user')
        let csrfToken = $(this).attr('alt')
        let dataFollow = $('.play-list').find('.follow-artist').text()
        if(dataFollow == 'Theo dõi') {
            $.ajax({
                url : "/artist/follow",
                method : "POST",
                dataType : "json",
                data : {
                    id_artist : idArtist,
                    id_user : idUser,
                    _token : csrfToken
                },
                success: function (response) { 
                    if(response.status == true) {
                        $('.follow-artist').text('');
                        $('.follow-artist').text('Đang theo dõi');
                    }
                }
            })
        } else {
            $.ajax({
                url : "/artist/unFollow",
                method : "POST",
                dataType : "json",
                data : {
                    id_artist : idArtist,
                    id_user : idUser,
                    _token : csrfToken
                },
                success: function (response) { 
                    if(response.status == true) {
                        $('.follow-artist').empty();
                        $('.follow-artist').text('Theo dõi');
                    }
                }
            })
        }
       
    })

    $(".see-more").on("click", function () {
        if($(this).hasClass('active')) {
            $('.list-song').each(function(index) {
                var songId = $(this).data('id');
                if(songId > 5) {
                    $(this).fadeOut();
                }
            })
            $(this).text('Xem thêm')
            $(this).removeClass('active')
        } else {
            $(this).addClass('active')
            $(".list-song").fadeIn();
            $(this).text('Ẩn bớt')
        }
    })

    $(".liked-song-result").on("click", function () {
      window.location.href = 'http://127.0.0.1:8000/playlist'
  })

    $(".liked-song").on("click", function () {
        let idSong = $(this).data('song')
        let idUser = $(this).data('user')
        let csrfToken = $(this).attr('alt')
        if(!($(this).hasClass("active"))) {
            $(this).addClass('active')
            $.ajax({
                url : "/artist/like-song",
                method : "POST",
                dataType : "json",
                data : {
                    id_song : idSong,
                    id_user : idUser,
                    _token : csrfToken
                },
                success: function (response) { 
                    if(response.status == true) {
                        console.log($(this));
                        $('img[name="liked-song"].active').each(function() {
                            $(this).attr('src', '/assets/img/like-song.png'); 
                        });
                    //    $(this).attr('src', '/assets/img/like-song.png'); 
                    }
                }
            })
        } else {
            $(this).removeClass('active')
            $.ajax({
                url : "/artist/dislike-song",
                method : "POST",
                dataType : "json",
                data : {
                    id_song : idSong,
                    id_user : idUser,
                    _token : csrfToken
                },
                success: function (response) { 
                    if(response.status == true) {
                        $('img[name="liked-song"]').each(function() {
                            $(this).attr('src', '/assets/img/dislike-song.png'); 
                        });
                     }
                }
            })
        }
    })

    const audioPlayer = $('#audio')[0];
    const title = $('#title');
    const progressRange = $('.progress-container');
    const progressBar = $('.progress-bar');
    const currentTime = $('.time-elapsed');
    const duration = $('.time-duration');
    const playBtn = $('#play');
    const prevBtn = $('#prev');
    const nextBtn = $('#next');
    const speakerIcon = $('#speaker_icon');
    const volInput = $('input[name="volume"]');
    
    let songIndex = 0;

    loadSong(songs[songIndex]);

    function loadSong(song) {
      title.text(song);
      audioPlayer.src = song;
    }

    function togglePlayPause() {
      if (audioPlayer.paused) {
        playSong();
      } else {
        pauseSong();
      }
    }

    function playSong() {
      console.log(songs);
      $('.music-container').addClass('play');
      playBtn.find('i.fas').removeClass('fa-play').addClass('fa-pause');
      audioPlayer.play();
    }

    function pauseSong() {
      $('.music-container').removeClass('play');
      playBtn.find('i.fas').addClass('fa-play').removeClass('fa-pause');
      audioPlayer.pause();
    }

    function prevSong() {
      songIndex--;
      console.log(songIndex);
      if (songIndex < 0) {
        songIndex = songs.length - 1;
      }
      loadSong(songs[songIndex]);
      playSong();
    }

    function nextSong() {
      songIndex++;
      console.log(songs);
      if (songIndex > songs.length - 1) {
        songIndex = 0;
      }
      loadSong(songs[songIndex]);
      playSong();
    }

    function displayTime(time) {
      const minutes = Math.floor(time / 60);
      let seconds = Math.floor(time % 60);
      seconds = seconds > 9 ? seconds : `0${seconds}`;
      return `${minutes}:${seconds}`;
    }

    function updateProgress() {
      const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
      progressBar.width(`${progressPercent}%`);
      currentTime.text(displayTime(audioPlayer.currentTime));
      if (!isNaN(audioPlayer.duration)) {
        duration.text(displayTime(audioPlayer.duration));
      }
    }

    function setProgress(event) {
      const newTime = event.offsetX / progressRange.width();
      progressBar.width(`${newTime * 100}%`);
      audioPlayer.currentTime = newTime * audioPlayer.duration;
    }

    function handleRangeUpdate() {
      audioPlayer[this.name] = this.value;
      speakerIcon.attr('class', this.value == 0 ? 'fas fa-volume-off' : 'fas fa-volume-up');
    }

    function mute() {
      if (audioPlayer.volume > 0) {
        volInput.val(0);
        audioPlayer.volume = 0;
        speakerIcon.attr('class', 'fas fa-volume-off');
      } else {
        volInput.val(1);
        audioPlayer.volume = 1;
        speakerIcon.attr('class', 'fas fa-volume-up');
      }
    }

    playBtn.on('click', togglePlayPause);
    prevBtn.on('click', prevSong);
    nextBtn.on('click', nextSong);
    audioPlayer.addEventListener('timeupdate', updateProgress);
    progressRange.on('click', setProgress);
    volInput.on('input', handleRangeUpdate);
    speakerIcon.on('click', mute);
    audioPlayer.addEventListener('loadedmetadata', () => {
      duration.text(displayTime(audioPlayer.duration));
    });
})