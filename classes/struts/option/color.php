<?php

class Struts_Option_Color extends Struts_Option {

	public function input_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$default_value = $this->default_value() ? $this->default_value() : '#FFFFFF';
		$value = $this->value() ? $this->value() : $this->default_value();
		$value = esc_attr( $value );

		echo "<div id='{$id}-color-chooser' class='struts-color-chooser' data-field-id='$id'></div>";
		echo "<input type='text' id='$id' name='$name' value='$value' class='struts-color-chooser-input' />";
	}

	protected function standard_validation( $value ) {
		// Color must be in hex format
		if ( '#' !== substr( $value, 0, 1 ) || ! ctype_xdigit( substr( $value, 1 ) ) ) {
			return $this->default_value();
		}

		return $value;
	}

	protected function label_html() {
		if ( $this->label() ) {
			echo "<label class='struts-label' for='{$this->html_id()}'>{$this->label()} ";
			echo '<a href="#" class="struts-color-chooser-toggle">' . __( 'show color picker' ) . '</a>';
			echo "</label>";
		}
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
}