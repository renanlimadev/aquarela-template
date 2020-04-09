<?php
/**
 * 
 * Mostra mensagens
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if(! $notices):
	return;
endif;?>

<?php foreach($notices as $notice):?>
	<div class="woocommerce-info"<?php echo wc_get_notice_data_attr($notice);?>>
		<?php echo wc_kses_notice($notice['notice']);?>
	</div>
<?php endforeach;
