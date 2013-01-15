<div id="struts-options" class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2><?php echo $options->menu_label(); ?></h2>
	<div id="struts-options" class="wrap">
		<div id="struts-options-body">
			<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
				<div class="updated"><p><?php _e( 'Settings updated successfully.', 'struts' ); ?></p></div>
			<?php endif; ?>
			<form action="options.php" method="post">
				<?php settings_fields( $options->name() ); ?>
				<?php foreach ( $options->sections() as $section ) : ?>
					<div id="<?php esc_attr_e( $section->id() ); ?>" class="struts-section">
						<h3><?php echo esc_html( $section->title() ); ?> <a href="#"><?php _e( 'Edit', 'struts' ); ?></a></h3>
						<div class="struts-section-body clear">
							<?php
								foreach ( $section->options() as $option ) {
									$option->to_html();
								}
							?>
							<div class="struts-save-button submit">
								<input type="submit" class="button-primary struts-save-button" value="<?php esc_attr_e( __( 'Save changes', 'struts' ) ); ?>" />
								<?php do_action( 'struts_after_' . $section->id() . '_submit' ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<?php
					foreach ( $options->stranded_options() as $option ) {
						$option->to_html();
					}
				?>
				<div class="struts-buttons-container">
					<input name="<?php echo $options->name(); ?>[struts_submit]" type="submit" class="button-primary struts-save-button" value="<?php esc_attr_e( 'Save Settings', 'struts' ); ?>" />
					<input name="<?php echo $options->name(); ?>[struts_reset]" type="submit" class="button-secondary struts-reset-button" value="<?php esc_attr_e( 'Reset Defaults', 'struts' ); ?>" onclick="return confirm('Click OK if you want to reset your theme options to the defaults.')" />
				</div>
			</form>
		</div>
	</div>
</div>