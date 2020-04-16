<?php
/**
 * 
 * Formulário para recuperação de senha
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

do_action('woocommerce_before_lost_password_form');?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password from-group">

	<p class="main-title pt-3 text-center">Para recuperar a sua senha, use o seu e-mail abaixo</p>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="user_login" class="d-none">Username ou e-mail</label>
		<input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="text" placeholder="Digite o seu e-mail ou username" name="user_login" id="user_login" autocomplete="username"/>
	</p>

	<div class="clear"></div>

	<?php do_action('woocommerce_lostpassword_form');?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" class="d-none" name="wc_reset_password" value="true"/>
		<button type="submit" class="woocommerce-Button button btn btn-info" value="<?php esc_attr_e('Reset password', 'woocommerce');?>">Recriar senha</button>
	</p>

	<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce');?>

</form>
<?php do_action( 'woocommerce_after_lost_password_form' );
