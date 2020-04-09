<?php
/**
 * 
 * Exibe o carrinho vazio
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

do_action('woocommerce_cart_is_empty');

if(wc_get_page_id('shop') > 0 ):?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')));?>">
			<?php esc_html_e('Retorne para a loja', 'woocommerce');?>
		</a>
	</p>
<?php endif;
