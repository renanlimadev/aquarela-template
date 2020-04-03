<?php 
/**
 * 
 * Arquivo para tratamento de produtos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid mt-4 woocommerce-main" role="main">
    <?php 
        if(have_posts()):
            woocommerce_content();
        endif;
    ?>
</main>
<?php get_footer();
