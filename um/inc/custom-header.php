<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package um
 */

/* Setup the WordPress core custom header feature.
 *
 * @uses um_header_style()
 * @uses um_admin_header_style()
 * @uses um_admin_header_image()
 *
 * @package um
 */
 
function um_custom_header_setup() {

	if ( um_getoption('umchiw','umt') ) { $umchiW = um_getoption('umchiw','umt'); } else { $umchiW = "1000"; }
	if ( um_getoption('umchiw','umt') ) { $umchiH = um_getoption('umchih','umt'); } else { $umchiH = "250"; }

	add_theme_support( 'custom-header', apply_filters( 'um_custom_header_args', array(
		'default-image'          => '',
		'header-text'            => false,
		'default-text-color'     => '000000',
		'width'                  => $umchiW,
		'height'                 => $umchiH,
		'flex-height'            => false,
		'flex-width'             => true,		
		'wp-head-callback'       => 'um_header_style',
		'admin-head-callback'    => 'um_admin_header_style',
		'admin-preview-callback' => 'um_admin_header_image',
	) ) );
}

add_action( 'after_setup_theme', 'um_custom_header_setup' );

if ( ! function_exists( 'um_header_css' ) ) :

	function um_header_css() {

		if ( um_getoption('umchiw','umt') ) { $umchiW = um_getoption('umchiw','umt'); } else { $umchiW = "1000"; }
		if ( um_getoption('umchiw','umt') ) { $umchiH = um_getoption('umchih','umt'); } else { $umchiH = "250"; }
	
		if ( get_header_image() ) {
			$style = '<style type="text/css">';
			$style .= ".um-headimg { min-height: ".$umchiH."px; background: url('".get_header_image()."') top center no-repeat !important }";
			$style .= '</style>';

		} else {
			$style ="<!--headimg: NA-->";
		}
		return $style;
	}

endif;
	
if ( ! function_exists( 'um_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see um_custom_header_setup().
 */

	function um_header_style() {
		echo um_header_css();
	}

endif;

if ( ! function_exists( 'um_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see um_custom_header_setup().
 */
	function um_admin_header_style() {
		echo um_header_css();
	}
	
endif; // um_admin_header_style

if ( ! function_exists( 'um_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see um_custom_header_setup().
 */
function um_admin_header_image() {

}
endif; // um_admin_header_image

add_action('wp_head','um_header_style');
