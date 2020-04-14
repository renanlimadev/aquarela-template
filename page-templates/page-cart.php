<?php 
/**
 * 
 * Template Name: Carrinho de compras
 * 
 * Modelo customizado para registro de clientes
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid py-4" role="main">
    <?php the_title('<h1 class="main-title text-center pt-3">', '</h1>');?>
    <?php get_template_part('woocommerce/cart/cart', 'aqua');?>
</main>
<?php get_footer();
