<?php 
/**
 * 
 * Formulário de login de usuário comun
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<form class="dropdown-menu px-2 py-2 form-login" method="post" aria-labelledby="dropdownMenuLink">
    <h4 class="dropdown-item login-text mb-1 font-weight-bold">Faça login</h4>
    <input type="email" class="dropdown-item aqua-login my-1" placeholder="E-mail"/>
    <input type="password" class="dropdown-item aqua-login my-1" placeholder="Senha"/>
    <div class="dropdown-item my-1">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"/><span class="text-white">Lembrar Dados</span>
    </div>
    <div class="text-center my-1">
        <a class="link-cadastro" target="_blank" href="#">Cadastre-se</a>
        <button type="submit" class="btn-login">Entrar</button>
    </div>
</form>
