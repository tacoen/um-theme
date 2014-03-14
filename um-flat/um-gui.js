/* 

um-gui.js require jquery

let's make wordpress theme with better ui experiences

*/
(function($) {


var NO_UMGUI_INIT = 0;

function um_keepdistance(align) {
	var h = $(window).innerHeight()-$('#colophon').outerHeight()-$('#masthead').outerHeight()-32;
	if (h < 0 ) { h = 256 }
	$('#content').css('min-height',h+'px');

	var $panel = $("div.um-off-canvas-"+align);
	
	$panel.height ( $(window).innerHeight() );

}

function um_offcanvas_fx(align) {

	var $panel = $("div.um-off-canvas-"+align);

	$panel.css({
		'border-right-width': '5px','border-right-style': 'solid',
		'border-right-color': um_getmodcolor( $panel,'background-color',+32),
		'background-color': um_getrgbof( $panel,'background-color', .95)
	})

	var $wpadminbar = $('#wpadminbar');

	if((typeof $wpadminbar != 'undefined') && (typeof $panel != 'undefined')) { 
		$panel.css('top',$wpadminbar.outerHeight() ); 
	}

	if ( typeof $panel != 'undefined') { 
		$panel.css('min-height', $(window).innerHeight() );
	}	
	
	$panel.click( function(e) {
		var p = $panel.data('pined');
		if (p == 1) { $panel.data('pined',0); $panel.removeClass('pined-'+align); } 
		       else { $panel.data('pined',1); $panel.addClass('pined-'+align); }
	})

	cwidth = $('.site-content').outerWidth();
	swidth = $('.site').outerWidth();
	
	$panel.hover( function(e) {
		var p = $panel.data('pined');
		if ((!p)||(p==0)) {
			$('.site-content,.site-header #um-top,.site-footer #um-bottom,.main-navigation > div').toggleClass('canvas-adjust-left');
		} else { 
			$('.site-content,.site-header #um-top,.site-footer #um-bottom,.main-navigation > div').addClass('canvas-adjust-left');
		}
	});

}

function um_theme_init(align) {

	if((typeof NO_UMGUI_INIT != 'undefined') && (NO_UMGUI_INIT > 0)) { 
		console.log("UM GUI Disabled via NO_UMGUI_INIT=",NO_UMGUI_INIT)
		return; 
	}

	if (typeof $wpadminbar != 'undefined') { 
		$('nav.main-navigation').css('top',32 ); 
	}

	
	if ( typeof align != 'undefined') { var align="left"; }
		
	um_overlay_badge_fx();
	um_offcanvas_fx('left');
	
	// Always fit #content => window - #colophon - #masthead - wpadminbar

	$('.site-footer').css({
		'border-top-width': '5px','border-top-style': 'solid',
		'border-top-color': um_getmodcolor ( $('.site-footer'), "background-color",+32),
	});
	
}

/* ------------------------------------------- INIT ---------------------------- */

$(document).ready(function(){

	um_theme_init('left');

});

$(window).on('resize', function(){

	um_keepdistance('left') 

});

})(jQuery);