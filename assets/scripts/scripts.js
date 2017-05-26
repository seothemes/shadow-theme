jQuery(function( $ ) {

	// Remove 'no-js' class from body.
	$('body').removeClass('no-js');

	// Add menu-button (☰) in the site-header.
	$(".site-header .title-area").after('<div class="menu-button">☰</div>');

	// Toggle menu on click.
	$(".menu-button").click(function(){
		$(".nav-primary").slideToggle();
	});

	// Add class to image if wider than content.
	$('.entry-content img').each( function() {
		if( $(this).width() > 539 ) {
			$(this).addClass('unwrap');
		}
	} );

	// Remove menu open class on bigger screens. 
	$(window).resize(function(){
		if(window.innerWidth > 767) {
			$(".genesis-nav-menu, .sub-menu").removeAttr("style");
			$(".menu-item").removeClass("menu-open");
		}
	});

	// Show sub menu on smaller screens.
	$(".menu-item").click(function(event){
		if (event.target !== this)
		return;
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

	// Fade out titles.
	$(document).on("scroll", function() {
    	$(".single .entry-header .wrap, .page .entry-header .wrap").css("opacity", 1 - $(window).scrollTop() / 400);
  	});

  	$(window).scroll(function(e){
  		parallax();
  	});

  	// Parallax.
  	function parallax(){
  		var scrolled = $(window).scrollTop();
  		$('.single .entry-header .wrap, .page .entry-header .wrap').css({
			transform: "translate3d(0, "+ (scrolled*0.25) +"px, 0)"
		});
  	}

	// Site header shrink.
	$( document ).on( "scroll", function() {

		var header = $( '.site-header' );

		if( $( document ).scrollTop() > 0 ){
			if( $( header ).css( 'position' ) === 'fixed' ) {
				$( header ).addClass( 'shrink' );
			}
		} else {
			$( header ).removeClass( 'shrink' );
		}
	} );

});