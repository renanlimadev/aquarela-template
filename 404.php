<?php 
/**
 * 
 * Modelo personalizado para tratamento de erros
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
$last_url           = $_SERVER["REQUEST_URI"];

$first_replace      = str_replace( '/', ' ', $last_url );

$prepared_query     = str_replace( '-', ' ', $first_replace );

$pursuit_url        = new WP_Query( $prepared_query );

$total_found_posts  = $pursuit_url->found_posts;

get_header();?>
<main class="container-fluid py-5" role="main">
    <h1 class="text-muted text-center title-lost">Ops... Este endereço não existe mais, ou está temporariamente indisponível.</h1>
    <?php 
        if($pursuit_url->have_posts()):

            echo '<h2 class="warning-found text-muted text-center pt-3 pb-4 font-weight-bold">Encontramos alguns produtos que você pode gostar</h2>';

            echo '<div class="row">';

            while($pursuit_url->have_posts()):
                $pursuit_url->the_post();
                // Content
            endwhile;

            echo '</div>';
        else:

            echo '<h2 class="warning-found text-muted text-center pt-3 pb-5 font-weight-bold">Desculpe, mas não encontramos nada semelhante ao seu link.</h2>';
            
        endif;
    ?>
</main>
<?php get_footer();
