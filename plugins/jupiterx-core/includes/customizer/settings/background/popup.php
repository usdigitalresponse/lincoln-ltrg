<?php
/**
 * Add Jupiter Backgrounds popup and tabs to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.20.0
 */

$popups = [
	'body' => __( 'Body', 'jupiterx-core' ),
	'main' => __( 'Main', 'jupiterx-core' ),
];

// Popup.
JupiterX_Customizer::add_section( 'jupiterx_background', [
	'title'    => __( 'Backgrounds', 'jupiterx-core' ),
	'type'     => 'popup',
	'priority' => 140,
	'tabs'     => [
		'settings' => __( 'Settings', 'jupiterx-core' ),
	],
	'popups'   => $popups,
] );

// Fonts tab.
JupiterX_Customizer::add_section( 'jupiterx_background_settings', [
	'popup' => 'jupiterx_background',
	'type'  => 'pane',
	'pane'  => [
		'type' => 'tab',
		'id'   => 'settings',
	],
] );

// Styles tab > Child popups.
JupiterX_Customizer::add_field( [
	'type'     => 'jupiterx-child-popup',
	'settings' => 'jupiterx_background_styles_popups',
	'section'  => 'jupiterx_background_settings',
	'target'   => 'jupiterx_background',
	'choices'  => [
		'body' => __( 'Body Background', 'jupiterx-core' ),
		'main' => __( 'Main Content Background', 'jupiterx-core' ),
	],
] );

// Create popup children.
foreach ( $popups as $popup_id => $label ) {
	JupiterX_Customizer::add_section( 'jupiterx_background_' . $popup_id, [
		'popup' => 'jupiterx_background',
		'type'  => 'pane',
		'pane'  => [
			'type' => 'popup',
			'id'   => $popup_id,
		],
	] );
}

// Load all the settings.
foreach ( glob( dirname( __FILE__ ) . '/*.php' ) as $setting ) {
	require_once $setting;
}
