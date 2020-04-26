<?php 
/**
 * 
 * Arquivo principal do template, por favor, não exclua
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

get_header();?>
<main class="container-fluid mt-5 woocommerce-main" role="main">
    <h1 class="main-title text-center font-weight-bold py-3">PRODUTOS EM DESTAQUE</h1>
    <ul class="row">
        <?php 
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 12
            );

            $custom_loop = new WP_Query($args);

            if($custom_loop->have_posts()):

                while($custom_loop->have_posts()):

                    $custom_loop->the_post();

                    get_template_part('template-parts/contents/content', 'shop');
                     
                endwhile;

            endif; wp_reset_query();
        ?>
    </ul><?php 
$vetor_header = array(
        'headers' => array(
            'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJBUUtELTU3NDkiLCJleHAiOjE5MDI4NTUxNjUsInJvbCI6WyJST0xFX1VTRVIiXX0.K3RKyAs9WZ-Brk4uuPtw1a_mKIVUkhyO-iEzjSMvEFcGQ1ybqHBbtmwvnqM6KWH_9MAnHJZBxcejsbLZCC3xgg',
            'Content-Type'  => 'application/json',
            'sslverify'     => false
        )
    );

    $vetor_response = wp_remote_get('https://wss.mitryus.com.br:8087/wsintegracao/api/ecommerce/integracao/pacotedados', $vetor_header);


        $result = json_decode(wp_remote_retrieve_body($vetor_response), true);
   
        $produtos = $result['Produtos']; var_dump($produtos);
    ?>
</main>
<?php get_footer();
