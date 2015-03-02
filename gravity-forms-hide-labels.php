<?php
/**
* Plugin Name: Gravity Forms Force Hide Labels
* Description: Enables the 'Hidden' label visibility option for Gravity Forms and enqueues the required CSS.
* Plugin URI: http://sennza.com.au
* Author: Sennza Pty Ltd, Bronson Quick, Tarei King, Lachlan MacPherson
* Author URI: http://sennza.com.au
* Version: 1.0
* License: GPL2
*/

/*
* 2015 Sennza Pty Limitd URI: http://www.sennza.com.au/ 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if ( ! defined( 'ABSPATH' ) ) exit;

class GF_Hide_Labels {

	private static $instance = null;

	public static function get_instance() {
		if ( ! isset( self::$instance ) )
			self::$instance = new self;

		return self::$instance;
	}

	private function __construct() {
		
		if ( ! class_exists( 'GFForms' ) && version_compare( GFForms::version, '1.9.0', '>' ) ) {
			return;
		}

		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	public function enqueue_scripts() {

		wp_enqueue_style( 'gf-force-hide-labels', plugins_url( '/css/gf-force-hide-labels.css', __FILE__ ), array(), '1.0' );

	}

}

add_action( 'plugins_loaded', array( 'GF_Hide_Labels', 'get_instance' ) );
