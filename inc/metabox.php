<?php
/*
*	Add Meta Box
*/
function cwpt_meta_box() {
	add_meta_box(
		'cwpt-meta-box-id',
		esc_html__( 'CWPT MetaBox', 'cwpt' ),
		'cwpt_meta_box_callback',
		('cwpt')
	);
}
add_action( 'admin_menu', 'cwpt_meta_box' );

function cwpt_meta_box_callback($post){
	$cwpt_get_name 		  = get_post_meta( get_the_ID(), 'testmonial_name', true );
	$cwpt_get_designation = get_post_meta( get_the_ID(), 'test_designation', true );
	$cwpt_get_rating	  = get_post_meta( get_the_ID(), 'testmonial_rating', true );
	?>
	<label><?php echo esc_attr('Testimonial Name', 'cwpt') ?></label>
	<input style= width:15%; type="text" name="testmonial_name" id="testmonial_name" value="<?php echo esc_attr($cwpt_get_name ); ?>">
	<label><?php echo esc_attr('Testimonial Designation', 'cwpt') ?></label>
	<input style= width:15%; type="text" name="test_designation" id="test_designation" value="<?php echo esc_attr($cwpt_get_designation ); ?>">
	<label><?php echo esc_attr('Testimonial Rating', 'cwpt') ?></label>
	<input style= width:10%; type="text" name="testmonial_rating" id="testmonial_rating" value="<?php echo esc_attr( $cwpt_get_rating ); ?>">
	<?php
}
function cwpt_post_save($post_id){
	$set_name = isset($_POST['testmonial_name'])? sanitize_text_field( $_POST['testmonial_name']) : '';
	$set_designation = isset($_POST['test_designation'])? sanitize_text_field( $_POST['test_designation']): '';
	$set_rating = isset($_POST['testmonial_rating'])? sanitize_text_field( $_POST['testmonial_rating']): '';

	update_post_meta( get_the_ID(), 'testmonial_name',  $set_name);
	update_post_meta( get_the_ID(), 'test_designation',  $set_designation);
	update_post_meta( get_the_ID(), 'testmonial_rating',  $set_rating);

	/*$sanitize_testi_name = sanitize_text_field( $_POST['testmonial_name']);
	$sanitize_testi_desig = sanitize_text_field( $_POST['test_designation']);
	$sanitize_testi_rating = sanitize_text_field( $_POST['testmonial_rating']);*/
} 
add_action('save_post', 'cwpt_post_save');