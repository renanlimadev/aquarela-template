<?php
/**
 * 
 * Formulário de cadastramento de usuário
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<div class="row px-5 py-3">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form method="post" class="woocommerce-form woocommerce-form-register register form-group" <?php do_action('woocommerce_register_form_tag');?>>
			<label for="username" class="d-none">Nome de usuário</label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control py-2 my-3" name="username" id="reg_username" placeholder="Escolha seu nome de usuário" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : '';?>"/>
			<label for="email" class="d-none">E-mail</label>
			<input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control py-2 my-3" name="email" id="reg_email" placeholder="Digite seu e-mail" autocomplete="email" value="<?php echo (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : '';?>"/>
			<label for="password" class="d-none">Escolha uma senha</label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control py-2 my-3" placeholder="Escolha uma senha" name="password" id="reg_password" autocomplete="new-password"/>
			<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce');?>
			<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn btn-info py-2 mt-2" name="register" value="<?php esc_attr_e('Register', 'woocommerce');?>">Cadastrar minha conta</button>
		</form>
	</div>
	<div class="col-md-2"></div>
</div>
