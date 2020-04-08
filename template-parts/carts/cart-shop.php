<?php 
/**
 * 
 * Mostra o carro de compras nas páginas
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

wp_nav_menu(
    array(
        'theme_location' => 'cart',
        'container'      => false,
        'menu_class'     => 'dropdown-menu px-2 py-2 dropdown-menu-right form-login text-center',
        'menu_id'        => 'dropdownCartLink',
        'fallback_cb'    => false
    )
);
?>
