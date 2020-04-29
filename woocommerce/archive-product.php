<?php
/**
 * 
 * Arquivamento de produtos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

get_header('shop');?>
<main class="container-fluid pt-5" role="main">
	<h1 class="woocommerce-products-header__title page-title main-title text-center font-weight-bold py-3">
		<?php woocommerce_page_title();?>
	</h1>
<?php
if(woocommerce_product_loop()):?>
	<ul class="row">
		<?php 
			if(wc_get_loop_prop('total')):
				while(have_posts()):
					the_post();
					do_action('woocommerce_shop_loop');
					wc_get_template_part('content', 'product');
				endwhile;
			endif;
		?>
	</ul>
<?php else:?>

	<h1 class="main-title text-center font-weight-bold pb-5 mb-2">Sem resultados</h1>
<?php endif;?>
</main>

<?php get_footer('shop');
