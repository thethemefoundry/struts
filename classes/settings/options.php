<?php

class Settings_Options {
	protected $_options, $_option_name, $_slug;

	public function __construct( $slug, $option_name ) {
		$this->options( array() );
		$this->option_name( $option_name );
		$this->slug( $slug );
	}

	public function add_option( $name, $type ) {
		$option_class = 'Settings_Option_' . ucfirst( $type );

		$option = new $option_class;
		$option->name( $name );
		$option->parent_name( $this->option_name() );

		$this->_options[] = $option;

		return $option;
	}

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

	public function option_name( $option_name = NULL ) {
		if ( NULL === $option_name )
			return $this->_option_name;

		$this->_option_name = $option_name;

		return $this;
	}

	public function initialize() {
		$option_values = get_option( $this->option_name() );

		if ( false === $option_values || empty( $option_values ) ) {
			$option_values = $this->defaults();
		}
		update_option( $this->option_name(), $option_values );

		foreach ( $option_values as $name => $value ) {
			foreach ( $this->_options as $option ) {
				if ( $option->name() == $name ){
					$option->value($value);
				}
			}
		}
	}

	public function defaults() {
		$defaults = array();

		$options = $this->options();

		foreach( $options as $option ) {
			$defaults[ $option->name() ] = $option->value();
		}

		return $defaults;
	}

	public function form_html() { ?>
		 <div class="wrap">
			<?php echo $this->settings_updated_html(); ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( $this->option_name() );
				echo $this->options_html();
				?>
				<input type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'react'); ?>" />
				<input type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'react'); ?>" />
			</form>
		</div>
	<?php }

	public function options_html() {
		$output = "";
		$options = $this->options();

		foreach ( $options as $option ) {
			$output .= $option->to_html();
		}
		return $output;
	}

	public function settings_updated_html() {
		if ( isset( $_GET['settings-updated'] ) )
			return "<div class='updated'><p>Theme settings updated successfully.</p></div>";
	}

	public function register() {
		register_setting( $this->option_name(), $this->option_name(), array( &$this, 'validate' ) );
	}

	//TODO: Actually validate input
	public function validate( $input ) {
		return $input;
	}

	public function setup() {
		$this->initialize();

		// Load the Admin Options page
		add_action( 'admin_menu', array( &$this, 'add_options_page' ) );
		add_action( 'admin_init', array( &$this, 'register' ) );
	}

	function add_options_page() {
		add_theme_page(
			'Theme Options',
			'Theme Options',
			'edit_theme_options',
			$this->slug() . '-settings',
			array( &$this, 'form_html' ) );
	}
}