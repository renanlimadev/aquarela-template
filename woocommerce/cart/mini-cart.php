<?php
/**
 * 
 * Mini Cart para cabeçalho
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;?>

<ul class="woocommerce-mini-cart cart_list product_list_widget dropdown-menu py-2 dropdown-menu-right form-login" aria-labelledby="dropdownCartLink">
	<?php 
		foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item):
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)):
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);?>
				<li class="woocommerce-mini-cart-item dropdown-item text-white py-1 bg-transparent <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key));?>">
					<div class="">
						<p class="text-cart py-0 border-bottom border-light">
							<?php 
								if(empty($product_permalink)):
									echo $product_name;
								else:
									echo '<a href="'. esc_url($product_permalink). '" class="link-text">'. $product_name. '</a>';

								endif;?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key));?>" class="remove remove_from_cart_button link-icon" aria-label="<?php echo esc_attr__('Remove this item', 'woocommerce');?>" data-product_id="<?php echo esc_attr($product_id);?>" data-cart_item_key="<?php echo esc_attr($cart_item_key);?>" data-product_sku="<?php echo esc_attr($_product->get_sku());?>"><i class="fas fa-trash-alt"></i></a><br/>
							<?php 
								echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity text-white">'. sprintf('%s &times; %s', $cart_item['quantity'], $product_price). '</span>', $cart_item, $cart_item_key);
							?>
						</p>
					</div>
				</li>
			<?php endif;?>
		<?php endforeach;?>
	<p class="woocommerce-mini-cart__total total text-white text-center">
		<?php do_action('woocommerce_widget_shopping_cart_total');?><br/>
		<a class="woocommerce-mini-cart__buttons buttons link-text" href="<?php echo esc_url(home_url('/carrinho-de-compras'));?>" target="_blank">Visualizar carrinho</a>
	</p>	
</ul>
