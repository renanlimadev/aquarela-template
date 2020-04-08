<?php
/**
 * 
 * Review Rating
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if(! defined('ABSPATH')):
	exit;
endif;

GLOBAL $comment;

$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));

if($rating && wc_review_ratings_enabled()):
	echo wc_get_rating_html( $rating ); // WPCS: XSS ok.
endif;
