<?php 
/**
 * 
 * Integração com o ERP vetor via API para modelagem de produtos, atributos e categorias
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */
function set_integration_vetor(){

    GLOBAL $post;

    /**
     * 
     * Faz a requisição da API
     * 
     */
    $vetor_header = array(
        'headers' => array(
            'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJBUUtELTU3NDkiLCJleHAiOjE5MDI4NTUxNjUsInJvbCI6WyJST0xFX1VTRVIiXX0.K3RKyAs9WZ-Brk4uuPtw1a_mKIVUkhyO-iEzjSMvEFcGQ1ybqHBbtmwvnqM6KWH_9MAnHJZBxcejsbLZCC3xgg',
            'Content-Type'  => 'application/json',
        )
    );

    $vetor_response = wp_remote_get('https://wss.mitryus.com.br:8087/wsintegracao/api/ecommerce/integracao/pacotedados', $vetor_header);

    /**
     * 
     * Retorna os dados em forma de matriz
     * 
     */
    $dados = json_decode(wp_remote_retrieve_body($vetor_response), true);

    /**
     * 
     * Quebra a matriz principal em pequenas matrizes intuitivas
     * 
     */
    $departamentos    = $dados['Departamentos']; // Usado como categoria
    $grupos           = $dados['Grupos']; // Usado como categoria
    $sub_grupos       = $dados['SubGrupos']; // Usado como categoria
    $secoes           = $dados['Secoes']; // Usado como categoria
    $estacoes         = $dados['Estacoes']; // Usado como categoria
    $estilos          = $dados['Estilos']; // Usado como categoria
    $cores            = $dados['Cores']; // Usado como variação de produtos
    $tamanhos         = $dados['Tamanhos']; // Usado como variação de produtos
    $produtos         = $dados['Produtos']; // Gerencia os dados dos produtos
    $produto_removido = $dados['ProdutoRemovido']; // Gerencia a exclusão de produtos
    $codigos_barra    = $dados['CodigosBarra']; // Gerencia o estoque e a diferenciação dos produtos
    $oferta           = $dados['Oferta']; // Gerencia os preços promocionais dos produtos
    $contador         = 0; // Contador para os laços

    /**
     * 
     * Iteração para departamentos
     * 
     */
    foreach($departamentos as $departamento){

        /**
         * 
         * Alimenta a váriavel corretamente com o nome da categoria
         * 
         */
        $nome_departamento = ucfirst(strtolower($departamento['nome_departamento']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_departamento, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_departamento[$contador]                     = wp_insert_term($nome_departamento, 'product_cat');
            $term_departamento[$contador]['cod_departamento'] = $departamento['cod_departamento'];

        }else{

            /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_departamento, 'product_cat', ARRAY_A);

            $term_departamento[$contador]['term_id']          = $term_array['term_id'];
            $term_departamento[$contador]['term_taxonomy_id'] = $term_array['term_taxonomy_id'];
            $term_departamento[$contador]['cod_departamento'] = $departamento['cod_departamento']; 

        }

        $contador = $contador + 1;

    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para grupos
     * 
     */
    foreach($grupos as $grupo){

        /**
         * 
         * Alimenta a variável coretamente com o nome
         * 
         */
        $nome_grupo = ucfirst(strtolower($grupo['nome_grupo']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_grupo, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_grupo[$contador]              = wp_insert_term($nome_grupo, 'product_cat');
            $term_grupo[$contador]['cod_grupo'] = $grupo['cod_grupo'];

        }else{

            /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_grupo, 'product_cat', ARRAY_A);

            $term_grupo[$contador]['term_id']          = $term_array['term_id'];
            $term_grupo[$contador]['term_taxonomy_id'] = $term_array['term_taxonomy_id'];
            $term_grupo[$contador]['cod_grupo']        = $grupo['cod_grupo'];

        }

        $contador = $contador + 1;
    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para sub-grupos
     * 
     */
    foreach($sub_grupos as $sub_grupo){

        /**
         * 
         * Alimenta a variável coretamente com o nome
         * 
         */
        $nome_sub_grupo = ucfirst(strtolower($sub_grupo['nome_subgrupo']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_sub_grupo, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_sub_grupo[$contador]                 = wp_insert_term($nome_sub_grupo, 'product_cat');
            $term_sub_grupo[$contador]['cod_subgrupo'] = $grupo['cod_subgrupo'];
            

        }else{

             /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_sub_grupo, 'product_cat', ARRAY_A);

            $term_sub_grupo[$contador]['term_id']          = $term_array['term_id'];
            $term_sub_grupo[$contador]['term_taxonomy_id'] = $term_array['term_taxonomy_id'];
            $term_sub_grupo[$contador]['cod_subgrupo']     = $sub_grupo['cod_subgrupo'];

        }

        $contador = $contador + 1;

    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para Seções
     */
    foreach($secoes as $secao){

        /**
         * 
         * Alimenta a variável coretamente com o nome
         * 
         */
        $nome_secao = ucfirst(strtolower($secao['nome_secao']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_secao, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_secao[$contador]              = wp_insert_term($nome_secao, 'product_cat');
            $term_secao[$contador]['cod_secao'] = $secao['cod_secao'];

        }else{

            /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_secao, 'product_cat', ARRAY_A);

            $term_secao[$contador]['term_id']          = $term_array['term_id'];
            $term_secao[$contador]['term_taxonomy_id'] = $term_array['term_taxonomy_id'];
            $term_secao[$contador]['cod_secao']        = $secao['cod_secao'];

        }

        $contador = $contador + 1;

    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para Estações
     * 
     */
    foreach($estacoes as $estacao){

        /**
         * 
         * Alimenta a variável coretamente com o nome
         * 
         */
        $nome_estacao = ucfirst(strtolower($estacao['nome_estacao']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_estacao, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_estacao[$contador]                = wp_insert_term($nome_estacao, 'product_cat');
            $term_estacao[$contador]['cod_estacao'] = $estacao['cod_estacao'];

        }else{

            /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_estacao, 'product_cat', ARRAY_A);

            $term_estacao[$contador]['term_id']            = $term_array['term_id'];
            $term_estacao[$contador]['term_taxonomy_id']   = $term_array['term_taxonomy_id'];
            $term_estacao[$contador]['cod_estacao']        = $estacao['cod_estacao'];

        }

        $contador = $contador + 1;

    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para Estilos
     * 
     */
    foreach($estilos as $estilo){

        /**
         * 
         * Alimenta a variável coretamente com o nome
         * 
         */
        $nome_estilo = ucfirst(strtolower($estilo['nome_estilo']));

        /**
         * 
         * Viarável utilizada para condicional
         * 
         */
        $cat_status = term_exists($nome_estilo, 'product_cat');

        /**
         * 
         * Cria ou atuaiza a categoria
         * 
         */
        if($cat_status == null){

            /**
             * 
             * Registra a categoria e retorna os ID's de taxonomia e termo
             * 
             */
            $term_estilo[$contador]               = wp_insert_term($nome_estilo, 'product_cat');
            $term_estilo[$contador]['cod_estilo'] = $estilo['cod_estilo'];

        }else{

            /**
             * 
             * Recupera os dados do termo, caso já esteja registrado
             * 
             */
            $term_array = get_term_by('name', $nome_estilo, 'product_cat', ARRAY_A);

            $term_estilo[$contador]['term_id']            = $term_array['term_id'];
            $term_estilo[$contador]['term_taxonomy_id']   = $term_array['term_taxonomy_id'];
            $term_estilo[$contador]['cod_estilo']         = $estilo['cod_estilo'];

        }

        $contador = $contador + 1;

    }

    /**
     * 
     * Reseta o contador
     * 
     */
    $contador = 0;

    /**
     * 
     * Iteração para Produtos
     */
    foreach($produtos as $produto){

        /**
         * 
         * Alimenta algumas variáveis necessárias
         * 
         */
        $nome_produto = ucfirst(strtolower($produto['nome_produto']));
        $sku          = strval($produto['dsc_referencia']);
        $preco_venda  = strval($produto['vl_venda_vista']. 0);

    }

}

/**
 * 
 * Inicia a função
 * 
 */
add_action('init', 'set_integration_vetor');