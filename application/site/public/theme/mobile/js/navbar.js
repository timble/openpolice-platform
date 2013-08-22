/*
	Inspired by Flaunt.js - https://github.com/toddmotto/flaunt-js
*/
;(function($) {
	// DOM ready
	$(function() {
        // Hide the menu so it does not depend on JS support
        $('.navbar .nav').addClass("is-hidden");
		
		// Click to show the navigation
		$('.navbar__handle').click(function(){
            $('.navbar .nav').toggleClass('is-hidden');
		});
	});
})(jQuery);