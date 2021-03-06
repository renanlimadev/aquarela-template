<?php
/**
 * 
 * Resumo de descrição
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $post;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if(! $short_description):
	return;
endif;

?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok.?>
</div>
