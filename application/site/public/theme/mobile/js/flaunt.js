/*
	Flaunt.js v1.0.0
	by Todd Motto: http://www.toddmotto.com
	Latest version: https://github.com/toddmotto/flaunt-js
	
	Copyright 2013 Todd Motto
	Licensed under the MIT license
	http://www.opensource.org/licenses/mit-license.php

	Flaunt JS, stylish responsive navigations with nested click to reveal.
*/
;(function($) {

	// DOM ready
	$(function() {
		
		// Append the mobile icon nav
		$('.navbar').prepend($('<div class="nav-mobile"></div>'));
		
		// Add a <span> to every .nav-item that has a <ul> inside
		$('.nav li').has('ul').prepend('<span class="nav-click"><i class="nav-arrow"></i></span>');
		
		// Click to reveal the nav
		$('.nav-mobile').click(function(){
			$('.navbar .navbar-inner > .nav').toggle();
		});
	
		// Dynamic binding to on 'click'
		$('.nav').on('click', '.nav-click', function(){
		
			// Toggle the nested nav
			$(this).siblings('.nav').toggle();
			
			// Toggle the arrow using CSS3 transforms
			$(this).children('.nav-arrow').toggleClass('nav-rotate');
			
		});
	    
	});
	
})(jQuery);