<?php 
/**
 * 
 * Template Name: Formulário de Cadastramento
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
    <p class="text-muted text-center">
        Não compartilhamos os seus dados, para saber mais veja<a class="btn btn-link" href="<?php echo esc_url(home_url('/politica-de-privacidade'));?>" target="_blank">Nossa política de privacidade</a>
    </p>
    <?php get_template_part('woocommerce/myaccount/form', 'login');?>
</main>
<?php get_footer();
