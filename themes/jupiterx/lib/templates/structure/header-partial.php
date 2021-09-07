<?php
/**
 * Since WordPress force us to use the header.php name to open the document, we add a header-partial.php template for the actual header.
 *
 * @package JupiterX\Framework\Templates\Structure
 *
 * @since   1.0.0
 */

jupiterx_open_markup_e(
	'jupiterx_header',
	'header',
	[
		'class'                 => jupiterx_get_header_class(),
		'data-jupiterx-settings' => jupiterx_get_header_settings(),
		'role'                  => 'banner',
		'itemscope'             => 'itemscope',
		'itemtype'              => 'http://schema.org/WPHeader',
	]
);
	// Support Elementor theme location.
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		/**
		 * Fires in the header.
		 *
		 * @since 1.0.0
		 */
		do_action( 'jupiterx_header' . jupiterx_get_field_mod( 'jupiterx_header_type', 'global' ) );
	}

jupiterx_close_markup_e( 'jupiterx_header', 'header' );
