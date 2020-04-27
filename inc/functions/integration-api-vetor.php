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
function custom_api_vetor_integration(){

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
    $contador1 = 0;
    $contador2 = 0;

    /**
     *
     * Cria um array com a quantidade de estoque
     *
     */
    foreach($codigos as $codigo){

    	$estoque[$contador1] = $codigo['qnt_estoque_disponivel'];

    	$contador1 = $contador1 + 1;
    }

    /**
     *
     * Faz o update dos produtos
     *
     */
    foreach($produtos as $produto){

    	$id_produto = wc_get_product_id_by_sku($estoque[$contador2]);

    	$produto_cadastrado = wc_get_product($id_produto);

    	if($produto['is_fora_linha']){
    		$catalogo = 'visible';
    	}else{
    		$catalogo = 'hide';
    	}

    	if(is_object($produto_cadastrado)){

    		$preco       = $produto['vl_venda_vista']. 0;
    		$dsc_produto = ucfirst(strtolower($produto['dsc_produto_web']));

    		if($estoque[$contador2] <= 0){
    			$status_estoque = 'outofstock';
    		}else{
    			$status_estoque = 'instock';
    		}

    		update_post_meta($id_produto, '_catalog_visibility', $catalogo);
    		update_post_meta($id_produto, '_stock_status', $status_estoque);
    		update_post_meta($id_produto, '_regular_price', strval($preco));
    		update_post_meta($id_produto, '_description', $dsc_produto);
    		update_post_meta($id_produto, '_weight', strval($produto['peso_bruto']));
    		update_post_meta($id_produto, '_length', strval($produto['comprimento']));
    		update_post_meta($id_produto, '_width', strval($produto['largura']));
    		update_post_meta($id_produto, 'height', strval($produto['altura']));
    		update_post_meta($id_produto, '_stock_quantity', $estoque[$contador2]);
    	}

    	$contador2 = $contador2 + 1;
    }
}

/**
 *
 * Inicia a função
 *
 */
add_action('init', 'custom_api_vetor_integration');
