<?php
/**
 * 
 * Display de preço
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;

if($price_html = $product->get_price_html()):
	echo '<span class="price">'. $price_html. '</span>';
endif;
