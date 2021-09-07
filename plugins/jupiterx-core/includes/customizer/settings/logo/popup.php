<?php
/**
 * Add Jupiter Logo options WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.0.0
 */

// Logos
JupiterX_Customizer::add_section( 'jupiterx_logo', [
	'title'  => __( 'Logos', 'jupiterx-core' ),
	'priority' => 40,
	'help'   => [
		'url'   => 'https://themes.artbees.net/docs/adding-multiple-versions-of-logo-to-website',
		'title' => __( 'Adding Multiple versions of logo to website', 'jupiterx-core' ),
	],
] );

// Load all the settings.
foreach ( glob( dirname( __FILE__ ) . '/*.php' ) as $setting ) {
	require_once $setting;
}
