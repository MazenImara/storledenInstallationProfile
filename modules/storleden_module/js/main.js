jQuery(document).ready(function($) {

	// all projects js
	$(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
		$(this).removeClass("active");
	}
	$(this).addClass("active");

    $('.all').addClass('label1');

    $(".filter-button").click(function () {

        $(".filter-button").removeClass('label1');
        $(this).addClass('label1');
    })



    // for projects over 
    $('.outer').hover(function () {
        $(this).find('.over').toggle( "blind", {direction: "left"} );
        
    })
    $('.outer-img').hover(function () {
        $(this).find('.over-img').fadeToggle( "slow", "linear" );
        
    })

    // for all projects file
    $('.filter-btn').click(function () {
        $('.small-btn').removeClass('hidden');
    })
    $('.small-btn').click(function () {
        $('.small-btn').addClass('hidden');
        $(this).removeClass('hidden');
    })
    
});