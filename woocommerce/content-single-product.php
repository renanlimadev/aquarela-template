<?php
/**
 * 
 * Modelo de container para post de produto de forma singular
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;?>

<div class="pt-4">
<?php 
	if(post_password_required()):
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	endif;
?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

		<?php do_action('woocommerce_before_single_product_summary');?>

		<div class="summary entry-summary">
			<?php do_action('woocommerce_single_product_summary');?>
		</div>

		<?php do_action('woocommerce_after_single_product_summary');?>
	</div>
</div>
