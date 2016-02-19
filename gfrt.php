<?php
/*
Plugin Name: Gravity Forms Running Total
Plugin URI: http://thewpway.com
Description: A plugin for Gravity Forms to generate a running total of a form on a specific field.
Version: 1.0.0
Author: areimann
Author URI: http://thewpway.com
License: GPL3

Copyright 2016 Aaron Reimann aaron.reimann@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! class_exists( 'GFRT_Plugin' ) ) {

	class GFRT_Plugin {

		/**
		 * Initializes the plugin
		 */
		public static function load() {

			require_once( __DIR__ . '/gfrt-shortcodes.php' );

			register_activation_hook( __FILE__, array( __CLASS__, '_wp_activation' ) );
			register_deactivation_hook( __FILE__, array( __CLASS__, '_wp_deactivation' ) );

		}

		public static function _wp_activation() {
			flush_rewrite_rules();
		}

		public static function _wp_deactivation() {
			flush_rewrite_rules();
		}

	}

}
GFRT_Plugin::load();
