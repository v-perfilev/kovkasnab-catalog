$(window).scroll(function(){
	var scrolled = $(this).scrollTop();
	var height = $('.home-banner').height();

	if( scrolled >= height ) {
		$('.header').removeClass('header-home');
	}   
	if( scrolled < height ) {     
		$('.header').addClass('header-home');
	}
});


$('.home-banner .scroll-button').click(function () {
    var height = $('.home-banner').height();
    $('body,html').animate({
        scrollTop: height
    }, 1200);
    return false;
});

$('.footer .scroll-button').click(function () {
    var win = $(window).height();
    $('body,html').animate({
        scrollTop: 0
    }, 1500);
    return false;
});


$(document).ready(function() {

    var Menu = {

        el: {
            ham: $("#burger-button"),
            menuTop: $(".menu-top"),
            menuMiddle: $(".menu-middle"),
            menuBottom: $(".menu-bottom")
        },

        init: function() {
            Menu.bindUIactions();
        },

        bindUIactions: function() {
            Menu.el.ham
                .on(
                "click",
                function(event) {
                    Menu.activateMenu(event);
                    event.preventDefault();
                }
            );
        },

        activateMenu: function() {
            Menu.el.menuTop.toggleClass("menu-top-click");
            Menu.el.menuMiddle.toggleClass("menu-middle-click");
            Menu.el.menuBottom.toggleClass("menu-bottom-click");
        }
    };

    Menu.init();

    $("#burger-button").click(function() {
        $(".menu-collapsed").toggleClass("menu-expanded");
    });

});

