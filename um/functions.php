<?php
/**
 * um functions and definitions
 *
 * @package um
 */

DEFINE('UMCORE_DIR', get_template_directory() );
DEFINE('UMCORE_URL', get_template_directory_uri() );

$cssrd_php = UMCORE_DIR."/css/um-reset.php";
$cssrd_dis = UMCORE_DIR."/css/um-reset.---";

function um_check_umplug() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(!is_plugin_active( 'um-plug/um-plug.php' )) {
		add_action('admin_notices','um_adminnotes');
		add_action('wp_head','um_suggest_umplug');
	}

	include_once UMCORE_DIR."/inc/um/um-compat.php"; 
}

function um_adminnotes() {
	echo '<div id="message" class="error">';
	echo "<p>The UM-themes requires <a href='". admin_url()."plugin-install.php?tab=search&s=um-plug&plugin-search-input=Search+Plugins'>UM-Plug</a> plugins.</p>";
	echo '</div>';
}

function um_suggest_umplug() { echo "\n\n<!-- UM-PLUG Not Activated -->\n\n"; }

um_check_umplug();

// for um-reset.php

if (um_getoption('cssrd')) {
	if (!file_exists($cssrd_php)) { rename($cssrd_dis, $cssrd_php); }
} else {
	if (!file_exists($cssrd_dis)) { rename($cssrd_php, $cssrd_dis); }
}


if(! isset($content_width)){
	$content_width = 640; /* pixels */
}

function um_iehtml5() {
	$output = '<!--[if lte IE 9]><link rel="stylesheet" href="' . UMCORE_URL . '/css/ie9.css" /><![endif]-->'."\n";
	$output .= '<!--[if lte IE 8]><script src="' . UMCORE_URL . '/js/html5shiv.js"></script><![endif]-->'."\n";
	echo $output;
}

function um_widgets_init(){
	register_sidebar(array(
		'name' => __('Sidebar', 'um'),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));
}
add_action('widgets_init', 'um_widgets_init');

require get_template_directory(). '/inc/um/theme-setup.php';
require get_template_directory(). '/inc/um/commenting.php';
require get_template_directory(). '/inc/um/template-tags.php';
require get_template_directory(). '/inc/um/extras.php';
require get_template_directory(). '/inc/um/jetpack.php';
require get_template_directory(). '/inc/um/options.php';
//require get_template_directory(). '/inc/um/custom-header.php';
require get_template_directory(). '/inc/um/customizer.php';
require get_template_directory().'/inc/um/customizer-scheme.php';


if (um_get_themeoption('ajaxwpl')) {
	require get_template_directory() . '/inc/um/ajax-wplogin.php';
}