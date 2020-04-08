<?php
/**
 * 
 * Modelo que trata produtos únicos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

get_header('shop');?>
<main class="container-fluid pt-2">
	<?php 
		while(have_posts()):
			the_post();
			wc_get_template_part( 'content', 'single-product' );
		endwhile;
	?>
</main>
<?php get_footer('shop');
