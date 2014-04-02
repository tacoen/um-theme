(function($) {

$(document).ready(function(){

	um_onscroll_fixed($('#um-top'),$('.main-navigation'),0)
	um_content_height($('#content'),280)
	um_tab($('div.maketab'));
	um_toc($('div.maketoc'),'h2')

	$('.entry-content').css('width',sw);
	$('.entry-content img').each(function(i) {
		sw = $(window).innerWidth();
		iw = $(this).width();
		ih = $(this).height();
		if ( $(this).width() >= $(window).innerWidth()) {
			var dh = (ih/iw) * sw;
			console.log(ih,iw,sw,dh);
			$(this).attr('width', sw );
			$(this).attr('height',dh);
			$(this).css('width',sw+"px");
			$(this).css('height',dh+"px");
		}
	});
	
});

$(window).on('resize', function(){

	um_content_height($('#content'),280)

});

})(jQuery);