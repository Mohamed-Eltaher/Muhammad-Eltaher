<?php

/**
 * @class       AngellEYE_Paypal_Ipn_For_Wordpress_Admin
 * @version	1.0.0
 * @package	paypal-ipn-for-wordpress
 * @category	Class
 * @author      Angell EYE <service@angelleye.com>
 */
class AngellEYE_Paypal_Ipn_For_Wordpress_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @var      string    $plugin_name       The name of this plugin.
     * @var      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load_dependencies();
    }

    /**
     * Register the stylesheets for the Dashboard.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         *
         * An instance of this class should be passed to the run() function
         * defined in AngellEYE_Paypal_Ipn_For_Wordpress_Admin_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The AngellEYE_Paypal_Ipn_For_Wordpress_Admin_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $screen = get_current_screen();
        if ((isset($screen->id) && ($screen->id == 'paypal_ipn' || $screen->id == 'settings_page_paypal-ipn-for-wordpress-option')) && (isset($screen->base) && ($screen->base == 'post' || $screen->id == 'settings_page_paypal-ipn-for-wordpress-option' ))) {
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/paypal-ipn-for-wordpress-admin.css', array(), $this->version, 'all');
        }
    }

    public function admin_enqueue_scripts() {
        /**
         * add code prettify jquery
         */
        global $post_type;
        if ($post_type == "paypal_ipn") {
            wp_enqueue_script('run_prettify', 'https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js', array('jquery'), $this->version, true);
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/paypal-ipn-for-wordpress-admin.js', array('jquery'), $this->version, true);
        }
    }

    private function load_dependencies() {

        /**
         * The class responsible for defining all actions that occur in the Dashboard for IPN Listing
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-paypal-ipn-for-wordpress-post-types.php';

        /**
         * The class responsible for defining all actions that occur in the Dashboard
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/paypal-ipn-for-wordpress-admin-display.php';

        /**
         * The class responsible for defining function for display Html element
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-paypal-ipn-for-wordpress-html-output.php';

        /**
         * The class responsible for defining function for display general setting tab
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/class-paypal-ipn-for-wordpress-general-setting.php';
    }

    /**
     * modify wordpress search query
     *
     * @since    1.0.4
     */
    public function paypal_ipn_for_wordpress_modify_wp_search($where) {

        global $wpdb, $wp;

        if (isset($_GET['s']) && !empty($_GET['s'])) {
            if (is_search() && isset($_GET['post_type']) && $_GET['post_type'] == 'paypal_ipn') {
                $where = preg_replace(
                        "/($wpdb->posts.post_title (LIKE '%{$wp->query_vars['s']}%'))/i", "$0 OR ( $wpdb->postmeta.meta_value LIKE '%{$wp->query_vars['s']}%' )", $where
                );
                add_filter('posts_join_request', array(__CLASS__, 'paypal_ipn_for_wordpress_modify_wp_search_join'));
                add_filter('posts_distinct_request', array(__CLASS__, 'paypal_ipn_for_wordpress_modify_wp_search_distinct'));
            }
        }

        return $where;
    }

    /**
     * wordpress join search query
     *
     * @since    1.0.4
     */
    public static function paypal_ipn_for_wordpress_modify_wp_search_join($join) {

        global $wpdb;

        return $join .= " LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
    }

    /**
     * wordpress distinct search query
     *
     * @since    1.0.4
     */
    public static function paypal_ipn_for_wordpress_modify_wp_search_distinct($distinct) {

        return 'DISTINCT';
    }
    
    /**
     * @since    1.1 
     * @param type $actions
     * @param type $post
     * View link goes to 404 Not Found Issue #69
     */
    public function paypal_ipn_for_wordpress_remove_row_actions($actions, $post) {
        global $current_screen;
        if( $current_screen->post_type == 'paypal_ipn' ) {
            unset( $actions['view'] );
            unset( $actions['inline hide-if-no-js'] );
        }
        return $actions;
    }
    
    public function paypal_ipn_for_wordpress_remove_postmeta($pid) {
        global $wpdb;
        if( get_post_type($pid) == 'paypal_ipn' || get_post_type($pid) == 'ipn_history' ) {
            if ( $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE post_id = %d", $pid ) ) ) {
                $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->postmeta} WHERE post_id = %d", $pid ) );
            }
        }
    }
}
