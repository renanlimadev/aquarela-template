<?php
/**
 * 
 * Auth for grant access
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

do_action('woocommerce_auth_page_header');?>

<h1>
	<?php
		/* Translators: %s App name. */
		printf(esc_html__('%s would like to connect to your store', 'woocommerce'), esc_html($app_name));
	?>
</h1>

<?php wc_print_notices();?>

<p>
	<?php
	/* Translators: %1$s App name, %2$s scope. */
	printf( esc_html__('This will give "%1$s" %2$s access which will allow it to:', 'woocommerce'), '<strong>' . esc_html($app_name) . '</strong>', '<strong>' . esc_html($scope) . '</strong>');?>
</p>

<ul class="wc-auth-permissions">
	<?php foreach ($permissions as $permission):?>
		<li><?php echo esc_html($permission);?></li>
	<?php endforeach; ?>
</ul>

<div class="wc-auth-logged-in-as">
	<?php echo get_avatar($user->ID, 70);?>
	<p>
		<?php
		/* Translators: %s display name. */
		printf(esc_html__('Logged in as %s', 'woocommerce'), esc_html($user->display_name));?>
		<a href="<?php echo esc_url($logout_url);?>" class="wc-auth-logout"><?php esc_html_e('Logout', 'woocommerce');?></a>
</div>

<p class="wc-auth-actions">
	<a href="<?php echo esc_url($granted_url);?>" class="button button-primary wc-auth-approve"><?php esc_html_e('Approve', 'woocommerce');?></a>
	<a href="<?php echo esc_url($return_url);?>" class="button wc-auth-deny"><?php esc_html_e('Deny', 'woocommerce');?></a>
</p>

<?php do_action('woocommerce_auth_page_footer');
