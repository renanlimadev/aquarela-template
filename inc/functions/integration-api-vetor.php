<?php 
/**
 *
 * Integração via API's com o vetor e o WooCommerce
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

    
        $result = json_decode(wp_remote_retrieve_body($vetor_response), true);
   
        $produtos = $result['Produtos'];
        $codigos  = $result['CodigosBarra'];

        /**
         *
         * Inicia a manipulação dos dados retornados
         *
         */
        $contador = 0;

        foreach($codigos as $codigo){

        	$estoque[$contador] = $codigo['qnt_estoque_disponivel'];

        	$contador = $contador + 1;
        }

        /**
         *
         * Reinicia o contador
         *
         */
        $contador = 0;

        foreach($produtos as $produto){

        	/**
        	 *
        	 * Retorna o ID do produto pelo SKU
        	 *
        	 */
        	$return_id = wc_get_product_id_by_sku($produto['dsc_referencia']);

        	/**
        	 *
        	 * Retorna o produto em forma de objeto
        	 *
        	 */
        	$return_product = wc_get_product($return_id);

        	$preco[$contador] = $produto. 0;

        	if(is_object($return_product)){

        		$wc_header = array(
        			'method'  => 'PUT',
	        		'headers' => array(
	        			'Authorization' => 'Basic '. base64_encode('ck_6cd66a0b48664e0ad18d497334de60dc30e1d140:cs_56dc27805b2a6440608960ab0da094fd06cff48a'),
	        			'Content-Type'  => 'application/json'
	        		),
	        		'body'    => array(
	        			'name'               => ucfirst(strtolower($produto['nome_produto'])),
	        			'slug'               => str_replace(' ', '-', strtolower($produto['nome_produto'])),
	        			'type'               => 'simple',
	        			'status'             => 'publish',
	        			'catalog_visibility' => 'visible',
	        			'description'        => $produto['dsc_produto_web'],
	        			'sku'                => strval($produto['dsc_referencia']),
	        			'regular_price'      => strval($preco[$contador]),
	        			'virtual'            => false,
	        			'downloadable'       => false,
	        			'stock_quantity'     => $estoque[$contador],
	        			'stock_status'       => ($estoque[$contador] >= 1) ? 'instock' : 'outofstock',
	        			'weight'             => strval($produto['peso_bruto']),
	        			'dimensions'         => array(
	        				'length' => strval($produto['comprimento']),
	        				'width'  => strval($produto['largura']),
	        				'height' => strval($produto['altura'])
	        			)
	        		)
        		);

        		wp_remote_post('https://aquarelastore.com.br/wp-json/wc/v3/products/'. $return_id, $wc_header);

        	}else{

        		$wc_header = array(
	        		'headers' => array(
	        			'Authorization' => 'Basic '. base64_encode('ck_6cd66a0b48664e0ad18d497334de60dc30e1d140:cs_56dc27805b2a6440608960ab0da094fd06cff48a'),
	        			'Content-Type'  => 'application/json'
	        		),
	        		'body'    => array(
	        			'name'               => ucfirst(strtolower($produto['nome_produto'])),
	        			'slug'               => str_replace(' ', '-', strtolower($produto['nome_produto'])),
	        			'type'               => 'simple',
	        			'status'             => 'publish',
	        			'catalog_visibility' => 'visible',
	        			'description'        => $produto['dsc_produto_web'],
	        			'sku'                => strval($produto['dsc_referencia']),
	        			'regular_price'      => strval($preco[$contador]),
	        			'virtual'            => false,
	        			'downloadable'       => false,
	        			'stock_quantity'     => $estoque[$contador],
	        			'stock_status'       => ($estoque[$contador] >= 1) ? 'instock' : 'outofstock',
	        			'weight'             => strval($produto['peso_bruto']),
	        			'dimensions'         => array(
	        				'length' => strval($produto['comprimento']),
	        				'width'  => strval($produto['largura']),
	        				'height' => strval($produto['altura'])
	        			)
	        		)
        		);

        		wp_remote_post('https://aquarelastore.com.br/wp-json/wc/v3/products', $wc_header);
        	}
        	

        	$contador = $contador + 1;
        	
        }
    
}

/**
 *
 * Ativa o Hook de carregamento
 *
 */
add_action('init', 'custom_api_vetor_integration');
