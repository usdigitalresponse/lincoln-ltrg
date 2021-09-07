<?php
/**
 * Dynamic styles.
 *
 * @package JupiterX_Core\Raven
 * @since 1.20.0
 */

namespace JupiterX_Core\Raven\Core\Dynamic_Styles;

use Elementor\Core\Responsive\Responsive;

defined( 'ABSPATH' ) || die();

/**
 * Dynamic styles.
 *
 * Dynamic styles module handler class is responsible for generating dynamic
 * styles based on Elementor breakpoints.
 *
 * @since 1.20.0
 */
class Module {

	private $styles = [];

	/**
	 * Constructor.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'compile' ] );
	}

	/**
	 * Compiler and enqueue the styles.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	public function compile() {
		if ( ! function_exists( 'jupiterx_compile_css_fragments' ) ) {
			return;
		}

		$this->register();
		$this->parse();

		jupiterx_compile_css_fragments(
			'jupiterx-elements-dynamic-styles',
			apply_filters( 'jupiterx-elements-dynamic-css', $this->styles )
		);
	}

	/**
	 * Register the style files.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	private function register() {
		$rtl = is_rtl() ? '-rtl' : '';

		$styles = [
			"/includes/extensions/raven/assets/css/dynamic-styles{$rtl}.min.css",
		];

		foreach ( $styles as $style ) {
			$style = jupiterx_core()->plugin_dir() . $style;

			if ( ! file_exists( $style ) ) {
				continue;
			}

			// phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$this->styles[] = file_get_contents( $style );
		}
	}

	/**
	 * Parse the style to replace the Elementor breakpoints.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	private function parse() {
		$breakpoints      = Responsive::get_breakpoints();
		$breakpoints_keys = array_keys( $breakpoints );

		$this->styles = preg_replace_callback( '/ELEMENTOR_SCREEN_([A-Z]+)_([A-Z]+)/', function ( $placeholder_data ) use ( $breakpoints_keys, $breakpoints ) {
			$breakpoint_index = array_search( strtolower( $placeholder_data[1] ), $breakpoints_keys, true );

			$is_max_point = 'MAX' === $placeholder_data[2];

			if ( $is_max_point ) {
				$breakpoint_index++;
			}

			$value = $breakpoints[ $breakpoints_keys[ $breakpoint_index ] ];

			if ( $is_max_point ) {
				$value--;
			}

			return $value . 'px';
		}, $this->styles );
	}
}
