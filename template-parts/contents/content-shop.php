<?php 
/**
 * 
 * Container para arquivamento de produtos
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<div class="col-md-3 col-6 my-4">
    <li class="card border product-card w-75 shadow">

        <?php aquarela_print_thumbnail();?>

        <div class="card-body text-center">

            <h3 class="product-title card-title font-weight-bold"><?php the_title();?></h3>
            <?php 
            GLOBAL $product;

            $price                 = $product->get_price();
            $regular_price         = $product->get_regular_price();
            $my_stock              = $product->get_stock_quantity();

            $new_price             = str_replace('.', ',', $price);
            $new_regular_price     = str_replace('.', ',', $regular_price);?>

            <p class="product-price card-subtitle py-2">
                <?php if($regular_price != $price):?>
                <span class="text-muted pr-1"><strike><?php echo 'R$: '. $new_regular_price;?></strike></span>
                <?php endif;?>
                <span class="text-aqua pl-1"><?php echo 'R$: '. $new_price;?></span>
            </p>
            <p class="stock-aqua pb-4">
                <?php 
                    if($my_stock):
                        echo 'Em estoque: '. $my_stock;
                    else:
                        echo 'Estoque: Indisponível';
                    endif;
                ?>
            </p>

            <div class="row text-center pt-5 pb-1">
                <div class="col col-sm col-md col-lg col-xl col-prod">
                    <a class="product-link prod-info" href="<?php esc_url($product->add_to_cart_url());?>" data-quantity="<?php esc_attr(isset($args['quantity']) ? $args['quantity'] : 1);?>" <?php isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '';?>>COMPRAR</a>
                </div>
                <div class="col col-sm col-md col-lg col-xl col-prod">
                    <a class="product-link prod-info" href="<?php echo get_the_permalink();?>" target="_blank">ESPIAR</a>
                </div>
            </div>
        </div>
    </li>
</div>
