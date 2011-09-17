<?php

class Settings_Option_Select extends Settings_Option {
	public function to_html() {
		$id = $this->parent_name() . '-' . $this->name();
		$name = $this->parent_name() . '[' . $this->name() . ']';

		$output = "<label for='$id'>" . $this->label() . "</label>";
		$output .= "<select id='$id' name='$name'>";

		foreach ( $this->valid_values() as $value => $text ) {
			$output .= '<option value="' . $value . '" ' . selected( $this->value(), $value, false ) . '>' . $text . '</option>';
		}

		$output .= '</select>';

		return $output;
	}
}