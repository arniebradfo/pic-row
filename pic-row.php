<?php
/**
 * @package Picture_Row
 * @version 0.1
 */
/*
Plugin Name: Picture Row
Plugin URI: http://codepen.io/arniebradfo/pen/fwmLq
Description: adds js and short codes for fitting images into a row.
Author: Arnie Bradfo
Version: 0.1
Author URI: 
*/


// // I don't think Im actually going to use this...

// function get_waitforimages() {
// 	wp_enqueue_script(
// 		'waitforimages',
// 		plugins_url( '/js/jquery.waitForImages.js', __FILE__ ),
// 		//dirname( __FILE__ ) . '/js/jquery.waitForImages.js',
// 		array( 'jquery' )
// 	);
// 	wp_enqueue_script('waitforimages');
// }
// add_action('wp_enqueue_scripts', 'get_waitforimages');

function get_picrow() {
	wp_register_script(
		'picrowjq',
		plugins_url( '/js/jquery.picRow.js', __FILE__ ),
		array(
			'jquery'
			//,'waitforimages' 
		)
	);
	wp_enqueue_script('picrowjq');
}
add_action('wp_enqueue_scripts', 'get_picrow');

function picrow_div_shortcode($atts) {
    extract( shortcode_atts( array(
        'tagtype' => '0',
    ), $atts,'picrow') );
    $tagcontents = null;
    if ($tagtype == 'open') {
    	$tagcontents = 'div class="pic-row clearfix"';
    }elseif ($tagtype == 'close') {
    	$tagcontents = '/div';
    }
	return '<'. $tagcontents .'>';
}
add_shortcode( 'picrow', 'picrow_div_shortcode' );
// shortcode example: [picrow tagtype='open']

?>