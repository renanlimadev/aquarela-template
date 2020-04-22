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

function setup_integration_with_vetor(){

    GLOBAL $product, $woocommerce;

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

    $vetor_products  = json_decode($product_json, true);  

    foreach($vetor_products['Produtos'] as $the_product):
        foreach($the_product as $total_products => $value):

            if($total_products == 'cod_produto'):
                $product_id = $value;
            endif;

            if(get_the_ID() == $product_id):
            
                    /**
                     * 
                     * Cria a matriz
                     * 
                     */
                    $update_products = array(
                        'ID'                 => false,
                        'post_author'        => get_current_user_id(),
                        'post_content'       => false,
                        'post_title'         => false,
                        'post_excerpt'       => false,
                        'post_status'        => 'publish',
                        'post_type'          => 'product',
                        'post_name'          => false,
                        'price'              => false,
                        'sale_price'         => false,
                        'description'        => false,
                        'short_description'  => false,
                        'catalog_visibility' => 'visible',
                        'sku'                => false,
                        'status'             => 'publish',
                        'stcok_status'       => 'instock',
                        'stock_quantity'     => false,
                        'weight'             => false,
                        'length'             => false,
                        'width'              => false,
                        'heigth'             => false,
                        'name'               => false,
                        'slug'               => false
                    );

                    /**
                     *
                     * Alimenta a matriz
                     *
                     */
                    if($total_products == 'cod_produto'){
                        $update_products['ID'] = $value;
                    }

                    if($total_products == 'dsc_produto_web'){
                        $update_products['post_content']      = $value;
                        $update_products['post_excerpt']      = $value;
                        $update_products['description']       = $value;
                        $update_products['short_description'] = $value;
                    }

                    if($total_products == 'nome_produto'){
                        $update_products['post_title'] = $value;
                        $update_products['name']       = $value;
                        $update_products['post_name']  = strtolower(str_replace(' ', '-', $value));
                        $update_products['slug']       = strtolower(str_replace(' ', '-', $value));
                    }

                    if($total_products == 'vl_venda_vista'){
                        $update_products['price']      = strval($value);
                        $update_products['sale_price'] = strval($value);
                    }

                    if($total_products == 'dsc_referencia'){
                        $update_products['sku'] = strval($value);
                    }

                    if($total_products == 'peso_bruto'){
                        $update_products['weight'] = strval($value);
                    }

                    if($total_products == 'comprimento'){
                        $update_products['length'] = strval($value);
                    }

                    if($total_products == 'largura'){
                        $update_products['width'] = strval($value);
                    }

                    if($total_products == 'altura'){
                        $update_products['heigth'] = strval($value);
                    }

                    wp_update_post($update_products);
               
            elseif(!(get_the_ID() == $product_id)):

                    /**
                     * 
                     * Cria a matriz
                     * 
                     */
                    $new_product = array(
                        'ID'                 => false,
                        'post_author'        => get_current_user_id(),
                        'post_content'       => false,
                        'post_title'         => false,
                        'post_excerpt'       => false,
                        'post_status'        => 'publish',
                        'post_type'          => 'product',
                        'post_name'          => false,
                        'price'              => false,
                        'sale_price'         => false,
                        'description'        => false,
                        'short_description'  => false,
                        'catalog_visibility' => 'visible',
                        'sku'                => false,
                        'status'             => 'publish',
                        'stcok_status'       => 'instock',
                        'stock_quantity'     => false,
                        'weight'             => false,
                        'length'             => false,
                        'width'              => false,
                        'heigth'             => false,
                        'name'               => false,
                        'slug'               => false
                    );

                    /**
                     *
                     * Alimenta a matriz
                     *
                     */
                    if($total_products == 'cod_produto'){
                        $new_product['ID'] = $value;
                    }

                    if($total_products == 'dsc_produto_web'){
                        $new_product['post_content']      = $value;
                        $new_product['post_excerpt']      = $value;
                        $new_product['description']       = $value;
                        $new_product['short_description'] = $value;
                    }

                    if($total_products == 'nome_produto'){
                        $new_product['post_title'] = $value;
                        $new_product['name']       = $value;
                        $new_product['post_name']  = strtolower(str_replace(' ', '-', $value));
                        $new_product['slug']       = strtolower(str_replace(' ', '-', $value));
                    }

                    if($total_products == 'vl_venda_vista'){
                        $new_product['price']      = strval($value);
                        $new_product['sale_price'] = strval($value);
                    }

                    if($total_products == 'dsc_referencia'){
                        $new_product['sku'] = strval($value);
                    }

                    if($total_products == 'peso_bruto'){
                        $new_product['weight'] = strval($value);
                    }

                    if($total_products == 'comprimento'){
                        $new_product['length'] = strval($value);
                    }

                    if($total_products == 'largura'){
                        $new_product['width'] = strval($value);
                    }

                    if($total_products == 'altura'){
                        $new_product['heigth'] = strval($value);
                    }

                    wp_insert_post($new_product);
            endif;
        endforeach;
    endforeach;
    }

add_action('init', 'setup_integration_with_vetor');
