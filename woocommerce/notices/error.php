<?php
/**
 * 
 * Mostra eventuais erros
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if(! $notices):
	return;
endif;?>

<ul class="woocommerce-error" role="alert">
	<?php foreach($notices as $notice):?>
		<li <?php echo wc_get_notice_data_attr($notice);?>>
			<?php echo wc_kses_notice($notice['notice']);?>
		</li>
	<?php endforeach;?>
</ul>
