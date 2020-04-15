<?php
/**
 * 
 * Modelo para tratamento de downloads
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

$downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $downloads;

do_action('woocommerce_before_account_downloads', $has_downloads);?>

<?php 
	if($has_downloads):

		do_action('woocommerce_before_available_downloads');

		do_action('woocommerce_available_downloads', $downloads);

		do_action('woocommerce_after_available_downloads');

	else:?>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')));?>">
			Procurar produtos
		</a>
		Ainda não há downloads disponíveis
	</div>
<?php endif;

do_action('woocommerce_after_account_downloads', $has_downloads);
