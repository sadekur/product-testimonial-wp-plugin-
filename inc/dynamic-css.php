<?php
/*
*	Dynamic Css value
*/
function add_dynamic_css_cwpt() { ?>
	<style type="text/css" media="all">
        .testimonial .name{
            color: <?php $rating_bg_color = get_option( 'rating-color-option', true ); if(!empty($rating_bg_color)) {echo esc_attr( $rating_bg_color );} else {echo _e( "#EABD44" );}?>;
        }
    .testimonial .title, .testimonial .post{
     color: <?php $color_theme = get_option( 'title-color-option', true ); if(!empty($color_theme)) { echo esc_attr( $color_theme );} else {echo _e( "#EABD44" );}?>;

    }
    .testimonial .testimonial-content:after, .testimonial:hover .pic, .owl-theme .owl-controls .owl-buttons div:hover{
     background: <?php $hover_color = get_option( 'hover-color-option', true ); if(!empty($hover_color)) { echo esc_attr( $hover_color ); } else {echo _e( "#1d3033" ); }?>;

    }  
    .testimonial .rating{
     background: <?php $rating_bg_color = get_option( 'rating-color-option', true ); if(!empty($rating_bg_color)) {echo esc_attr( $rating_bg_color );} else {echo _e( "#EABD44" );}?>;

    } 
    .testimonial .rating li{
     color: <?php $color_theme = get_option( 'title-color-option', true ); if(!empty($color_theme)) {echo esc_attr( $color_theme );} else {echo _e( "#EABD44" );}?>;

    }
 </style>
<?php 
}
add_action( 'wp_head', 'add_dynamic_css_cwpt' );
