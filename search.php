<?php 
/**
 * 
 * Modelo personalizado para página ide busca
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

$query_search = get_search_query();

$search_term = array('s' => $query_search);

$object_search = new WP_Query($search_term);

$number_results = $object_search->found_posts;

get_header();?>
<main class="container-fluid pt-2" role="main">
    <?php if($object_search->have_posts()):
        if($number_results == 1):?>
            <h2 class="results-title text-muted text-center py-4 mb-4">Econtramos 1 resultado para a sua pesquisa :)</h2>
        <?php else:?>
            <h2 class="results-title text-muted text-center py-4 mb-4">Encontramos <?php echo $number_results;?> para a sua pesquisa :)</h2>
        <?php endif;?>
    <ul class="row">
        <?php 
            while($object_search->have_posts()):
                $object_search->the_post();
                get_template_part('template-parts/contents/content', 'shop');
            endwhile;
        ?>
    </ul><?php else:?>
    <h2 class="results-title text-muted text-center py-5 my-5">Ops... Não econtramos nenhum resultado :'(</h2><?php endif;?>
</main>
<?php get_footer();
