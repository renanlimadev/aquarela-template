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
        <?php get_template_part('template-parts/navs/navbar', 'top');?>
        <header class="container-fluid" role="banner">
        </header>
