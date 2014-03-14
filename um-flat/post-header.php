<?php
/**
 * @package undressme
 */
?>
<header class="entry-header">
	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" class="hot" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta">
	<?php um_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>

</header><!-- .entry-header -->
