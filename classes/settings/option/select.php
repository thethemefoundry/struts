<?php

class Settings_Option_Select extends Settings_Option {
	public function to_html() {
		$id = $this->parent_name() . '-' . $this->name();
		$name = $this->parent_name() . '[' . $this->name() . ']';
		$selected = selected( $this->value(), $value, false );

		$output = "<select id='$id' name='$name'>";

		foreach ( $this->valid_values() as $value => $text ) {
			$output .= "<option value='$value' $selected >$text</option>";
		}

		$output .= '</select>';

		echo $output;
	}
}