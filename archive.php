<?php 
/**
 * 
 * Arquivamento de categorias e taxonomias personalizadas
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid pt-2" role="main">
    <?php 
        if(have_posts()):
            while(have_posts()):
                the_post();
                the_content();
            endwhile;
        endif;
    ?>
</main>
<?php get_footer();
