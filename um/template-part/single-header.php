<?php
/**
 * @package um
 */
?>
<header class="entry-header">
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-meta">
		<?php um_posted_on(); ?>
	</div><!-- .entry-meta -->

	<?php if ( has_post_thumbnail() ) {?>
	<div class="feature-image"><?php the_post_thumbnail(); ?></div>
	<?php } ?>
	
</header><!-- .entry-header -->
