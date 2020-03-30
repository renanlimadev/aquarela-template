<?php 
/**
 * 
 * Modelo personalizado para página inicial
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid" role="main">
    <?php 
        woocommerce_content();
    ?>
</main>
<?php get_footer();
