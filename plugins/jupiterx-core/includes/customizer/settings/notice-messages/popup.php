<?php
/**
 * Add Jupiter Product Message Styles to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.0.0
 */

// Product page popup.
JupiterX_Customizer::add_section( 'jupiterx_notice_messages', [
	'panel'   => 'woocommerce',
	'title'   => __( 'Notice Messages', 'jupiterx-core' ),
	'type'    => 'popup',
	'tabs'    => [
		'styles' => __( 'Styles', 'jupiterx-core' ),
	],
	'preview' => true,
	'pro'     => true,
] );

// Styles tab.
JupiterX_Customizer::add_section( 'jupiterx_notice_messages_styles', [
	'popup' => 'jupiterx_notice_messages',
	'type'  => 'pane',
	'pane'  => [
		'type' => 'tab',
		'id'   => 'styles',
	],
] );

// Pro Box.
JupiterX_Customizer::add_field( [
	'type'     => 'jupiterx-pro-box',
	'settings' => 'jupiterx_notice_messages_styles_pro_box',
	'section'  => 'jupiterx_notice_messages',
] );

// Load all the settings.
foreach ( glob( dirname( __FILE__ ) . '/*.php' ) as $setting ) {
	require_once $setting;
}
