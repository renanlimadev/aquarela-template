<?php 
/**
 * 
 * Cabeçalho principal do template
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head();?>
    </head>
    <body <?php body_class();?>>
        <div class="sticky-top" id="topBanner">
            <header class="container-fluid bg-light py-2" role="banner">
                <div class="row">
                    <div class="col-md-2 align-items-center">
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>">
                            <img class="logo-aqua" src="<?php bloginfo('template_url');?>/assets/icons/aquarela-logo.svg" alt="Logotipo oficial Aquarela Kids Store"/>
                        </a>
                    </div>
                    <div class="col-md-7 my-auto px-auto">
                        <?php get_search_form();?>
                    </div>
                    <div class="col-md-3 my-auto">
                        <div class="row text-center">
                            <div class="col-6 header-user">
                                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-user"></i></a>
                                <?php 
                                    if(!is_user_logged_in()):
                                        get_template_part('template-parts/navs/navbar', 'login');
                                    else:
                                         get_template_part('template-parts/navs/navbar', 'logged');
                                    endif;
                                ?>
                            </div>
                            <div class="col-6 header-user">
                                <a class="dropdown-toggle" role="button" id="dropdownCartLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-shopping-cart"></i></a>
                                <?php 
                                    if(WC()->cart->is_empty()):
                                        get_template_part('template-parts/carts/cart', 'empty');
                                    else:
                                        get_template_part('template-parts/carts/cart', 'shop');
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <?php get_template_part('template-parts/navs/navbar', 'top');?>
        </div>
