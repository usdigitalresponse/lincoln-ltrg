<?php
/**
 * Add Jupiter settings for Go To Top > Settings tab to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.20.0
 */

$section = 'jupiterx_go_to_top_settings';

// Enable Scroll top button.
JupiterX_Customizer::add_field( [
	'type'     => 'jupiterx-toggle',
	'settings' => 'jupiterx_site_scroll_top',
	'section'  => $section,
	'css_var'  => 'site-scroll-top',
	'label'    => __( 'Go to Top', 'jupiterx-core' ),
	'column'   => '6',
	'default'  => true,
] );
