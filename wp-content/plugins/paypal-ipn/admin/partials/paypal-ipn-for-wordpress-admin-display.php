<?php

/**
 * @class       AngellEYE_Paypal_Ipn_For_Wordpress_Admin_Display
 * @version	1.0.0
 * @package	paypal-ipn-for-wordpress
 * @category	Class
 * @author      Angell EYE <service@angelleye.com>
 */
class AngellEYE_Paypal_Ipn_For_Wordpress_Admin_Display {

    /**
     * Hook in methods
     * @since    1.0.0
     * @access   static
     */
    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_settings_menu'));
        add_filter('paypal_ipn_for_wordpress_setting_tab', array(__CLASS__, 'paypal_ipn_for_wordpress_premium_extensions_tab'), 13, 1);
        add_action('paypal_ipn_for_wordpress_premium_extensions_setting', array(__CLASS__, 'paypal_ipn_for_wordpress_premium_extensions_setting_own'));
    }

    /**
     * add_settings_menu helper function used for add menu for pluging setting
     * @since    1.0.0
     * @access   public
     */
    public static function add_settings_menu() {
        add_options_page('PayPal IPN for WordPress Options', 'PayPal IPN', 'manage_options', 'paypal-ipn-for-wordpress-option', array(__CLASS__, 'paypal_ipn_for_wordpress_options'));
    }

    /**
     * paypal_ipn_for_wordpress_options helper will trigger hook and handle all the settings section
     * @since    1.0.0
     * @access   public
     */
    public static function paypal_ipn_for_wordpress_options() {
        $setting_tabs = apply_filters('paypal_ipn_for_wordpress_setting_tab', array('general' => 'General'));
        $current_tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
        ?>
        <h2 class="nav-tab-wrapper">
            <?php
            foreach ($setting_tabs as $name => $label)
                echo '<a href="' . admin_url('admin.php?page=paypal-ipn-for-wordpress-option&tab=' . $name) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            ?>
        </h2>
        <?php
        foreach ($setting_tabs as $setting_tabkey => $setting_tabvalue) {
            switch ($setting_tabkey) {
                case $current_tab:
                    do_action('paypal_ipn_for_wordpress_' . $setting_tabkey . '_setting_save_field');
                    do_action('paypal_ipn_for_wordpress_' . $setting_tabkey . '_setting');
                    break;
            }
        }
    }

    /**
     * 
     * @param string $setting_tabs
     * @return string
     * @since    1.0.6
     * @access   public
     */
    public static function paypal_ipn_for_wordpress_premium_extensions_tab($setting_tabs) {
        if (isset($setting_tabs) && !empty($setting_tabs)) {
            $setting_tabs['premium_extensions'] = 'Premium Extensions / Support';
        }
        return $setting_tabs;
    }

    /**
     * @since    1.0.6
     * @access   public
     */
    public static function paypal_ipn_for_wordpress_premium_extensions_setting_own() {


        if (false === ( $addons = get_transient('angelleye_addons_data') )) {
	    $addons_json = wp_remote_get('https://www.angelleye.com/web-services/woocommerce/api/getinfo.php?tag=ipn_premium_extension', array( 'timeout' => 120 ));
            if (!is_wp_error($addons_json)) {

                $addons = json_decode(wp_remote_retrieve_body($addons_json));

                if ($addons) {
                    set_transient('angelleye_addons_data', $addons, HOUR_IN_SECONDS);
                }
            }
        }

        if (isset($addons) && !empty($addons)) {
            ?>
            <div class="wrap angelleye_addons_wrap">

                <ul class="products">
                    <?php
                    foreach ($addons as $addon) {
                        echo '<li class="product">';
                        echo '<a target="_blank" href="' . $addon->permalink . '">';
                        if( isset($addon->title) && !empty($addon->title) ) {
                            echo '<h3>' . $addon->title . '</h3>';
                        }
                        if( isset($addon->price) && !empty($addon->price) ) {
                            echo '<span class="price">' . $addon->price . '</span>';
                        }
			$images = ( !empty($addon->images[0]->src) ) ? $addon->images[0]->src : '';
			if( !empty($images)) {
			  echo "<img src='$images'>";
			}
			$description = ( !empty($addon->short_description )) ? $addon->short_description : $addon->description;
                        if( isset($description) && !empty($description) ) {
			    echo '<p>' . strip_tags($description) . '</p>';
                        }
                        echo '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
        } else {
            echo 'Premium extension available at <a target="_blank" href="https://www.angelleye.com/store/?utm_source=paypal_ipn_for_wordpress&utm_medium=premium_extensions">www.angelleye.com</a>';
        }
    }
    
    public static function display_short_content($content, $numberOfWords = 10) {
        if( isset($content) && !empty($content) ) {
            $contentWords = substr_count($content," ") + 1;
            $words = explode(" ",$content,($numberOfWords+1));
            if( $contentWords > $numberOfWords ){
                $words[count($words) - 1] = '...';
            }
            $excerpt = join(" ",$words);
            return $excerpt;
        }
    }

}

AngellEYE_Paypal_Ipn_For_Wordpress_Admin_Display::init();
