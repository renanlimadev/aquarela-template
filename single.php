<?php 
/**
 * 
 * Modelo padrão para tratamento de posts 
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
get_header();?>
<main class="container-fluid" role="main">
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
