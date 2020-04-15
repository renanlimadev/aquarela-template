<?php
/**
 * 
 * Dashboard para clientes
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
<h1 class="main-title text-center py-3">Olá, <?php echo esc_html($current_user->display_name);?><a class="" href="<?php echo esc_url(wc_logout_url());?>"></a></h1>
<h2 class=" text-muted text-center pb-3">No painel da sua conta, você pode ver seus <a class="btn btn-link" href="<?php echo esc_url(wc_get_endpoint_url('orders'));?>" target="_blank">pedidos recentes</a>, gerenciar seus <a class="btn btn-link" href="<?php echo esc_url(wc_get_endpoint_url('edit-address'));?>" target="_blank">endereços de entrega</a> e <a class="btn btn-link" href="<?php echo esc_url(wc_get_endpoint_url('edit-account'));?>">editar a sua senha e os detalhes da sua conta</a></h2>

<?php do_action('woocommerce_account_dashboard');
