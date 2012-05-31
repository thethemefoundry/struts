<?php

class Struts_Option_Color extends Struts_Option {

	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );

		$default_value = $this->default_value() ? $this->default_value() : '#FFFFFF';
		$default_value = esc_attr( $default_value );

		$value = $this->value() ? $this->value() : $this->default_value();
		$value = esc_attr( $value );

		echo "<div id='{$id}-color-chooser' class='struts-color-chooser' data-field-id='$id'></div>";
		echo "<input type='text' id='$id' name='$name' value='$value' class='struts-color-chooser-input' />";
	}

	protected function standard_validation( $value ) {
		if ( '#' !== substr( $value, 0, 1 ) ) {
			$value = '#' . $value;
		}

		// Color must be in hex format
		if ( ! ctype_xdigit( substr( $value, 1 ) ) ) {
			return $this->default_value();
		}

		return $value;
	}

	protected function label_html() {
		if ( $this->label() ) {
			echo '<label class="struts-label" for="' . esc_attr( $this->html_id() ) . '">' . $this->label() . ' ';
			echo '<a href="#" class="struts-color-chooser-toggle">' . __( 'show color picker', 'struts' ) . '</a>';
			echo "</label>";
		}
	}

	/**
	 * The Theme Customizer stores color values without the pound sign. To ensure backwards
	 * compatibility, when retrieving the value, we append the pound sign if it doesn't exist.
	 */
	public function value( $value = NULL ) {
		if ( NULL === $value ) {
			$value = $this->_value;
			if ( '#' !== substr( $value, 0, 1 ) ) {
				$value = '#' . $value;
			}
			return $value;
		}

		$this->_value = $value;
		return $this;
	}

	/**
	* Farbtastic requires a value to be set to function properly.
	* We override the default_value function here to provide #FFFFFF as a default
	* in the case the user hasn't specified a default.
	*/
	public function default_value( $default_value = NULL ) {
		if ( NULL === $default_value ) {
			if ( NULL === $this->_default_value ) {
				return '#FFFFFF';
			} else {
				return $this->_default_value;
			}
		}

		$this->_default_value = $default_value;
		return $this;
	}

	protected function add_customizer_control( $wp_customize, $setting_name, $priority ) {
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $this->name(), $this->customizer_control_options( $setting_name, $priority ) ) );
	}
}