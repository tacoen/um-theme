<?php
/**
 * The template for displaying Archive pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * @package um
 */

get_header(); ?>
<section id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<?php if(have_posts()): 
	get_template_part('template-part/page-header',get_post_format());
	while(have_posts()): the_post();
		get_template_part('content', get_post_format());
	endwhile;?>
	<?php um_paging_nav(); ?>
<?php else : ?>
	<?php get_template_part('content', 'none'); ?>
<?php endif; ?>

</main><!-- #main -->
</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
