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

        /**
         *
         * Inicia a manipulação dos dados retornados
         *
         */
        

        foreach($produtos as $produto){

            /**
             *
             * Veirfica se existe um produto, caso sim, ele retorna um objeto, do contrário, null ou false
             *
             */
            $produto_cadastrado = wc_get_product(get_the_ID());

            if(is_object($produto_cadastrado) && $produto_cadastrado->get_sku() == $produto['dsc_referencia']){
                $produto_cadastrado->set_name(ucfirst(strtolower($produto['nome_produto'])));
                $produto_cadastrado->set_slug(strtolower(str_replace(' ', '-', $produto['nome_produto'])));
                $produto_cadastrado->save();
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
