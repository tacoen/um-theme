<header class="page-header">
<h1 class="page-title"><?php

if(is_category()):
	single_cat_title();

elseif(is_tag()):
	single_tag_title();

elseif(is_author()):
	printf(__('Author: %s', 'um'), '<span class="vcard">' . get_the_author(). '</span>');

elseif(is_day()):
	printf(__('Day: %s', 'um'), '<span>' . get_the_date(). '</span>');

elseif(is_month()):
	printf(__('Month: %s', 'um'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'um')). '</span>');

elseif(is_year()):
	printf(__('Year: %s', 'um'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'um')). '</span>');

elseif(is_tax('post_format', 'post-format-aside')):
	_e('Asides', 'um');

elseif(is_tax('post_format', 'post-format-gallery')):
	_e('Galleries', 'um');

elseif(is_tax('post_format', 'post-format-image')):
	_e('Images', 'um');

elseif(is_tax('post_format', 'post-format-video')):
	_e('Videos', 'um');

elseif(is_tax('post_format', 'post-format-quote')):
	_e('Quotes', 'um');

elseif(is_tax('post_format', 'post-format-link')):
	_e('Links', 'um');

elseif(is_tax('post_format', 'post-format-status')):
	_e('Statuses', 'um');

elseif(is_tax('post_format', 'post-format-audio')):
	_e('Audios', 'um');

elseif(is_tax('post_format', 'post-format-chat')):
	_e('Chats', 'um');

else :
	_e('Archives', 'um');

endif;
?>
</h1>
<?php
// Show an optional term description.
$term_description = term_description();
if(! empty($term_description)):
	printf('<div class="taxonomy-description">%s</div>', $term_description);
endif;
?></header><!-- .page-header -->
