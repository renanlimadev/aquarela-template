<?php 
/**
 * 
 * Arquivamento de tratamento da requisição da api do ERP Vetor
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product, $post, $woocommerce;

function setup_integration_with_vetor(){
/**
 * 
 * Retorna os dados da api para um objeto json
 * 
 */
$vetor_token    = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJBUUtELTU3NDkiLCJleHAiOjE5MDI4NTUxNjUsInJvbCI6WyJST0xFX1VTRVIiXX0.K3RKyAs9WZ-Brk4uuPtw1a_mKIVUkhyO-iEzjSMvEFcGQ1ybqHBbtmwvnqM6KWH_9MAnHJZBxcejsbLZCC3xgg';
$vetor_url      = 'https://wss.mitryus.com.br:8087/wsintegracao/api/ecommerce/integracao/pacotedados';

$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $vetor_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '. $vetor_token,
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$product_json = curl_exec($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

$vetor_products = json_decode($product_json);

/**
 * 
 * Inicia a manipulação dos dados
 * 
 */
if(isset($post->ID, $vetor_products->Produtos->cod_produto)):

    /**
     * 
     * Função para popular os produtos
     * 
     */
    function update_products_from_vetor($update_products = $vetor_products->Produtos){

        foreach($update_products as $new_meta):

            /**
             * 
             * Popula as variáveis
             * 
             */
            $update_products = array(
                'ID'                 => $new_meta->cod_produto,
                'post_author'        => get_current_user_id(),
                'post_content'       => $new_meta->dsc_produto_web,
                'post_title'         => $new_meta->nome_produto,
                'post_excerpt'       => $new_meta->dsc_produto_web,
                'post_status'        => 'publish',
                'post_type'          => 'product',
                'post_name'          => strtolower(str_replace(' ', '-', $new_meta->nome_produto)),
                'price'              => $new_meta->vl_venda_vista,
                'sale_price'         => $new_meta->vl_venda_vista,
                'description'        => $new_meta->dsc_produto_web,
                'short_description'  => $new_meta->dsc_produto_web,
                'catalog_visibility' => 'visible',
                'sku'                => $new_meta->dsc_referencia,
                'status'             => 'publish',
                'stcok_status'       => 'instock',
                'weight'             => $new_meta->peso_bruto,
                'length'             => $new_meta->comprimento,
                'width'              => $new_meta->largura,
                'heigth'             => $new_meta->altura,
                'name'               => $new_meta->nome_produto,
                'slug'               => strtolower(str_replace(' ', '-', $new_meta->nome_produto))
            );

            wp_update_post($update_products);

        endforeach;
    }

    /**
     * 
     * Inicia o gancho
     * 
     */
    add_action('save_post_product', 'update_products_from_vetor');
   
elseif(!isset($post->ID, $vetor_products->Produtos->cod_produto)):

    /**
     * 
     * Inicia os novos produtos
     * 
     */
    function new_products_from_vetor($new_products = $vetor_products->Produtos){

        foreach($new_products as $new_meta):

            /**
             * 
             * Popula as variáveis
             * 
             */
            $add_products = array(
                'ID'                 => $new_meta->cod_produto,
                'post_author'        => get_current_user_id(),
                'post_content'       => $new_meta->dsc_produto_web,
                'post_title'         => $new_meta->nome_produto,
                'post_excerpt'       => $new_meta->dsc_produto_web,
                'post_status'        => 'publish',
                'post_type'          => 'product',
                'post_name'          => strtolower(str_replace(' ', '-', $new_meta->nome_produto)),
                'price'              => $new_meta->vl_venda_vista,
                'sale_price'         => $new_meta->vl_venda_vista,
                'description'        => $new_meta->dsc_produto_web,
                'short_description'  => $new_meta->dsc_produto_web,
                'catalog_visibility' => 'visible',
                'sku'                => $new_meta->dsc_referencia,
                'status'             => 'publish',
                'stcok_status'       => 'instock',
                'weight'             => $new_meta->peso_bruto,
                'length'             => $new_meta->comprimento,
                'width'              => $new_meta->largura,
                'heigth'             => $new_meta->altura,
                'name'               => $new_meta->nome_produto,
                'slug'               => strtolower(str_replace(' ', '-', $new_meta->nome_produto))
            );

            wp_insert_post($add_products);

        endforeach;

    }

    /**
     * 
     * Inicia o gancho
     * 
     */
    add_action('save_post_product', 'new_products_from_vetor');

endif;
}
add_action('init', 'setup_integration_with_vetor');