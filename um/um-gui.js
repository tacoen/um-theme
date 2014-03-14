/* 

um-gui.js require jquery

let's make wordpress theme with better ui experiences

*/
(function($) {
var NO_UMGUI_INIT = 0;


$(document).ready(function(){

/* Make feature image fit */
$('.single .feature-image img').each( function(e) {
	var iw = $(this).attr('width'); var ih = $(this).attr('height');
	var w = $(this).width(); $(this).height(h = (ih/iw)*w);
});

});

$(window).on('resize', function(){

});

})(jQuery);