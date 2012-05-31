<?php

class Struts_Option_Checkbox extends Struts_Option {

	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );
		$checked = $this->value() ? "checked='checked' " : '';

		echo "<input type='checkbox' id='$id' name='$name' value='1' $checked/>";
	}

	public function value( $value = NULL ) {
		if ( NULL === $value ) {
			return (boolean) $this->_value;
		}

		$this->_value = (boolean) $value;
		return $this;
	}

	protected function standard_validation( $value ) {
		return (boolean) $value;
	}

	protected function base_html() {
		$this->description_html();
		$this->input_html();
		echo " ";
		if ( Struts::config( 'use_struts_skin' ) ) { $this->label_html(); }
	}

	protected function customizer_control_options( $setting_name, $priority = 1000 ) {
		return array_merge(
			parent::customizer_control_options( $setting_name, $priority ),
			array(
				'type' => 'checkbox'
			)
		);
	}
}