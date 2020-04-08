<?php
/**
 * 
 * Container para avaliações
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>

<li>
	<?php do_action( 'woocommerce_widget_product_review_item_start', $args ); ?>

	<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php echo $product->get_image(); ?>
		<span class="product-title"><?php echo $product->get_name(); ?></span>
	</a>

	<?php echo wc_get_rating_html( intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ) ); ?>

	<span class="reviewer"><?php echo sprintf( esc_html__( 'por %s', 'woocommerce' ), get_comment_author( $comment->comment_ID ) ); ?></span>

	<?php do_action( 'woocommerce_widget_product_review_item_end', $args ); ?>
</li>
