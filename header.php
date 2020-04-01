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
    <body>
        <div class="sticky-top">
        <header class="container-fluid bg-white py-2" role="banner">
            <div class="row">
                <div class="col-3">
                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>">
                        <img class="logo-aqua" src="<?php bloginfo('template_url');?>/assets/icons/aquarela-logo.svg" alt="Logotipo oficial Aquarela Kids Store"/>
                    </a>
                </div>
                <div class="col-6 my-auto px-auto">
                    <?php get_search_form();?>
                </div>
                <div class="col-3 my-auto">
                    <div class="row text-center">
                        <div class="col-6">
                            <i class="market-icon fas fa-user"></i>
                        </div>
                        <div class="col-6">
                            <i class="market-icon fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php get_template_part('template-parts/navs/navbar', 'top');?>
        </div>