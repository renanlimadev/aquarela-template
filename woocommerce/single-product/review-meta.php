<?php
/**
 * 
 * Meta dados de comentários
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $comment;

$verified = wc_review_is_from_verified_owner($comment->comment_ID);

if('0' === $comment->comment_approved):?>

	<p class="meta">
		<em class="woocommerce-review__awaiting-approval">
			<?php esc_html_e('Seu comentário está aguardando aprovação', 'woocommerce');?>
		</em>
	</p>

<?php else:?>

	<p class="meta">
		<strong class="woocommerce-review__author"><?php comment_author();?></strong>
		<?php
		if('yes' === get_option('woocommerce_review_rating_verification_label') && $verified ):
			echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'usuário verificado', 'woocommerce' ) . ')</em> ';
		endif;?>
		<span class="woocommerce-review__dash">&ndash;</span><time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date('c'));?>"><?php echo esc_html(get_comment_date(wc_date_format()));?></time>
	</p>

<?php endif;
