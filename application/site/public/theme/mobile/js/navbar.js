/*
	Inspired by Flaunt.js - https://github.com/toddmotto/flaunt-js
*/
;(function($) {
	// DOM ready
	$(function() {

		// Click to show the navigation
		$('.navbar__handle').click(function(){
            $('.navbar .nav').toggleClass('is-visible');
		});
	});
})(jQuery);