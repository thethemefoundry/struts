<?php

class Settings_Option_Select extends Settings_Option {
	public function to_html() {
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
}