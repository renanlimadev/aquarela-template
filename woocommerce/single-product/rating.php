<?php
/**
 * 
 * Raiting
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

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if($rating_count > 0):?>

	<div class="woocommerce-product-rating">
		<?php echo wc_get_rating_html($average, $rating_count); // WPCS: XSS ok.?>
		<?php if(comments_open()):?>
			<?php //phpcs:disable ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf(_n('%s customer review', '%s customer reviews', $review_count, 'woocommerce'), '<span class="count">'. esc_html($review_count). '</span>');?>)</a>
		<?php endif;?>
	</div>

<?php endif;
