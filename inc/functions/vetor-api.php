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

    if(wp_remote_retrieve_response_message($vetor_response) == 'OK'){
        $result = json_decode(wp_remote_retrieve_body($vetor_response), true);
   
        $produtos = $result['Produtos'];
        $codigos  = $result['CodigosBarra'];

        /**
         *
         * Inicia a manipulação dos dados retornados
         *
         */
        $contador = 0;

        foreach($produtos as $produto){

            /**
             *
             * Veirfica se existe um produto, caso sim, ele retorna um objeto, do contrário, null ou false
             *
             */
            $produto_cadastrado[$contador] = wc_get_product($produto['cod_produto']);

            if(is_object($produto_cadastrado[$contador])){

                $produto_cadastrado[$contador]->set_name(ucfirst(strtolower($produto['nome_produto'])));
                $produto_cadastrado[$contador]->set_slug(str_replace(' ', '-', strtolower($produto['nome_produto'])));
                $produto_cadastrado[$contador]->set_status('publish');
                $produto_cadastrado[$contador]->set_catalog_visibility('visible');
                $produto_cadastrado[$contador]->set_description($produto['dsc_produto_web']);
                $produto_cadastrado[$contador]->set_sku($produto['dsc_referencia']);
                $produto_cadastrado[$contador]->set_price(strval($produto['vl_venda_vista']));
                $produto_cadastrado[$contador]->set_regular_price(strval($produto['vl_venda_vista']));
                $produto_cadastrado[$contador]->set_weight(strval($produto['peso_bruto']));
                $produto_cadastrado[$contador]->set_length(strval($produto['comprimento']));
                $produto_cadastrado[$contador]->set_width(strval($produto['largura']));
                $produto_cadastrado[$contador]->set_height(strval($produto['altura']));
                $produto_cadastrado[$contador]->validate_props();
                $produto_cadastrado[$contador]->save();

            }else{

                $novo_produto[$contador] = new WC_Product();

                $novo_produto[$contador]->set_id($produto['cod_produto']);
                $novo_produto[$contador]->set_post_type('product');
                $novo_produto[$contador]->set_name(ucfirst(strtolower($produto['nome_produto'])));
                $novo_produto[$contador]->set_slug(str_replace(' ', '-', strtolower($produto['nome_produto'])));
                $novo_produto[$contador]->set_status('publish');
                $novo_produto[$contador]->set_catalog_visibility('visible');
                $novo_produto[$contador]->set_description($produto['dsc_produto_web']);
                $novo_produto[$contador]->set_sku($produto['dsc_referencia']);
                $novo_produto[$contador]->set_price(strval($produto['vl_venda_vista']));
                $novo_produto[$contador]->set_regular_price(strval($produto['vl_venda_vista']));
                $novo_produto[$contador]->set_weight(strval($produto['peso_bruto']));
                $novo_produto[$contador]->set_length(strval($produto['comprimento']));
                $novo_produto[$contador]->set_width(strval($produto['largura']));
                $novo_produto[$contador]->set_height(strval($produto['altura']));
                $novo_produto[$contador]->validate_props();
                $novo_produto[$contador]->save();

            }

        $contador = $contador + 1;

        }

        $contador = 0;

        foreach($codigos as $codigo){

            $atualiza_dados[$contador] = wc_get_product($codigo['cod_produto']);
            if(is_object($atualiza_dados[$contador])){
                $atualiza_dados[$contador]->set_stock_quantity($codigo['qnt_estoque_disponivel']);
                $atualiza_dados[$contador]->validate_props();
                $atualiza_dados[$contador]->save();
            }

            $contador = $contador + 1;
        }
    }
}

/**
 *
 * Ativa na inicialização do tema
 *
 */
add_action('loaded', 'vetor_integration');
