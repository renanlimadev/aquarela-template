<?php
/**
 * 
 * Categorias para conteiner principal
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<li <?php wc_product_cat_class('', $category);?>>
	<?php
		do_action('woocommerce_before_subcategory', $category);

		do_action('woocommerce_before_subcategory_title', $category);

		do_action('woocommerce_shop_loop_subcategory_title', $category);

		do_action('woocommerce_after_subcategory_title', $category);

		do_action('woocommerce_after_subcategory', $category);
	?>
</li>
