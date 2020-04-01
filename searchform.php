<?php 
/**
 * 
 * Modelo personalizado para formulário de busca
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<form class="aqua-search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>" role="search">
    <input type="search" class="aqua-input" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Procurando algo?', 'wm-template' ); ?>"/>
    <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>  
</form>
