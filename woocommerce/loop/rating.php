<?php
/**
 * 
 * Loop de avaliações
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;

if(! wc_review_ratings_enabled()):
	return;
endif;

echo wc_get_rating_html($product->get_average_rating());
