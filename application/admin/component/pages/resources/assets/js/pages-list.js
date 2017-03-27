/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

window.addEvent('domready', function(){
	$$('#panel-pages').setStyle('display', 'none');
		
	var cookie = new Hash.Cookie('pages');
	
	if(cookie.get('show')) {
		$$('#panel-pages').setStyle('display', '');
	}
	
	var toggle = function(){
	    if(cookie.get('show')) {
	    	$$('#panel-pages').setStyle('display', 'none');
	    	cookie.set('show', false);
	    } else {
	    	$$('#panel-pages').setStyle('display', '');
	    	cookie.set('show', true);
	    }
	};
	
	window.addEvent('keypress', function(event){
	    if(event.key !== 'b') return;

	    toggle();
	});
});