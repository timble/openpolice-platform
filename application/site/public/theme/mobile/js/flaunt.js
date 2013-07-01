/*
	Inspired by Flaunt.js - https://github.com/toddmotto/flaunt-js
*/
;(function($) {
	// DOM ready
	$(function() {
		// Append the handle
		$('.navbar').prepend($('<div class="navbar__handle"></div>'));

        // Hide the menu so it does not depend on JS support
        $('.nav').addClass("is-hidden");
		
		// Click to show the navigation
		$('.navbar__handle').click(function(){
            $('.navbar .navbar-inner > .nav').toggleClass('is-hidden');
		});
	});
})(jQuery);