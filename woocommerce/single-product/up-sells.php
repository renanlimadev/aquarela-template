<?php
/**
 * 
 * UP-Sells
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if($upsells):?>

	<section class="up-sells upsells products">

		<h2><?php esc_html_e( 'Você pode gostar&hellip;', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach($upsells as $upsell):?>

				<?php
					$post_object = get_post($upsell->get_id());

					setup_postdata($GLOBALS['post'] =& $post_object);

					wc_get_template_part('content', 'product');
				?>

			<?php endforeach;?>

		<?php woocommerce_product_loop_end();?>

	</section>
<?php endif;

wp_reset_postdata();
