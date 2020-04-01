<?php 
/**
 * 
 * Navegação principal do template
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<nav class="navbar navbar-expand-md navbar-dark bg-aqua py-0" role="navigation">
    <?php 
        wp_nav_menu(
              array(
                'theme_location' => 'top',
                'container'      => false,
                 'menu_class'     => 'navbar-nav mr-auto ml-auto',
                'menu_id'        => 'top-navbar',
                'fallback_cb'    => false
            )
        );
    ?>
</nav>
