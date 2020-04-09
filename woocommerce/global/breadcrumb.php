<?php
/**
 * 
 * Migalhas para a loja
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

if(! empty($breadcrumb)):

	echo $wrap_before;

	foreach($breadcrumb as $key => $crumb):

		echo $before;

		if(! empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1):
			echo '<a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
		else:
			echo esc_html($crumb[0]);
		endif;

		echo $after;

		if(sizeof($breadcrumb) !== $key + 1):
			echo $delimiter;
		endif;
	endforeach;

	echo $wrap_after;
endif;
