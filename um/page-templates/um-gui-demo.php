<?php
/**
 * Template Name: um-gui Javascript Demo-Page
 *
 */

get_header(); ?>
	
	<div id="primary" class="content-area">
	<div id="main" class="site-main" role="main">

	<div class="entry-content maketoc">
	
	<h1>Demo Only</h1>
    <p>Delete this page template when you done.</p>

	<h2>um_toc($element,element)</h2>
	<p style="margin-left: 4.5em; text-indent: -4.5em;">Example: <code>um_toc( $('div.maketoc'), 'h2' )</code><br/> 
	Make TOC from <code>h2</code> Element inside <code>div.maketoc</code>. View Source code for details</p>
	
	<h2>um_fit_img ( $element );</h2>
	<p style="margin-left: 4.5em; text-indent: -4.5em;">Example: <code>um_fit_img ( $('.feature-image img') )</code><br/>
	Set each <code>.feature-image img</code> aspect ratio using height/width </p>

	<h2>um_content_height( $element, min-height )</h2>
	<p style="margin-left: 4.5em; text-indent: -4.5em;">Example: <code>um_content_height( $('#content'), 280 )</code><br/> 
	Set  <code>#content </code> minimal height equal to window height - (site-header + site-footer) or at least 280px. So site-footer will be at bottom.
	Sorry for not using proper English</p>

	<h2>um_onscroll_fixed( $element1 , $element2 , pixel )</h2>
	<p style="margin-left: 4.5em; text-indent: -4.5em;">Example: <code>um_onscroll_fixed($('#um-top'),$('.main-navigation'),0)</code><br/>	
	<code>#um-top</code> will stop scrolling and dock to <code>.main-navigation</code> bottom, with 0 px height-adjustment</p>
		
	<h2>um_tab( $element );</h2>
	<p style="margin-left: 4.5em; text-indent: -4.5em;">Example: <code>um_tab( $('div.maketab') );</code><br/>
	View Source for details</p>
	
	</div>
	



	</div>
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>