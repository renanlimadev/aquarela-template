<?php 
/**
 * 
 * Menu para usuários logados
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    <?php 
        wp_nav_menu(
            array(
                'theme_location' => 'user',
                'container'      => false,
                'menu_class'     => 'nav form-login',
                'menu_id'        => 'menu-user',
                'fallback_cb'    => false
            )
        );
    ?>
</div>
