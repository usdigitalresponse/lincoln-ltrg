<?php
/**
 * Add Jupiter settings for Pages > 404 > Settings tab to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.0.0
 */

$section = 'jupiterx_404';

// Warning.
JupiterX_Customizer::add_field( [
	'type'            => 'jupiterx-alert',
	'settings'        => 'jupiterx_404_warning',
	'section'         => $section,
	'label'           => __( 'Set the selected 404 page to "Private" to hide the page from search engines. Setting to private, does not affect the 404 functionality.', 'jupiterx-core' ),
	'jupiterx_url'    => '',
] );

// Template.
JupiterX_Customizer::add_field( [
	'type'        => 'jupiterx-select',
	'settings'    => 'jupiterx_404_template',
	'section'     => $section,
	'label'       => __( 'Template', 'jupiterx-core' ),
	'column'      => 6,
	'default'     => '',
	'placeholder' => __( 'None', 'jupiterx-core' ),
	'transport'   => 'postMessage',
	'preview'     => true,
	'jupiterx'    => [
		'select2' => [
			'action'    => 'jupiterx_core_customizer_get_select2_options',
			'post_type' => 'page',
		],
	],
] );
