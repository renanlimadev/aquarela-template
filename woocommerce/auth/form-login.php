<?php
/**
 * 
 * Forulário de login de clientes
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

GLOBAL $user;?>

<form method="post" class="dropdown-menu px-2 py-2 form-login wc-auth-login" aria-labelledby="dropdownMenuLink">
	<h4 class=" login-text mb-1">Área do cliente</h4>
	<div class="pt-2 pb-1 px-0">
		<label for="username" class="d-none">Username ou email</label>
		<input type="text" class="input-text aqua-login py-2" name="username" id="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr($_POST['username']) : '';?>" placeholder="Digite seu e-mail"/>
	</div>
	<div class="pt-1 pb-1 px-0">
		<label for="password" class="d-none">Senha</label>
		<input class="input-text py-2 aqua-login" type="password" name="password" id="password" placeholder="Digite a senha"/>
	</div>
	<div class="pt-1 pb-1 px-0">
		<a class="text-white" traget="_blank" href="<?php echo esc_url(wp_lostpassword_url());?>">Esqueci minha senha</a>
	</div>
	<div class="pt-1 pb-2 px-0">
		<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"/><span class="text-white">Lembrar Dados</span>
	</div>
	<div class="wc-auth-actions py-2">
		<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce');?>
		<button type="submit" class="button button-large btn-login wc-auth-login-button" name="login" value="<?php esc_attr_e('Login', 'woocommerce');?>"><?php esc_html_e('Login', 'woocommerce');?></button>
		<input type="hidden" name="redirect" value="<?php echo esc_url(wc_get_checkout_url());?>" />
		<a class="btn-login text-end" href="<?php echo esc_url(home_url('/user-register'));?>">cadastrar</a>
	</div>
</form>
