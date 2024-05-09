$( document ).ready(function() {
    $(".detail-artist").on("click", function () {
        let id = $(this).data('id')
        window.location.href = 'http://127.0.0.1:8000/artist/' + id
    })
    $(".dropdown-toggle").on("click", function () {
        if($('.dropdown-menu').hasClass('active')) {
            $(".dropdown-menu").css("display" , "none")
            $(".dropdown-menu").removeClass("active")
        } else {
            $(".dropdown-menu").css("display" , "block")
            $(".dropdown-menu").addClass("active")
        }
    })
    $(".list-song").on("click", function() {
        $(this).addClass('active');
    })
    $(".list-menu").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
    })
    $(".prev-button").on("click", function () {
        window.history.back();
    })
})