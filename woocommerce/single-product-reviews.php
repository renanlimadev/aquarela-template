<?php
/**
 * 
 * Mostra as reviews em singular product
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $product;

if(! comments_open()):
	return;
endif;?>

<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
				$count = $product->get_review_count();
				if($count && wc_review_ratings_enabled()):
					/* translators: 1: reviews count 2: product name */
					$reviews_title = sprintf(esc_html( _n('%1$s comentário para %2$s', '%1$s avaliações para %2$s', $count, 'woocommerce')), esc_html($count), '<span>' . get_the_title() . '</span>');
					echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
				else:
					esc_html_e('Comentários', 'woocommerce');
				endif;
			?>
		</h2>

		<?php if(have_comments()):?>
			<ol class="commentlist">
				<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments')));?>
			</ol>

			<?php
				if(get_comment_pages_count() > 1 && get_option('page_comments')):
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links(
						apply_filters(
							'woocommerce_comment_pagination_args',
							array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							)
						)
					);
					echo '</nav>';
				endif;
			?>
		<?php else :?>
			<p class="woocommerce-noreviews"><?php esc_html_e('Sem comentários', 'woocommerce');?></p>
		<?php endif;?>
	</div>

	<?php if(get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())):?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter    = wp_get_current_commenter();
					$comment_form = array(
						/* translators: %s is product title */
						'title_reply'         => have_comments() ? esc_html__('Novo comentário', 'woocommerce') : sprintf(esc_html__('Seja o primeiro a falar sobre o produto &nbsp; &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
						/* translators: %s is product title */
						'title_reply_to'      => 'Responder %s',
						'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</span>',
						'comment_notes_after' => '',
						'label_submit'        => 'Enviar',
						'logged_in_as'        => '',
						'comment_field'       => '',
					);

					$name_email_required = (bool) get_option('require_name_email', 1);
					$fields              = array(
						'author' => array(
							'label'    => 'Nome',
							'type'     => 'text',
							'value'    => $commenter['comment_author'],
							'required' => $name_email_required,
						),
						'email'  => array(
							'label'    => 'E-mail',
							'type'     => 'email',
							'value'    => $commenter['comment_author_email'],
							'required' => $name_email_required,
						),
					);

					$comment_form['fields'] = array();

					foreach($fields as $key => $field):
						$field_html  = '<p class="comment-form-'. esc_attr($key). '">';
						$field_html .= '<label for="'. esc_attr($key). '">'. esc_html( $field['label']);

						if($field['required']){
							$field_html .= '&nbsp;<span class="required">*</span>';
						}

						$field_html .= '</label><input id="'. esc_attr($key). '" name="'. esc_attr($key). '" type="'. esc_attr($field['type']). '" value="' . esc_attr($field['value']). '" size="30" '. ($field['required'] ? 'required' : ''). ' /></p>';

						$comment_form['fields'][$key] = $field_html;
					endforeach;

					$account_page_url = wc_get_page_permalink('myaccount');

					if($account_page_url):
						/* translators: %s opening and closing link tags respectively */
						$comment_form['must_log_in'] = '<p class="must-log-in">'. sprintf( esc_html__('Você precisa estar %1$slogado%2$s para postar um comentário.', 'woocommerce'), '<a href="'. esc_url( $account_page_url). '">', '</a>'). '</p>';
					endif;

					if(wc_review_ratings_enabled()):
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">'. esc_html__('Avaliação', 'woocommerce'). '</label><select name="rating" id="rating" required>
							<option value="">'. esc_html__('Rate&hellip;', 'woocommerce'). '</option>
							<option value="5">'. esc_html__('Perfect', 'woocommerce'). '</option>
							<option value="4">'. esc_html__('Good', 'woocommerce'). '</option>
							<option value="3">'. esc_html__('Average', 'woocommerce'). '</option>
							<option value="2">'. esc_html__('Not that bad', 'woocommerce'). '</option>
							<option value="1">'. esc_html__('Very poor', 'woocommerce'). '</option>
						</select></div>';
					endif;

					$comment_form['comment_field'] .= '<form class="comment-form-comment form-group py-1"><label for="comment">'. esc_html__('Seu comentário', 'woocommerce'). '&nbsp;</label><textarea class="form-control my-1" id="comment" name="comment" cols="45" rows="8" required></textarea></form>';

					comment_form(apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form));
				?>
			</div>
		</div>
	<?php else:?>
		<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce');?></p>
	<?php endif;?>
	<div class="clear"></div>
</div>
