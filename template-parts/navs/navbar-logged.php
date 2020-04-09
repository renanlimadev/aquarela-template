<?php 
/**
 * 
 * Menu para usuários logados
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

wp_nav_menu(
    array(
        'theme_location' => 'user',
        'container'      => false,
        'menu_class'     => 'dropdown-menu px-2 py-2 dropdown-menu-right form-login text-center',
        'menu_id'        => 'dropdownMenuLink',
        'fallback_cb'    => false
    )
);
