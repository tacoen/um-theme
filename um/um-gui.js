(function($) {

$(document).ready(function(){

	um_onscroll_fixed($('#um-top'),$('.main-navigation'),0,$('.site-header').outerHeight());
	um_onscroll_fixed($('aside#meta'),$('#um-top'),48,$('.site-side').outerHeight());
	um_content_height($('#content'),280);
	um_tab($('div.maketab'));
	um_toc($('div.maketoc'),'h4',"Table of Contents")
	um_fx_init();
	
});

$(window).on('resize', function(){

	um_content_height($('#content'),280)

});

})(jQuery);