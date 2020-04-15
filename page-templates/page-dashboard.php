<?php 
/**
 * 
 * Template Name: Dash para clientes
 * 
 * Modelo customizado para dashboard para clientes
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid py-4" role="main">
    <?php the_title('<h1 class="main-title text-center pt-3">', '</h1>');?>
    <?php get_template_part('woocommerce/myaccount/dashboard', 'aqua');?>
</main>
<?php get_footer();
