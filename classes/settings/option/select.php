<?php

class Settings_Option_Select extends Settings_Option {
	public function to_html() {
		$output = '<select name="' . $this->parent_name() . '[' . $this->name() . ']">';

		foreach ( $this->valid_values() as $value => $text ) {
			$output .= '<option value="' . $value . '" ' . selected( $this->value(), $value, false ) . '>' . $text . '</option>';
		}

		$output .= '</select>';

		return $output;
	}
}