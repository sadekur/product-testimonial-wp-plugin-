<?php
/**
 *
 * Add a submenu page under a custom post type parent.
 *  
 */
function cwpt_register_ref_page() {
    add_submenu_page(
         'edit.php?post_type=cwpt',
        __( 'Settings', 'cwpt' ),
        __( 'Settings', 'cwpt' ),
        'manage_options',
        'cwpt-setting-page',
        'cwpt_callback_func'
    );
}
 add_action('admin_menu', 'cwpt_register_ref_page');
/**
 * Display callback for the submenu page.
 */
function cwpt_callback_func() { 
	?>
	<div class="wrap">
		<div class="card card-second">
			<div class="card-body">
				<div class="clrFix"></div>
				<h3><?php _e( 'About the Author', 'cwpt' ) ?></h3>
				<p>My Development Skill:
					<li>Design or customize any type of wordpress cms for exm: a Blog, E-Commerce, Personal site.</li>
					<li>Develop Wordpress Simple Plugin.</li>
					<li>Can assurance qualities of any type of Wordpress plugins or wordpress Theme.</li>
					<li>I have already written a lot of content for the WordPress blog so I have fully experience about it. </li>
					<a href="https://www.linkedin.com/in/sadekur-rahman-b06208165/">If You Hire</a>.<br />
					<strong>Twetter:</strong> <a href="https://twitter.com/rahman_shadekur">Sadekur Rahman</a><br />
					<strong>Skype:</strong> sadekur.rahman1<br />
					<strong>Email:</strong> shadekur.rahman@gmail.com<br/>
					
					<strong>Hire Me on:</strong> <a href="https://www.linkedin.com/in/sadekur-rahman-b06208165/" target="_blank">Linkedin</a><br />
					<div class="clrFix"></div>
				</div>
			</div>
			<h1>
				<?php echo esc_attr(__('Testimonial Settings')); ?>
			</h1>
			<div class="card">
				<div class="card-body">
					<form action="" id="pt_form" class="" method="POST">
						<div class="main-form mt-3 border-bottom">
							<input type="hidden" name="action" value="action-value">
							<?php 
							$get_title_color_option = get_option( 'title-color-option', true );
							$get_hover_color_option = get_option( 'hover-color-option', true );
							$get_rating_color_option = get_option( 'rating-color-option', true );
							?>
							<div class="form-group">
								<label for=""><?php echo esc_attr(__('Title Color:')); ?></label>
								<input type="text" name="title_color" value="<?php echo esc_attr($get_title_color_option); ?>" class="color-picker" placeholder="Enter Color">
								<label for=""><?php echo esc_attr(__('Hover Color:')); ?></label>
								<input type="color" name="hover_color" value="<?php echo esc_attr($get_hover_color_option); ?>" class="" placeholder="Enter Color">
								<label for=""><?php echo esc_attr(__('Rating Color:')); ?></label>
								<input type="color" name="rating_color" value="<?php echo esc_attr($get_rating_color_option); ?>" class="rating-color" placeholder="Rating Color">

							</div>
							<div class="paste-new-forms"></div>
							<!-- <input type="submit" value="<?php _e('Save Change', 'pt'); ?>"> -->
							<?php
							submit_button();
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
function cwpt_ajax_val() {
	/*$title_color 	= isset( $_POST['title_color'] )? $_POST['title_color']: '';
	$hover_color 	= isset( $_POST['hover_color'] )? $_POST['hover_color']: '';*/

	$sanitize_title_color = sanitize_text_field( $_POST['title_color']);
	$sanitize_hover_color = sanitize_text_field( $_POST['hover_color']);
	$rating_color 		  = sanitize_text_field( $_POST['rating_color']);

	update_option( 'title-color-option', $sanitize_title_color );
	update_option( 'hover-color-option', $sanitize_hover_color );
	update_option( 'rating-color-option', $rating_color );
	wp_send_json( "Data Saved" );
}
add_action( 'wp_ajax_action-value', 'cwpt_ajax_val' );

	/*
	*	Get all options value
	*/
$get_title_color_option  = get_option( 'title-color-option', true );
$get_hover_color_option  = get_option( 'hover-color-option', true );
$get_rating_color_option = get_option( 'rating-color-option', true );


