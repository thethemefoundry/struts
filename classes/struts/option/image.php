<?php

class Struts_Option_Image extends Struts_Option {

	public function to_html() {
		$id = $this->html_id();
		$name = $this->html_name();
		$value = $this->value();

		echo "<input type='text' id='$id' name='$name' value='$value' />";
		echo "<input type='button' id='{$id}_button' value='Upload' data-type='image' data-field-id='$id' class='button struts-image-upload'>";
		echo "<div id='{$id}-preview' class='image-upload-preview'>";
		if ( $value ) { echo "<img src='$value'>"; }
		echo "</div>";
		echo $this->description_html();
	}

	protected function standard_validation( $value ) {
		return $value;
	}
}