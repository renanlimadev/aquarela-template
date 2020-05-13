<?php 
/**
 * 
 * Integração com a API Json do vetor para a manutenção dos produtos
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
        )
    );

    $vetor_response = wp_remote_get('https://wss.mitryus.com.br:8087/wsintegracao/api/ecommerce/integracao/pacotedados', $vetor_header);

    
    $resultado = json_decode(wp_remote_retrieve_body($vetor_response), true);
   
    $produtos  = $resultado['Produtos'];
    $codigos   = $resultado['CodigosBarra'];

    /**
     *
     * Faz o update dos produtos
     *
     */
    foreach($produtos as $produto){

        /**
         *
         * Cria um array com a quantidade de estoque
         *
         */
        foreach($codigos as $codigo){

            if($produto['cod_produto'] == $codigo['cod_produto']){
                $estoque = $codigo['qnt_estoque_disponivel'];
            }

        }

        /**
         * 
         * Alimentação de variáveis
         * 
         */
        $sku                = strval($produto['dsc_referencia']);
    	$id_produto         = wc_get_product_id_by_sku($sku);
        $produto_cadastrado = wc_get_product($id_produto);
        $nome_produto       = ucfirst(strtolower($produto['nome_produto']));
        $slug               = str_replace(' ', '-', strtolower($produto['nome_produto']));
    	$preco_produto      = strval($produto['vl_venda_vista']. 0);

        /**
         * 
         * Controla o Status do Stock
         * 
         */
    	if($estoque <= 0){
            $status_estoque = 'outofstock';
    	}else{
    		$status_estoque = 'instock';
    	}

        /**
         * 
         * Controla a visibilidade so produto
         * 
         */
    	if($produto['is_fora_linha'] == false){
    		$catalogo = 'visible';
    	}else{
    		$catalogo = 'hidden';
        }

        if(is_object($produto_cadastrado)){

            $id_produto_atualizado = wp_update_post(
                array(
                    'ID'           => $id_produto,
                    'post_title'   => $nome_produto,
                    'post_author'  => get_current_user_id(),
                    'post_status'  => 'publish',
                    'post_type'    => 'product',
                )
            );

            update_post_meta($id_produto_atualizado, '_visibility', $catalogo);
            update_post_meta($id_produto_atualizado, '_price', $preco_produto);
            update_post_meta($id_produto_atualizado, '_regular_price', $preco_produto);
            update_post_meta($id_produto_atualizado, '_stock_status', $status_estoque);
            update_post_meta($id_produto_atualizado, '_manage_stock', 'yes');
            update_post_meta($id_produto_atualizado, '_stock_quantity', strval($estoque));
            update_post_meta($id_produto_atualizado, '_weight', strval($produto['peso_bruto']));
            update_post_meta($id_produto_atualizado, '_length', strval($produto['comprimento']));
            update_post_meta($id_produto_atualizado, '_width', strval($produto['largura']));
            update_post_meta($id_produto_atualizado, '_height', strval($produto['altura']));

        }else{

            $id_produto_novo = wp_insert_post(
                array(
                    'post_title'   => $nome_produto,
                    'post_author'  => get_current_user_id(),
                    'post_status'  => 'publish',
                    'post_type'    => 'product',
                    'post_content' => 'Novo Produto'
                )
            );

            wp_set_object_terms($id_produto_novo, 'product_variation', 'product_type');

            update_post_meta($id_produto_novo, '_visibility', $catalogo);
            update_post_meta($id_produto, '_price', $preco_produto);
            update_post_meta($id_produto_novo, '_regular_price', $preco_produto);
            update_post_meta($id_produto_novo, '_stock_status', $status_estoque);
            update_post_meta($id_produto_novo, '_manage_stock', 'yes');
            update_post_meta($id_produto_novo, '_sku', $sku);
            update_post_meta($id_produto_novo, '_stock_quantity', strval($estoque));
            update_post_meta($id_produto_novo, '_weight', strval($produto['peso_bruto']));
            update_post_meta($id_produto_novo, '_length', strval($produto['comprimento']));
            update_post_meta($id_produto_novo, '_width', strval($produto['largura']));
            update_post_meta($id_produto_novo, '_height', strval($produto['altura']));

        }

    }

}

/**
 * 
 * Inicia a função
 * 
 */
add_action('init', 'vetor_integration');
