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

            $preco = $produto['vl_venda_vista']. 0;

           $novo_produto[$contador] = new WC_Product();

            $novo_produto[$contador]->set_name(ucfirst(strtolower($produto['nome_produto'])));
            $novo_produto[$contador]->set_slug(str_replace(' ', '-', strtolower($produto['nome_produto'])));
            $novo_produto[$contador]->set_status('publish');
            $novo_produto[$contador]->set_catalog_visibility('visible');
            $novo_produto[$contador]->set_description($produto['dsc_produto_web']);
            $novo_produto[$contador]->set_sku($produto['dsc_referencia']);
            $novo_produto[$contador]->set_price(strval($preco));
            $novo_produto[$contador]->set_regular_price(strval($preco));
            $novo_produto[$contador]->set_weight(strval($produto['peso_bruto']));
            $novo_produto[$contador]->set_length(strval($produto['comprimento']));
            $novo_produto[$contador]->set_width(strval($produto['largura']));
            $novo_produto[$contador]->set_height(strval($produto['altura']));
            $novo_produto[$contador]->validate_props();
            $novo_produto[$contador]->save();

            $contador = $contador + 1;

        }

        $contador = 0;

        foreach($codigos as $codigo){

            $atualiza_dados[$contador] = new WC_Product();

            $atualiza_dados[$contador]->set_stock_quantity($codigo['qnt_estoque_disponivel']);
            $atualiza_dados[$contador]->validate_props();
            $atualiza_dados[$contador]->save();

            $contador = $contador + 1;
        }
    
}

/**
 *
 * Ativa na inicialização do tema
 *
 */
add_action('init', 'vetor_integration');
