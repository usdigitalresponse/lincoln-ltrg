<?php
/**
 * Add Jupiter Go to Top popup and tabs to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.20.0
 */

$popups = [
	'go_to_top' => __( 'Go to Top', 'jupiterx-core' ),
];

// Popup.
JupiterX_Customizer::add_section( 'jupiterx_go_to_top', [
	'panel'  => 'jupiterx_elements',
	'title'    => __( 'Go to Top', 'jupiterx-core' ),
	'type'     => 'popup',
	'priority' => 300,
	'tabs'     => [
		'settings' => __( 'Settings', 'jupiterx-core' ),
		'styles'   => __( 'Styles', 'jupiterx-core' ),
	],
	'popups'   => $popups,
	'preview' => true,
] );

// Styles tab.
JupiterX_Customizer::add_section( 'jupiterx_go_to_top_styles', [
	'popup' => 'jupiterx_go_to_top',
	'type'  => 'pane',
	'pane'  => [
		'type' => 'tab',
		'id'   => 'styles',
	],
] );

// Fonts tab.
JupiterX_Customizer::add_section( 'jupiterx_go_to_top_settings', [
	'popup' => 'jupiterx_go_to_top',
	'type'  => 'pane',
	'pane'  => [
		'type' => 'tab',
		'id'   => 'settings',
	],
] );

// Load all the settings.
foreach ( glob( dirname( __FILE__ ) . '/*.php' ) as $setting ) {
	require_once $setting;
}
