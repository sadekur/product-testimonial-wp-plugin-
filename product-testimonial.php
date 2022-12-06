<?php
/*
Plugin Name: Product Testimonial
Plugin URI: https://wordpress.org/plugins/custom-wordpress-testimonial/
Description: WP Product Testimonial 
Version: 0.1.1
Author: Sadekur Rahman
Author URI: 
License: GPLv2 or later
Text Domain: cwpt
*/
ob_start();
session_start();

define('cwpt_plugin_directory_path', plugin_dir_path(__FILE__));
/*
*	
*	Assets for front end
*
*/
function cwpt_scripts() {
/*
*	CSS
*/
	wp_enqueue_style( 'cwpt-carousel', plugins_url ( 'css/cwpt.carousel.min.css', __FILE__), '', time(), false );
	wp_enqueue_style( 'cwpt-theme', plugins_url ( 'css/cwpt.theme.min.css', __FILE__), '', time(), false );
	//wp_enqueue_style( 'wpt-fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', time(), false );
	wp_enqueue_style( 'cwpt-fontawesome', plugins_url ( 'css/all.css', __FILE__), '', time(), false );
	wp_enqueue_style( 'cwpt-style', plugins_url ( 'css/cwpt-product-testimonial.css', __FILE__), '', time(), false );
/*
*	JS
*/
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cwpt-carousel', plugins_url ( 'js/cwpt.carousel.min.js', __FILE__), '', time(), true );
	wp_enqueue_script( 'cwpt-script', plugins_url ( 'js/cwpt-product-testimonial.js', __FILE__), '', time(), true );
}
add_action( 'wp_enqueue_scripts', 'cwpt_scripts' );
/*
*	Assets for back end
*
*/
function cwpt_script_admin(){
/*
*	CSS
*/
	wp_enqueue_style( 'cwpt-admin', plugins_url ( 'css/cwpt-product-testimonial-admin.css', __FILE__), '', time(), false );

/*
*	JS
*/	
	wp_enqueue_script( 'cwpt-wpnhtp', plugins_url ( 'js/cwpt-wpnhtp.js', __FILE__), '', time(), true );
	wp_enqueue_script( 'iris', plugins_url ( 'js/iris.min.js', __FILE__), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
	wp_enqueue_script( 'cwpt-cp-active', plugins_url ( 'js/cwpt-cp-active.js', __FILE__), '', time(), true );
	wp_enqueue_script( 'cwpt-admin-js', plugins_url ( 'js/cwpt-admin-product-testimonial.js', __FILE__), '', time(), true );
	wp_localize_script( 'cwpt-admin-js', 'WPPT', [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
}
add_action( 'admin_enqueue_scripts', 'cwpt_script_admin' );

function cwpt_register_testimonial() {
/**
* 	Post Type: WP Product Testimonials.
*/
	$labels = [
		"name" => __( "Product Testimonial", "cwpt" ),
		"singular_name" => __( "Product Testimonial", "cwpt" ),
		"menu_name" => __( "Product Testimonial", "cwpt" ),
		"all_items" => __( "All Testimonial", "cwpt" ),
		"add_new" => __( "Add New Testimonial", "cwpt" ),
		"add_new_item" => __( "Add New Testimonial", "cwpt" ),
		"edit_item" => __( "Edit Testimonial", "cwpt" ),
		"new_item" => __( "New Testimonial", "cwpt" ),
		"view_item" => __( "View Testimonial", "cwpt" ),
		"view_items" => __( "View All Testimonial", "cwpt" ),
		"search_items" => __( "Search Testimonial", "cwpt" ),
		"not_found" => __( "Not Testimonial Found", "cwpt" ),
		"not_found_in_trash" => __( "No Testimonial Found in Trush", "cwpt" ),
		"featured_image" => __( "Client Image", "cwpt" ),
		"set_featured_image" => __( "Client Image", "cwpt" ),
		"remove_featured_image" => __( "Remove client image", "cwpt" ),
		"archives" => __( "Testimonial archives", "cwpt" ),
		"insert_into_item" => __( "Insert into Testimonial", "cwpt" ),
		"filter_items_list" => __( "Filter Testimonial List", "cwpt" ),
		"items_list_navigation" => __( "Testimonial list navigation", "cwpt" ),
		"items_list" => __( "Testimonial list", "cwpt" ),
		"item_reverted_to_draft" => __( "Testimonial reverted to draft", "cwpt" ),
	];

	$args = [
		"label" => __( "Custom WP Testimonial", "cwpt" ),
		"labels" => $labels,
		"description" => "Custom WP Testimonial for your Business.",
		"public" => true,
		'menu_icon' =>'dashicons-testimonial',
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "product-testimonial", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "cwpt", $args );
}

add_action( 'init', 'cwpt_register_testimonial' );
/*
*
*	Main Function
*
*
*/
function cwpt_loop() { ?>
	<div id="testimonial-slider" class="owl-carousel">
		<?php
		$args = array(
			'post_type' => 'cwpt',
			'order'     => 'ASC',
			'posts_per_page' => -1,
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				remove_filter('the_excerpt', 'wpautop');/*remove the_excerpt function's extra <p>..</p>*/
				?>
				<div class="testimonial">
					<div class="pic">
						<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'full' ); ?>" alt="<?php the_title(); ?>">
					</div>
					<h3 class="title"><?php the_title(); ?></h3>
					<p class="description"><?php the_excerpt(); ?></p>
					<div class="testimonial-content">
						<div class="testimonial-profile">
							<h3 class="name"><?php echo get_post_meta( get_the_ID(), 'testmonial_name', true ); ?></h3>
							<span class="post"><?php echo get_post_meta( get_the_ID(), 'test_designation', true ); ?></span>
						</div>
						<?php
						$wpt_reating = get_post_meta( get_the_ID(), 'testmonial_rating', true );
						?>
						<!-- Reating dynamically show using condition -->
						<ul class = "rating">
							<?php
							if ($wpt_reating == 1){
								echo "<li class='far fa-star'></li>"; 
//<li class="fa fa-star-half-empty"></li>
							}elseif ($wpt_reating == 2) {
								echo "<li class='fa fa-star'></li><li class='fa fa-star'></li>" ; 
							}elseif ($wpt_reating == 3) {
								echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>" ; 
							}elseif ($wpt_reating == 4) {
								echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>" ; 
							}elseif ($wpt_reating == 5) {
								echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>" ; 
							}elseif ($wpt_reating == 1.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star-half-empty'></li>" ; 
							}elseif ($wpt_reating == 2.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'><li class='fas fa-star-half'></li>" ; 
							}elseif ($wpt_reating == 3.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'><li class='fas fa-star-half'></li>" ; 
							}elseif ($wpt_reating == 4.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'><li class='fas fa-star-half'></li>" ; 
							}else{
								echo "There is no Rating";
							}
							?>
						</ul>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		} ?>
	</div>
	<?php
}
/*Use Shortcode for main content*/
add_shortcode("WPTCODE", "cwpt_loop");
/*
*	Redirect Setting page When active plugins
*/
register_activation_hook(__FILE__, 'cwpt_plugin_activate');
add_action('admin_init', 'cwpt_plugin_redirect');

function cwpt_plugin_activate() {
	add_option('cwpt_plugin_do_activation_redirect', true);
}

function cwpt_plugin_redirect() {
	if (get_option('cwpt_plugin_do_activation_redirect', false)) {
		delete_option('cwpt_plugin_do_activation_redirect');
		if(!isset($_GET['activate-multi	']))
		{
			wp_redirect("edit.php?post_type=cwpt&page=cwpt-setting-page");
		}
	}
}

/*
*
*	Limite description length
*/
add_filter( 'get_the_excerpt', 'cwpt_excerpt' );
function cwpt_excerpt( $excerpt ) {
    return substr( $excerpt, 0, 50 ) . ' [..]';
}
/*
*inc/*.php files location
*/
/*glob(plugin_dir_path(__FILE__) . 'inc/*.php');
foreach ($file_paths as $path ) {
	include_once $path;
}*/
	foreach ( glob( plugin_dir_path( __FILE__ )."inc/*.php" ) as $php_file )
    include_once $php_file;

//require_once plugin_dir_path( __FILE__ ) . 'inc/functions.php';
