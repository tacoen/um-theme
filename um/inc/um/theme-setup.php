<?php
if(! function_exists('um_editor_styles')) {

	add_action( 'init', 'um_editor_styles' );
	
	function um_editor_styles() {
		add_editor_style( get_stylesheet_uri()."/css/editor.style.css" );
	}

}

function um_core_ver() { return "0.0.3"; }

function um_css_reset() {
		wp_enqueue_style('um-reset',UMCORE_URL. '/css/build/necolas-normalize.css' ,false,time(),'all'); 
		wp_enqueue_style('um-reset-font',UMCORE_URL. '/css/font/styles.css' ,array('um-reset'),time(),'all'); 
		wp_enqueue_style('um-reset-ui',UMCORE_URL. '/css/build/um-reset-ui.css' ,array('um-reset'),time(),'all'); 
		wp_enqueue_style('um-reset-wp',UMCORE_URL. '/css/build/wp-reset.css' ,array('um-reset'),time(),'all'); 
		// Still pre-production: um-reset.css
		wp_enqueue_style('um-reset-docs',UMCORE_URL. '/css/um-reset.php' ,array('um-reset'),time(),'all'); 
}

function um_theme_register_styles() {

	$dep = array();
	$css_static = array();
	
	if ((file_exists(get_stylesheet_directory()."/static.css")) && (um_getoption('cssstatic'))) {
		if (um_getoption('cssrd')) {
			$dep = array('um-reset');
			if (file_exists(UMCORE_DIR."/css/um-reset.php")) { 
				um_css_reset();
			}
		}
		
		wp_register_style(get_template().'-style',get_stylesheet_directory_uri()."/static.css",$dep,um_core_ver(),'all');
		wp_enqueue_style(get_template().'-style');

	} else {

		if (um_get_themeoption('umcss')) {
			$dep = array('um-reset');
			if (um_getoption('cssrd')) {
				if (file_exists(UMCORE_DIR."/css/um-reset.php")) { 
					um_css_reset();
				}
			} else {
				array_push($css_static,UMCORE_URL. '/css/um-reset.css');
				wp_enqueue_style('um-reset',UMCORE_URL. '/css/um-reset.css' ,false,um_core_ver(),'all');
			}
		} else {
			$dep = false;
		}	
		
		if (um_get_themeoption('umgui')) {
			array_push($css_static,UMCORE_URL. '/css/um-gui-lib.css');
			wp_enqueue_style('um-gui', UMCORE_URL . '/css/um-gui-lib.css',$dep,um_core_ver(),'all');
		}
	
		if ( (!is_admin()) && (um_get_themeoption('schcss')) ) {
				array_push($css_static,um_tool_which('um-scheme.css'));
				wp_enqueue_style(get_template().'-scheme',um_tool_which('um-scheme.css'),$dep,um_core_ver(),'all');
		} 
		
		if (um_get_themeoption('navcss')) {
			array_push($css_static,um_tool_which('um-navui.css'));
			wp_enqueue_style(get_template().'-navi',um_tool_which('um-navui.css'),$dep,um_core_ver(),'all');
		}

		wp_register_style(get_template().'-style',get_stylesheet_uri(),$dep,um_core_ver(),'all');
		array_push($css_static,get_stylesheet_uri());
		wp_enqueue_style(get_template().'-style');

		$layout=um_get_themeoption('layout'); if ( ($layout !="none") && ($layout !="" ) ) {
			array_push($css_static,get_stylesheet_directory_uri()."/layouts/$layout");
			wp_enqueue_style(get_template().'-layout', get_stylesheet_directory_uri()."/layouts/$layout", array(get_template().'-style'),um_core_ver(),'all'); 
		}

	if ( function_exists('um_makestatic') ) { um_makestatic($css_static); }
	
	}

}

function um_theme_register_scripts() {

	$js_static_btm = array();
	$js_static_top = array();

	if ((file_exists(get_stylesheet_directory()."/static.js")) && (um_getoption('jsstatic'))) {

		wp_enqueue_script('um-gui-lib',get_stylesheet_directory_uri()."/static.js",false,um_core_ver(),true );

	} else {
	
		if (um_get_themeoption('umgui')) {
			array_push($js_static_top,UMCORE_URL . '/js/um-gui-lib.js');
			array_push($js_static_btm,um_tool_which('um-gui.js'));
			wp_enqueue_script('um-gui-lib',UMCORE_URL . '/js/um-gui-lib.js',array(),um_core_ver(),true);
			wp_enqueue_script('um-gui',um_tool_which('um-gui.js'),array('um-gui-lib'),um_core_ver(),true);
		}

		/* :D I forget this since begining, wow! */

		array_push($js_static_top,UMCORE_URL . '/js/navigation.js');
		array_push($js_static_top,UMCORE_URL . '/js/skip-link-focus-fix.js');
		wp_enqueue_script( 'um-navigation', UMCORE_URL . '/js/navigation.js', array(), um_core_ver(), true );
		wp_enqueue_script( 'um-skip-link-focus-fix', UMCORE_URL . '/js/skip-link-focus-fix.js', array(), um_core_ver(), true );
		$js_static = array_merge($js_static_top,$js_static_btm);
		if ( function_exists('um_makestaticJS') ) { um_makestaticJS($js_static); }	

	}
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (um_get_themeoption('skejs')) {
		wp_enqueue_script('um-skel-init',um_tool_which('skel-init.js'),array('jquery'),um_core_ver(),false);
		wp_enqueue_script('um-skel-lib',UMCORE_URL . '/js/skel.min.js',array('um-skel-init'),um_core_ver(),true);
	}
	
	if (um_get_themeoption('iehtml5')) {
		add_action('wp_head','um_iehtml5');
	}
	
}


if(! function_exists('um_setup')):

function um_setup(){

	/* from UM-PLUG */
	add_action('wp_enqueue_scripts','um_theme_register_scripts');
	add_action('wp_enqueue_scripts','um_theme_register_styles');

	load_theme_textdomain('um', get_template_directory(). '/lang');
	add_theme_support('automatic-feed-links');
	
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 128, 128, true );
	
	add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'chat', 'gallery'));
	
	add_theme_support('html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	));
	
	// This theme uses wp_nav_menu()in one location.
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'um'),
	));

	
	$defaults_cbgr = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', apply_filters('um_custom_background_args', $defaults_cbgr ));	
	
/*
	// Setup the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('um_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	)));
*/

}

endif; // um_setup

add_action('after_setup_theme', 'um_setup');


?>