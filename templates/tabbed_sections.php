<?php
	$sections = $options->sections();

	if ( isset( $_GET['section'] ) && isset( $sections[$_GET['section']] ) ) {
		$current_section = $sections[$_GET['section']];
	} else {
		$current_section = reset( $sections );
	}

	global $pagenow;

	// Current URL with only 'page' parameter
	$current_url = add_query_arg( 'page', $options->slug(), '/wp-admin/' . $pagenow );
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<?php foreach ( $sections as $section ) : ?>
			<?php $is_active = ( $current_section->id() === $section->id() ); ?>
			<a href="<?php echo esc_url( add_query_arg( 'section', $section->id(), $current_url ) ); ?>" class="nav-tab<?php echo $is_active ? ' nav-tab-active' : ''; ?>">
				<?php echo $section->title(); ?>
			</a>
		<?php endforeach; ?>
	</h2>
	<div class="wrap">
		<div>
			<form action="options.php" method="post">
				<input type="hidden" name="struts_section" value="<?php echo esc_attr( $current_section->id() ); ?>">
				<?php settings_fields( $options->name() ); ?>
				<h3><?php echo esc_html( $current_section->title() ); ?></h3>
				<div>
					<?php
						foreach ( $current_section->options() as $option ) {
							$option->to_html();
						}
					?>
				</div>
				<div class="struts-buttons-container">
					<input name="<?php echo $options->name(); ?>[struts_submit]" type="submit" class="button-primary struts-save-button" value="<?php esc_attr_e( 'Save Settings', 'struts' ); ?>" />
					<input name="<?php echo $options->name(); ?>[struts_reset]" type="submit" class="button-secondary struts-reset-button" value="<?php esc_attr_e( 'Reset Defaults', 'struts' ); ?>" onclick="return confirm('Click OK if you want to reset your theme options to the defaults.')" />
				</div>
			</form>
		</div>
	</div>
</div>