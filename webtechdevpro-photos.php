<?php
/*
Plugin Name: Webtechdevpro Multi Dimension photos
Description: Upload photos and resize them into multiple dimensions, and show them using shortcode.
Version: 1.0
Author: Webtechdevpro
License: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once 'post-types/webtechdevpro-post-types.php';

class Webtechdevpro_Photos {

	public function __construct() {

		$webtechdevpro_post_types = new Webtechdevpro_Post_Types();
	}

	public static function activate() {


	}
}

register_activation_hook(__FILE__, array('Webtechdevpro_Photos', 'activate'));
$webtechdevpro_photos = new Webtechdevpro_Photos();
