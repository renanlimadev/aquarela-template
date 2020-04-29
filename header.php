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
            <header class="container-fluid bg-white pb-2" role="banner">
                <div class="row">
                    <div class="col col-sm col-md col-lg col-xl text-center bg-aqua-2 py-0">
                        <p class="text-white mt-auto mb-auto">Version - 1.0.0 > Beta</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 align-items-center text-center">
                        <div class="row">
                        <div class="col-sm-3 col-3 my-auto header-user d-mobile">
                            <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-user"></i></a>
                            <?php 
                                if(!is_user_logged_in()):
                                    get_template_part('woocommerce/auth/form', 'login');
                                else:
                                     get_template_part('template-parts/navs/navbar', 'logged');
                                endif;
                            ?>
                        </div>
                        <div class="col-sm-6 col-6">
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>">
                            <img class="logo-aqua" src="<?php bloginfo('template_url');?>/assets/icons/aquarela-logo.svg" alt="Logotipo oficial Aquarela Kids Store"/>
                        </a>
                        </div>
                        <div class="col-sm-3 col-3 my-auto header-user d-mobile">
                            <a class="dropdown-toggle" role="button" id="dropdownCartLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-shopping-cart"></i></a>
                            <?php 
                                if(WC()->cart->get_cart_contents_count() == 0):
                                    get_template_part('woocommerce/cart/cart', 'empty');
                                else:
                                    get_template_part('woocommerce/cart/mini', 'cart');
                                endif;
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-7 my-auto px-auto">
                        <?php get_search_form();?>
                    </div>
                    <div class="col-md-3 my-auto">
                        <div class="row text-center">
                            <div class="col-6 header-user d-desktop">
                                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-user"></i></a>
                                <?php 
                                    if(!is_user_logged_in()):
                                        get_template_part('woocommerce/auth/form', 'login');
                                    else:
                                         get_template_part('template-parts/navs/navbar', 'logged');
                                    endif;
                                ?>
                            </div>
                            <div class="col-6 header-user d-desktop">
                                <a class="dropdown-toggle" role="button" id="dropdownCartLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="market-icon fas fa-shopping-cart"></i></a>
                                <?php 
                                    if(WC()->cart->get_cart_contents_count() == 0):
                                        get_template_part('woocommerce/cart/cart', 'empty');
                                    else:
                                        get_template_part('woocommerce/cart/mini', 'cart');
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <?php get_template_part('template-parts/navs/navbar', 'top');?>
        </div>
        <?php if(is_front_page()):?>
            <div id="carouselExampleIndicators" class="carousel slide d-desktop" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo bloginfo('template_url');?>/assets/images/mommy-caroussel.png" alt="Primeiro Slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo bloginfo('template_url');?>/assets/images/mom-sucre-caroussel.png" alt="Segundo Slide">
                    </div>
                </div>
                
            </div>
        <?php endif;
