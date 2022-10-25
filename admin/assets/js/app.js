// Loader
function preloaderFadeOutInit() {
    $('.loader').fadeOut('slow');
}
// Window load function
jQuery(window).on('load', function() {
    (function($) {
        preloaderFadeOutInit();
    })(jQuery);
});