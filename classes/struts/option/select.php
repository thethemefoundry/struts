<?php

class Struts_Option_Select extends Struts_Option {
	public function input_html() {
		$id = esc_attr( $this->html_id() );
		$name = esc_attr( $this->html_name() );

		$output = "<select id='$id' name='$name'>";

		foreach ( $this->valid_values() as $value => $text ) {
			// If this value is selected, mark it so
			$selected = selected( $this->value(), $value, false );

			$value = esc_attr( $value );

			$output .= "<option value='$value' $selected >$text</option>";
		}

		$output .= "</select>";

		echo $output;
	}

	protected function standard_validation( $value ) {
		$valid_values = $this->valid_values();
		if ( array_key_exists( $value, $valid_values ) ) {
			return $value;
		}

		return $this->default_value();
	}

	protected function customizer_control_options( $setting_name, $priority = 1000 ) {
		return array_merge(
			parent::customizer_control_options( $setting_name, $priority ),
			array(
				'type' => 'radio',
				'choices' => $this->valid_values()
			)
		);
	}
}