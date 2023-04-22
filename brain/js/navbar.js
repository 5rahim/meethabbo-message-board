var num = 176; //number of pixels before modifying styles

$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
          $('.header-menu').addClass('active');
    } else {
          $('.header-menu').removeClass('active');
    }
});
