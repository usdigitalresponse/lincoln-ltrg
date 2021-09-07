<?php
/**
 * Handles image control class.
 *
 * @package JupiterX\Framework\API\Customizer
 *
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Image control class.
 *
 * @since 1.0.0
 * @ignore
 * @access private
 *
 * @package JupiterX\Framework\API\Customizer
 */
class JupiterX_Customizer_Control_Image extends JupiterX_Customizer_Base_Control {
	public $template_type = '';

	/**
	 * Control's type.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $type = 'jupiterx-image';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['templateType'] = $this->template_type ? $this->template_type : 'default';
	}

	/**
	 * An Underscore (JS) template for control wrapper.
	 *
	 * Use to create the control template.
	 *
	 * @since 1.0.0
	 */
	protected function control_template() {
		?>
		<div class="jupiterx-control jupiterx-image-upload-control {{ data.value ? 'has-image' : '' }} {{ data.templateType !== 'logo' ? 'jupiterx-image-control-default-template' : 'jupiterx-image-control-logo-template' }}">
			<div class="jupiterx-preview-image-control jupiterx-image-upload-control-add">
				<# if ( data.templateType !== 'logo' ) { #>
					<span class="jupiterx-image-upload-control-remove"><img src="<?php echo esc_url( JupiterX_Customizer_Utils::get_icon_url( 'x' ) ); ?>" alt="<?php esc_attr_e( 'Remove image icon', 'jupiterx-core' ); ?>" /></span>
				<# } #>
				<span class="jupiterx-image-upload-control-icon"><img src="<?php echo esc_url( JupiterX_Customizer_Utils::get_icon_url( 'upload' ) ); ?>" alt="<?php esc_attr_e( 'Upload image icon', 'jupiterx-core' ); ?>" /></span>

				<span class="jupiterx-image-upload-control-label"><?php esc_html_e( 'Click to Upload Image', 'jupiterx-core' ); ?></span>
				<img class="jupiterx-image-upload-control-preview" src="{{ data.value }}" />
				<input type="hidden" value="{{ data.value }}" {{{ data.link }}} />
			</div>
			<# if ( data.templateType === 'logo' ) { #>
				<div class="jupiterx-image-buttons">
					<button type="button" class="button jupiterx-image-upload-control-remove"><?php esc_html_e( 'Remove' ); ?></button>
					<button type="button" class="button jupiterx-image-upload-control-add"><?php esc_html_e( 'Change' ); ?></button>
				</div>
			<# } #>
		</div>
		<?php
	}
}
