<?php

class Struts_Option_Select extends Struts_Option {
	public function input_html() {
		$id = $this->html_id();
		$name = $this->html_name();

		$output = "<select id='$id' name='$name'>";

		foreach ( $this->valid_values() as $value => $text ) {
			// If this value is selected, mark it so
			$selected = selected( $this->value(), $value, false );

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
}