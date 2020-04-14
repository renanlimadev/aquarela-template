<?php
/**
 * 
 * Add To Cart link
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;?>

<a href="<?php echo esc_url($product->add_to_cart_url());?>" class="button product-link prod-info font-weight-bold" data-quantity="<?php echo esc_attr(isset( $args['quantity'] ) ? $args['quantity'] : 1);?>" <?php echo isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '';?>>COMPRAR</a>
