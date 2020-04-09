<?php
/**
 * 
 * Thumnail para produtos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 */

if(! function_exists( 'wc_get_gallery_image_html')):
	return;
endif;

GLOBAL $product;

$attachment_ids = $product->get_gallery_image_ids();

if ($attachment_ids && $product->get_image_id()):
	foreach($attachment_ids as $attachment_id):
		echo apply_filters('woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html($attachment_id), $attachment_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	endforeach;
endif;
