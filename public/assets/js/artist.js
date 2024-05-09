$( document ).ready(function() {
    var isClicked = false;
    $(".list-song").on("hover", function() {
        if($(this).hasClass('active')) {
            $(this).css("background-color", "5a5a5a")
        } else {
            $(this).css("background-color", "2c2c2b")
        }
    })
    $(".list-song").on("click", function() {
        $("tr.list-song").removeClass('active')
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    })

    $(".follow-artist").on("click", function () {

        let idArtist = $(this).data('artist')
        let idUser = $(this).data('user')
        let csrfToken = $(this).attr('alt')
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
                
                console.log(response);
             }
        })
    })
})