<?php 
/**
 * 
 * Arquivo principal de funções de manipulação do core do Wordpress, favor não excluir
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

/**
 * 
 * Suporte para miniaturas
 *  
 */
add_theme_support('post-thumbnails');
/**
 * 
 * Suporte para Feed
 * 
 */
add_theme_support('automatic-feed-links');
/**
 * 
 * Suporte para formatos de post
 * 
 */
add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
/**
 * 
 * Suporte para descrição
 * 
 */
add_post_type_support('page', 'excerpt');
/**
 * 
 * Suporte para formulários
 * 
 */ 
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
/**
 * 
 * Suporte para a meta Title
 * 
 */
add_theme_support('title-tag');
/**
 * 
 * Desativa meta tags que geram insegurança
 * 
 */
function disable_metatags()
{
    remove_action('wp_head', 'wp_generator') ;
    remove_action('wp_head', 'wlwmanifest_link') ;
    remove_action('wp_head', 'rsd_link') ;
}

add_action('init', 'disable_metatags');

/**
 * 
 * Limita o número de caracteres do resumo
 * 
 */
function get_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 90);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

// Chamada ao arquivo que personaliza as funcionalidades do WooCommerce
require_once get_template_directory(). '/inc/functions/woocommerce-functions.php';

/**
 * 
 * Retorna os arquivos js e css para todas as páginas
 *
 */
function aquarela_scripts(){
    
    wp_enqueue_script('popperJs', get_template_directory_uri(). '/assets/js/popper.js/popper.min.js', array(), '1.0.0', false);

    wp_enqueue_script('jQuerySlim', get_template_directory_uri(). '/assets/js/jquery/jquery.slim.min.js', array(), '1.0.0', false);

    wp_enqueue_script('bootstrapJs', get_template_directory_uri(). '/assets/js/bootstrap/bootstrap.min.js', array(), '1.0.0', false);

    wp_enqueue_script('AquarelaScript', get_template_directory_uri(). '/assets/js/aquarela-script.js', array(), '1.0.0', true);

    wp_enqueue_script('fontAwesomeJs', get_template_directory_uri(). '/assets/js/fontawesome/fontawesome.min.js', array(), '1.0.0', true);

    wp_enqueue_style('AquarelaCss', get_template_directory_uri().'/assets/css/aquarela-style.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'aquarela_scripts');

/**
 * 
 * Ativa as listas de navegação
 * 
 */
function aquarela_register_menus(){
    register_nav_menus(
        $args = array(
            'top'     => __('Menu Principal'),
            'right'   => __('Menu Lateral'),
            'footer1' => __('Primeiro Menu de Rodapé'),
            'footer2' => __('Segundo Menu de Rodapé'),
            'cart'    => __('Menu para Carrinho de Compras'),
            'user'    => __('Menu para cliente logado')
        )
    );
}

add_action('init', 'aquarela_register_menus');

/**
 * 
 * Adiciona classes aos itens de menus
 * 
 */
function aquarela_list_items($classes, $item, $args){
    $classes[] = 'nav-item';
 
    return $classes;
}

add_filter('nav_menu_css_class', 'aquarela_list_items', 10, 3);

/**
 * 
 * Adiciona classes aos links de menus
 * 
 */
function aquarela_list_links($atts, $item, $args){
    $atts['class'] = 'nav-link';
 
    return $atts;
}
add_filter('nav_menu_link_attributes', 'aquarela_list_links', 10, 3);

/**
 * 
 * Adiciona classes ao item ativo
 * 
 */
function special_nav_class($classes, $item){
    if (in_array('current-menu-item', $classes) ){
      $classes[] = 'active ';
    }
    return $classes;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

/**
 * 
 * Retorna css para o admin panel
 * 
 */

function custom_admin_css(){
	echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri(). '/assets/css/admin.css"/>';
}

add_action('login_head', 'custom_admin_css');

/**
 * 
 * Redireciona o link do título
 * 
 */
function admin_redirect(){
	return get_bloginfo('url');
}

add_filter('login_headerurl', 'admin_redirect');

/**
 * 
 * Modifica o título
 * 
 */
function admin_title(){
	return 'Visualizar Site';
}

add_filter('login_headertext', 'admin_title');

/**
 * 
 * Modificando campo de texto de rodapé
 * 
 */
function admin_footer(){
	echo '<a style="text-decoration: none;" href="https://renandev.com.br"><span style="font-size: 11pt; font-family: arial sans-serif;">&#10140; Criado com carinho por Renan Delgado de Lima.</span></a>';
}

add_filter('admin_footer_text', 'admin_footer');

/**
 * 
 * Remove a logo do admin panel
 * 
 */
function remove_logo_dash($wp_admin_bar){
	$wp_admin_bar->remove_node('wp-logo');
}

add_action('admin_bar_menu', 'remove_logo_dash', 100);

/**
 * 
 * Imprimi a imagem de miniatura
 * 
 */
function aquarela_print_thumbnail($status){
    if($status == 'shop'):
        if(has_post_thumbnail()):
            the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top product-img']);
        else:?>
            <img class="card-img-top product-img" src="<?php bloginfo('template_url')?>/assets/images/default-thumbnail.png" alt="Miniatura padrão"/>
        <?php endif;
    elseif('cart'):
        if(has_post_thumbnail()):
            the_post_thumbnail('post-thumbnail', ['class' => 'woocommerce-placeholder wp-post-image']);
        else:?>
            <img class="woocommerce-placeholder wp-post-image" src="<?php bloginfo('template_url')?>/assets/images/default-thumbnail.png" alt="Miniatura padrão" style="width: 38px; height: 38px;"/>
        <?php endif;
    endif;
}

/**
 * 
 * Imprimi o favicon
 * 
 */
function aquarela_favicon(){
    echo '
        <link rel="apple-touch-icon" sizes="180x180" href="'. get_template_directory_uri(). '/assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="'. get_template_directory_uri(). '/assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="'. get_template_directory_uri(). '/assets/icons/favicon-16x16.png">
        <link rel="manifest" href="'. get_template_directory_uri(). '/assets/icons/site.webmanifest">
    ';
}

add_action('wp_head', 'aquarela_favicon');

/**
 * 
 * Adiciona a meta tag de rastreamento do Analytics
 * 
 */
function gtag_analytics(){
    // Adicione o código aqui
}

/**
 * 
 * Remove a barra superior quando logado
 * 
 */
remove_action( 'wp_footer', 'wp_admin_bar_render', 10000 );
