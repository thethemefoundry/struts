<?php

class Settings_Collection {
	protected $_options, $_name, $_slug;

	public function __construct( $slug, $name ) {
		$this->options( array() );
		$this->slug( $slug );
		$this->name( $name );
		$this->setup();
	}

	/***** Attribute accessors *****/

	public function options( $options = NULL ) {
		if ( NULL === $options )
			return $this->_options;

		$this->_options = $options;

		return $this;
	}

	public function slug( $slug = NULL ) {
		if ( NULL === $slug )
			return $this->_slug;

		$this->_slug = $slug;

		return $this;
	}

	public function name( $name = NULL ) {
		if ( NULL === $name )
			return $this->_name;

		$this->_name = $name;

		return $this;
	}

	/***** WordPress setup *****/

	public function setup() {
		add_action( 'after_setup_theme', array( &$this, 'initialize' ) );
		// Load the Admin Options page
		add_action( 'admin_menu', array( &$this, 'add_options_page' ) );
	}

	public function initialize() {
		$option_values = get_option( $this->name() );

		if ( false === $option_values || empty( $option_values ) ) {
			$option_values = $this->defaults();
		}
		update_option( $this->name(), $option_values );

		foreach ( $option_values as $name => $value ) {
			foreach ( $this->_options as $option ) {
				if ( $option->name() == $name ){
					$option->value($value);
				}
			}
		}
	}

	public function add_options_page() {
		add_theme_page(
			'Theme Options',
			'Theme Options',
			'edit_theme_options',
			$this->slug() . '-settings',
			array( &$this, 'echo_form_html' ) );
	}

	public function register() {
		register_setting( $this->name(), $this->name(), array( &$this, 'validate' ) );
		$this->register_options();
	}

	//TODO: Actually validate input
	public function validate( $input ) {
		return $input;
	}

	/**
	 *
	 */
	public function add_section( $id, $title, $description = '' ) {
		add_settings_section( $id, $title, array( &$this, 'description_html' ), $this->name() );
	}

	public function description_html() {
		echo "<p>Figure out how to handle description callbacks</p>";
	}

	public function register_options() {
		foreach( $this->options() as $option ) {
			$option->register();
		}
	}

	/**
	 * Adds an option with the given name and type to this collection
	 * Sets the option's parent_name to this collection's name, and returns the option
	 *
	 * @param $name - unique (within the collection ) name for this option
	 * @param $type - type of option (text/select/checkbox/etc)
	 * @param $section - name of the section this option goes in
	 *
	 * @return Settings_Option
	 */
	public function add_option( $name, $type, $section = NULL ) {
		$option_class = 'Settings_Option_' . ucfirst( $type );

		$option = new $option_class;
		$option->name( $name );
		$option->parent_name( $this->name() );
		$option->section( $section );

		$this->_options[] = $option;

		return $option;
	}

	/**
	 * Returns the default values of all options in this collection as a hash
	 *
	 * @return array
	 */
	public function defaults() {
		$defaults = array();

		$options = $this->options();

		foreach( $options as $option ) {
			$defaults[ $option->name() ] = $option->default_value();
		}

		return $defaults;
	}

	/***** HTML Output *****/

	public function echo_form_html() { ?>
		 <div class="wrap">
			<?php echo $this->settings_updated_html(); ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( $this->name() );
				do_settings_sections( $this->name() );
				?>
				<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'react'); ?>" />
				<input type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'react'); ?>" />
			</form>
		</div>
	<?php }

	public function settings_updated_html() {
		if ( isset( $_GET['settings-updated'] ) )
			return "<div class='updated'><p>Theme settings updated successfully.</p></div>";
	}
}

class SectionNotFoundException extends Exception { }