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
<nav class="navbar navbar-expand-md navbar-dark bg-aqua bg-light py-0 text-center" role="navigation">
    <button class="navbar-toggler my-1" type="button" data-toggle="collapse" data-target="#navbarToCollapse" aria-controls="navbarToCollapse" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-uppercase" id="navbarToCollapse">
        <?php 
            wp_nav_menu(
                array(
                    'theme_location' => 'top',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav align-items-center navbar-top mr-auto ml-auto',
                    'menu_id'        => 'top-navbar',
                    'fallback_cb'    => false
                )
            );
        ?>
    </div>
</nav>
