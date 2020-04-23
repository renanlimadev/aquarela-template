<?php 
/**
 *
 * Integração com a API do Vetor ERP
 *
 * @package aquarela-template
 *
 * @since 1.0.0
 *
 */
function vetor_integration(){

    /**
     *
     * Retorna uma matriz json a parir da requisição da API do vetor ERP
     *
     */
    $vetor_header = array(
        'headers' => array(
            'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJBUUtELTU3NDkiLCJleHAiOjE5MDI4NTUxNjUsInJvbCI6WyJST0xFX1VTRVIiXX0.K3RKyAs9WZ-Brk4uuPtw1a_mKIVUkhyO-iEzjSMvEFcGQ1ybqHBbtmwvnqM6KWH_9MAnHJZBxcejsbLZCC3xgg',
            'Content-Type'  => 'application/json',
            'sslverify'     => false
        )
    );
    $vetor_response = wp_remote_get('https://wss.mitryus.com.br:8087/wsintegracao/api/ecommerce/integracao/pacotedados', $vetor_header);
    if( wp_remote_retrieve_response_message($vetor_response) == 'OK'){
        $result = json_decode(wp_remote_retrieve_body($vetor_response), true);
        
        $produtos = $result['Produtos'];
        $codigos  = $result['CodigosBarra'];

        foreach($produtos as $produto){

            // ID para manipulação
            $cod_produto = false;

            // Elementos utilizados
            $elementos_produto = array();

            foreach($produto as $key => $value){

                /**
                 *
                 * Condicional para elemntos contidos em $produto
                 *
                 */
                if($key == 'cod_produto'){
                    $cod_produto = $value;
                    $elementos_produto['ID'] = $value;
                }elseif($key == 'nome_produto'){
                    $elementos_produto['name'] = $value;
                }elseif($key == 'vl_venda_vista'){
                    $elementos_produto['price'] = strval($value);
                }elseif($key == 'dsc_produto_web'){
                    $elementos_produto['description'] = $value;
                }elseif($key == 'peso_bruto'){
                    $elementos_produto['weight'] = strval($value);
                }elseif($key == 'comprimento'){
                    $elementos_produto['length'] = strval($value);
                }elseif($key == 'largura'){
                    $elementos_produto['width'] = strval($value);
                }elseif($key == 'altura'){
                    $elementos_produto['height'] = strval($value);
                }elseif($key == 'dsc_referencia'){
                    $elementos_produto['sku'] = strval($value);
                }

                /**
                 *
                 * Elementos contidos em Codigos
                 *
                 */
                foreach($codigos as $codigo){
                    foreach($codigo as $ckey => $cvalue){
                        if($ckey == 'cod_produto'){
                            $compare = $value;
                        }
                        if($ckey == 'qnt_estoque_disponivel' && $compare == $cod_produto){
                            $elementos_produto['stock_quantity'] = $cvalue;
                        }
                    }
                }
            }

            $retorno_post = post_exists($cod_produto, '', '', 'product');

            $stock_status = ($elementos_produto['stock_quantity'] == 0)? 'outstock' : 'instock';

            if($retorno_post == 0){
                /**
                 *
                 * Atualiza os produtos via solicitação da API do WooCommerce
                 *
                 */
                $woocommerce_header = array(
                    'method'  => 'PUT',
                    'headers' => array(
                        'Authorization' => 'Basic '. base64_encode('ck_6cd66a0b48664e0ad18d497334de60dc30e1d140:cs_56dc27805b2a6440608960ab0da094fd06cff48a'),
                    ),
                    'body'    => array(
                        'name'               => $elementos_produto['name'],
                        'price'              => $elementos_produto['price'],
                        'regular_price'      => $elementos_produto['price'],
                        'stock_status'       => $stock_status,
                        'catalog_visibility' => 'visible',
                        'stock_quantity'     => $elementos_produto['stock_quantity'],
                        'description'        => $elementos_produto['description'],
                        'weight'             => $elementos_produto['weight'],
                        'length'             => $elementos_produto['length'],
                        'width'              => $elementos_produto['width'],
                        'height'             => $elementos_produto['height'],
                        'sku'                => $elementos_produto['sku']
                    )
                );

                $woocommerce_response = wp_remote_post(esc_url(home_url('/wc-api/v3/products'. $elementos_produto['ID'])), $woocommerce_header);
            }else{

                /**
                 *
                 * Atualiza os produtos via solicitação da API do WooCommerce
                 *
                 */
                $woocommerce_header = array(
                    'headers' => array(
                        'Authorization' => 'Basic '. base64_encode('ck_6cd66a0b48664e0ad18d497334de60dc30e1d140:cs_56dc27805b2a6440608960ab0da094fd06cff48a'),
                    ),
                    'body'    => array(
                        'ID'                 => $elementos_produto['ID'],
                        'name'               => $elementos_produto['name'],
                        'price'              => $elementos_produto['price'],
                        'regular_price'      => $elementos_produto['price'],
                        'catalog_visibility' => 'visible',
                        'stock_status'       => $stock_status,
                        'stock_quantity'     => $elementos_produto['stock_quantity'],
                        'description'        => $elementos_produto['description'],
                        'weight'             => $elementos_produto['weight'],
                        'length'             => $elementos_produto['length'],
                        'width'              => $elementos_produto['width'],
                        'height'             => $elementos_produto['height'],
                        'sku'                => $elementos_produto['sku']
                    )
                );

                $woocommerce_response = wp_remote_post(esc_url(home_url('/wc-api/v3/products')), $woocommerce_header);
            }
        }
    }
}

/**
 *
 * Ativa na inicialização do tema
 *
 */
add_action('init', 'vetor_integration');
