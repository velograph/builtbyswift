jQuery(document).ready(function(){

	if (jQuery(window).width() > 375) {

		// var answer = jQuery(window).height();
		// jQuery( '.home-page-slider-container' ).css('height', answer);
		// jQuery( '.page-content' ).css('top', answer);
		// jQuery( '.home-page-slider-container img' ).css('overflow', 'hidden');
		//
		// var width_answer = jQuery(window).width();
		// jQuery( '.home-page-slider-container img' ).css('width', width_answer);

	}


	if (jQuery(window).width() < 860) {

		// Mobile menu toggle
		jQuery(".slide-out").hide();

		jQuery(".menu-hook").click(function(){
			jQuery(".overlay").show("fade");

		});

		jQuery(".overlay-close").click(function(){
			jQuery(".overlay").hide('fade');
		});

	}

});