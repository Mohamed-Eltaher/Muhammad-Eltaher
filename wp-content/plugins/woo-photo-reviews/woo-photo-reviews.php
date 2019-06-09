<?php
/**
 * Plugin Name: Photo Reviews for WooCommerce
 * Plugin URI: https://villatheme.com/extensions/woocommerce-photo-reviews/
 * Description: Allow you to automatically send email to your customers to request reviews. Customers can include photos in their reviews.
 * Version: 1.1.2.3
 * Author: VillaTheme
 * Author URI: http://villatheme.com
 * Text Domain: woo-photo-reviews
 * Domain Path: /languages
 * Copyright 2018 VillaTheme.com. All rights reserved.
 * Requires at least: 4.4
 * Tested up to: 5.2
 * WC requires at least: 3.0.0
 * WC tested up to: 3.6.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'VI_WOO_PHOTO_REVIEWS_VERSION', '1.1.2.3' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce-photo-reviews/woocommerce-photo-reviews.php' ) ) {
    return;
}
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	$init_file = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'woo-photo-reviews' . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "includes.php";
	require_once $init_file;
}

if ( ! class_exists( 'VI_Woo_Photo_Reviews' ) ) {
	class VI_Woo_Photo_Reviews {

		public function __construct() {
			add_filter(
				'plugin_action_links_woo-photo-reviews/woo-photo-reviews.php', array(
					$this,
					'settings_link'
				)
			);
			add_action( 'admin_notices', array( $this, 'notification' ) );
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		}
		public function load_plugin_textdomain() {
			$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
			$locale = apply_filters( 'plugin_locale', $locale, 'woo-photo-reviews' );
			load_textdomain( 'woo-photo-reviews', WP_PLUGIN_DIR . "/woo-photo-reviews/languages/woo-photo-reviews-$locale.mo" );
			load_plugin_textdomain( 'woo-photo-reviews', false, basename( dirname( __FILE__ ) ) . "/languages" );
		}

		public function settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=woo-photo-reviews" title="' . __( 'Settings', 'woo-photo-reviews' ) . '">' . __( 'Settings', 'woo-photo-reviews' ) . '</a>';
			array_unshift( $links, $settings_link );

			return $links;
		}

		public function notification() {
			if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				?>
                <div id="message" class="error">
                    <p><?php _e( 'Please install and activate WooCommerce to use Photo Reviews for WooCommerce.', 'woo-photo-reviews' ); ?></p>
                </div>
				<?php
			}
		}
	}
}

new VI_Woo_Photo_Reviews();