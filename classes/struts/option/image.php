<?php

class Struts_Option_Image extends Struts_Option {

	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );
		$value = esc_attr( $this->value() );

		echo "<input type='text' id='$id' name='$name' value='$value' class='image-input' />";
		echo "<input type='button' id='{$id}_button' value='" . esc_attr( __( 'Upload Image', 'struts' ) ) . "' data-type='image' data-field-id='$id' class='button struts-image-upload'>";
	}

	protected function standard_validation( $value ) {
		$value = esc_url_raw( $value );

		return trim( $value );
	}

	protected function add_customizer_control( $wp_customize, $setting_name, $priority ) {
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $this->name(), $this->customizer_control_options( $setting_name, $priority ) ) );
	}
}