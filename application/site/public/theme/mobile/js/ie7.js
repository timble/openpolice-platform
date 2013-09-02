/*
 Specific JS for IE7 and lower
 */
;(function($) {
    // DOM ready
    $(function() {
        // By removing the ID attribute Select2 will not be fired
        $('#autocomplete__streets').removeAttr('id');
        $('#autocomplete__streets--footer').removeAttr('id');
    });
})(jQuery);