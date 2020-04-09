<?php
/**
 * 
 * Tratamento dos itens
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>

<dl class="variation">
	<?php foreach ($item_data as $data):?>
		<dt class="<?php echo sanitize_html_class('variation-' . $data['key']);?>"><?php echo wp_kses_post($data['key']);?>:</dt>
		<dd class="<?php echo sanitize_html_class('variation-' . $data['key']);?>"><?php echo wp_kses_post(wpautop( $data['display']));?></dd>
	<?php endforeach;?>
</dl>
