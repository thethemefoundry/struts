<?php

class Settings_Option_Text extends Settings_Option {
	public function to_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$value = $this->value();

		echo "<input type='text' id='$id' name='$name' value='$value' />";
	}
}