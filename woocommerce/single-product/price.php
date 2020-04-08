<?php
/**
 * 
 * Mostra o preço em produto singular
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;

$price                 = $product->get_price();
$regular_price         = $product->get_regular_price();
$new_price             = str_replace('.', ',', $price);
$new_regular_price     = str_replace('.', ',', $regular_price);?>

<p class="product-price card-subtitle py-2">
    <?php if($regular_price != $price):?>
    <span class="text-muted pr-1"><strike><?php echo 'R$: '. $new_regular_price;?></strike></span>
    <?php endif;?>
    <span class="text-aqua pl-1"><?php echo 'R$: '. $new_price;?></span>
</p>
