<?php
/**
 * 
 * Relação de produtos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if($related_products):
	$heading = apply_filters('woocommerce_product_related_products_heading', __('Produtos Relacionados', 'woocommerce'));

	if($heading):?>
		<h2 class="product-title"><?php echo esc_html($heading);?></h2>
	<?php endif;?>

	<section class="row">

		<?php
		
			foreach($related_products as $related_product):

				$post_object = get_post($related_product->get_id());

				setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part('content', 'product');


			endforeach;
		?>
	</section>
<?php endif;

wp_reset_postdata();
