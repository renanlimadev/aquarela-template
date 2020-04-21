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
