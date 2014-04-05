(function($) {

$(document).ready(function(){

	um_onscroll_fixed($('#um-top'),$('.main-navigation'),0);
	um_content_height($('#content'),280);
	um_tab($('div.maketab'));
	um_toc($('div.maketoc'),'h2')

});

$(window).on('resize', function(){

	um_content_height($('#content'),280)

});

})(jQuery);