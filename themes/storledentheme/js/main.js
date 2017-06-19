jQuery(document).ready(function($) {

	
    //$('#storNav').addClass('collapse');
    
    $(".meny").click(function () {
        $(".stang").removeClass("hidden");
        $(".meny").addClass("hidden");
        $("header").addClass("headerColor");
        $(".hr").removeClass("hidden");
        $('#storNav').attr( "style", "display:flex;" );
        $(".storledenAB").show('3000');
        $(".nav-ul").show('3000');
    });

    $(".stang").click(function () {
        $(".meny").removeClass("hidden");
        $(".stang").addClass("hidden");
        setTimeout(function() {
            $("header").removeClass("headerColor");
        }, 250 );
        
        $(".hr").addClass("hidden");
        $(".storledenAB").hide('3000');
        $(".nav-ul").hide('3000');
         
    });

    $(window).on("scroll", function() {
        if($(window).scrollTop() > 600) {
            $("header").addClass("headerColorScroll");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
           $("header").removeClass("headerColorScroll");
        }
    });


    $(".menu > li ").click(function () {
        $(".meny").removeClass("hidden");
        $(".stang").addClass("hidden");
        setTimeout(function() {
            $("header").removeClass("headerColor");
        }, 250 );
        
        $(".hr").addClass("hidden");
        $(".storledenAB").hide('3000');
        $(".nav-ul").hide('3000');
        $(".storNav").removeClass("in");

        $('html, body').animate({
        scrollTop: $('#' + $(this).find('a').attr('href').split("#")[1]).offset().top
        }, 1000);
        
    });


    $(window).on("scroll", function() {
        $( ".top" ).css( "display", "inline" ).fadeOut( 3000);
    });

    $( ".top" ).click(function () {
                $('html, body').animate({
        scrollTop: $('#hem').offset().top
        }, 1000);
    })
    $('.field--name-field-ingress').addClass('effect-title');
    $('.field--name-field-image').addClass('left');
    $('.effect-title').css('display', 'none');
    $('.left').css('display', 'none');
    $('.right').css('display', 'none');
    $('.middle').css('display', 'none');

    $('.block').waypoint(function (argument) {
        $(this).find('.effect-title').show( "drop", {direction: "up"}, 1500 );
        $(this).find('.left').show( "drop", {direction: "left"}, 1500 );
        $(this).find('.right').show( "drop", {direction: "right"}, 1500 );
        $(this).find('.middle').show( "fade", {direction: "right"}, 2000 );
    },{offset: '50%'});
    
    
});
