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

<ul class="woocommerce-mini-cart cart_list product_list_widget dropdown-menu py-2 dropdown-menu-right form-login text-center" aria-labelledby="dropdownCartLink">
	<?php 
		foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item):
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)):
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
				?>
				<li class="woocommerce-mini-cart-item dropdown-item text-white border-none bg-transparent <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key));?>">
					<div class="d-inline">
						<div class="">
							<?php 
								if(empty($product_permalink)):

									aquarela_print_thumbnail('cart');
			
								else:?>
									<a href="<?php echo esc_url($product_permalink);?>">
										<?php aquarela_print_thumbnail('cart');?>
									</a>
								<?php endif;
							?>
						</div>
						<div class="">
								<p class="text-white">
									<?php 
										echo $product_name. '<br/>';
										echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity text-white">'. sprintf('%s &times; %s', $cart_item['quantity'], $product_price). '</span>', $cart_item, $cart_item_key). '<br/>';?>
									<a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key));?>" class="remove remove_from_cart_button" aria-label="<?php echo esc_attr__('Remove this item', 'woocommerce');?>" data-product_id="<?php echo esc_attr($product_id);?>" data-cart_item_key="<?php echo esc_attr($cart_item_key);?>" data-product_sku="<?php echo esc_attr($_product->get_sku());?>">Remover item</a>
								</p>
						</div>
					</div>
				</li>
			<?php endif;
		endforeach;
	?>
	<div class="">
		<ul class="nav">
			<li class="nav-item woocommerce-mini-cart__total total">
				<?php do_action('woocommerce_widget_shopping_cart_total');?>
			</li>
			<li class="nav-item woocommerce-mini-cart__buttons buttons">
				<?php do_action('woocommerce_widget_shopping_cart_buttons');?>
			</li>
		</ul>
	</div>
	<div class="dropdown-item">
		<div class="row text-center">
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<p class="woocommerce-mini-cart__total total">
					<?php do_action('woocommerce_widget_shopping_cart_total');?>
				</p>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<p class="woocommerce-mini-cart__buttons buttons">
					<?php do_action('woocommerce_widget_shopping_cart_buttons');?>
				</p>
			</div>
		</div>
	</div>	
</ul>
