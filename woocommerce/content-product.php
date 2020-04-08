<?php
/**
 * 
 * Modelo que mostra o conteúdo singular do post
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;

if(empty( $product ) || ! $product->is_visible()):
	return;
endif;?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php 
		do_action( 'woocommerce_before_shop_loop_item' );

		do_action( 'woocommerce_before_shop_loop_item_title' );

		do_action( 'woocommerce_shop_loop_item_title' );

		do_action( 'woocommerce_after_shop_loop_item_title' );

		do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
