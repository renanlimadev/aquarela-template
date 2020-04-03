<?php 
/**
 * 
 * Arquivo principal para personalização de funcionalidades para WooCommerce
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

/**
 * 
 * Suporte para o plugin WooCommerce
 * 
 */
function aqua_support_woocommerce(){
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'aqua_support_woocommerce');

/**
 * 
 * Ativa o zoom padrão do woocommerce
 */
add_theme_support( 'wc-product-gallery-zoom' );

/**
 * 
 * Ativa o lightbox padrão do woocommerce
 * 
 */
add_theme_support( 'wc-product-gallery-lightbox' );

/**
 * 
 * Ativa o slider padrão do woocommer
 * 
 */
add_theme_support( 'wc-product-gallery-slider' );

/**
 * 
 * Removendo o Loop principal do WooCommerce
 * 
 */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
