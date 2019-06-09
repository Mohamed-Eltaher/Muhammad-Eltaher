<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WPMultiStepCheckout_Settings {

    public $messages = array();
    private $tab = 'general';
    private $settings = array();

    private $slug = 'wmsc-settings';

    /**
     * Constructor
     */
    public function __construct() {

        require_once 'settings-array.php';
        $this->settings = get_wmsc_settings('wp-multi-step-checkout');
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );

        $this->warnings();
    }

    /**
     * Create the menu link
     */
    function admin_menu() {
        add_submenu_page(
            'woocommerce', 
            'Multi-Step Checkout', 
            'Multi-Step Checkout', 
            'manage_options', 
            $this->slug, 
            array($this, 'admin_settings_page')
//            array($this, 'admin_contents')
        );
    }

    /**
     * Enqueue the scripts and styles 
     */
    function admin_enqueue_scripts() {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_URL);
        if ( $page != 'wmsc-settings' ) return false;

        // Color picker
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script('wp-color-picker');

        $u = plugins_url('/', WMSC_PLUGIN_FILE) . 'assets/';     // assets url
        $f = plugins_url('/', WMSC_PLUGIN_FILE) . 'includes/frm/assets/';           // framework assets url
        $v = WMSC_VERSION;                          // version
        $d = array('jquery');                       // dependency
        $w = true;                                  // where? in the footer?

        // Load scripts
        wp_enqueue_script( 'wmsc-bootstrap', $f.'bootstrap.min.js', $d, $v, $w);
        wp_enqueue_script( 'wmsc-admin-script', $u.'js/admin-script.js', $d, $v, $w);

        // Load styles
        wp_enqueue_style ( 'wmsc-bootstrap',   $f.'bootstrap.min.css', array(), $v);
        wp_enqueue_style ( 'wmsc-admin-style', $u.'css/admin-style.css', array(), $v);
    }

    /**
     * Save the data on update
     */
    function admin_update() {
      if ( !isset($_POST) || !is_array($_POST) || count($_POST) == 0 )
        return;

      check_admin_referer( $this->slug );

      foreach( $this->defaults as $_id => $_field ) {
        if ( isset($_POST[$_id]) ) $this->defaults[$_id][2] = $_POST[$_id];
        if ( isset($_POST[$_id]) && $_field[0] === 'checkbox') $this->defaults[$_id][2] = true;
        if ( !isset($_POST[$_id]) && $_field[0] === 'checkbox') $this->defaults[$_id][2] = false;
      }

      update_option($this->slug, $this->defaults);

    }

    /**
     * Helper function: build a field
     */
    function field($id, $field) {
      switch( $field[0]) {
        case 'checkbox' :
          $checked = ($field[2]) ? ' checked' : '';
          return '<input type="checkbox" name="'.$id.'" id="wpmc-'.$id.'" value="1"'.$checked.' />';
        case 'text' :
          return '<input type="text" name="'.$id.'" id="wpmc-'.$id.'" value="'.esc_attr( $field[2] ) .'" />';
      }
    }

    /**
     * Show the contents of the admin settings page
     */
    function admin_contents() {
        //must check that the user has the required capability
        if (!current_user_can('manage_options')) {
            wp_die(('You do not have sufficient permissions to access this page.'));
        }

        $this->admin_update();

        $fields = get_option($this->slug);

        if ( $fields === false ) $fields = $this->defaults;

        ?>
        <div class="wrap">
        <h1><?php _e('WooCommerce Multi-Step Checkout', 'Plugin title', 'wp-multi-step-checkout'); ?></h1>

        <form method="post" action="admin.php?page=wpmc-settings">
            <?php settings_fields( $this->slug ); ?>
            <?php do_settings_sections( $this->slug ); ?>
            <table class="form-table">
              <?php
              foreach( $fields as $_id => $_field ) : ?>
                <tr valign="top">
                <th scope="row"><?php echo (isset($this->defaults[$_id])) ? $this->defaults[$_id][1] : $_field[1]; ?></th>
                <td><?php echo $this->field($_id, $_field); ?></td>
                </tr>
              <?php endforeach; ?>
            </table>

            <?php wp_nonce_field( $this->slug ); ?>
            <?php submit_button(); ?>

        </form>
        </div>
        <?php
    }


    /**
     * Output the admin page
     * @access public
     */
    public function admin_settings_page() {

        // Get the tab name
        $allowed_tabs = array(
            'general'   => __('General Settings', 'wp-multi-step-checkout'),
            'design'    => __('Design', 'wp-multi-step-checkout'),
            'titles'    => __('Text on Steps and Buttons', 'wp-multi-step-checkout'), 
        );

        $tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';

        if ( !isset($allowed_tabs[$tab])) $tab = 'general';

        // Get the messages
        $messages = $this->show_messages();

        // Which options to load
        switch( $tab ) {
            case 'titles' : 
                $general_settings = array(
                    't_login', 't_billing', 't_shipping', 't_order', 't_payment', 't_back_to_cart', 't_skip_login', 't_previous', 't_next', 't_error', 'c_sign', 't_wpml',  
                );
                break;
            case 'design' : 
                $general_settings = array(
                    'main_color', 'wpmc_buttons', 'template' 
                );
                break;
            case 'general' : 
                $general_settings = array(
                    'label1', 'show_shipping_step', 'show_login_step', 'unite_billing_shipping', 'unite_order_payment', 'label2', 'show_back_to_cart_button', 'registration_with_login', 'review_thumbnails', 'label3', 'validation_per_step', 'clickable_steps', 'keyboard_nav' ,  
                );
                break;
        }

        // Get the saved options
        $settings_values = get_option('wmsc_options');
        $default_settings = get_wmsc_settings('wp-multi-step-checkout');

        // Save the options
        if ( ! empty( $_POST ) ) {
            check_admin_referer('wmsc_'. $tab);
            $new_values = $this->validate( $_POST, $general_settings );
            if ( $settings_values == false ) {
                foreach($default_settings as $_key => $_value ) $default_settings[$_key] = $_value['value'];
                $settings_values = array_merge( $default_settings, $new_values );
            } else {
                $settings_values = array_merge( $settings_values, $new_values );
            }

            if ( isset($settings_values['show_login_step'] ) ) {
                unset($settings_values['show_login_step'] );
            }

            update_option( 'wmsc_options', $settings_values );
            self::add_message( 'success', '<b>'.__('Your settings have been saved.') . '</b>' );
            $messages = $this->show_messages();
        }

        // Show the options
        require_once 'frm/forms-helper.php';
        $forms_helper = new SilkyPress_FormsHelper;
        ob_start();
        $forms_helper->label_class = 'col-sm-5 control-label';  
        $forms_helper->non_label_class = 'col-sm-7'; 
        $forms_helper->plugin_url = WMSC_PLUGIN_URL; 
        foreach( $general_settings as $_field ) {
            $field_settings = $this->get_settings( $_field);
            if ( isset($settings_values[$_field])) {
                $field_settings['value'] = stripslashes($settings_values[$_field]);
            }
            if ( isset($settings_values['t_wpml']) && $settings_values['t_wpml'] == 1 && substr($_field, 0, 2) == 't_' && $_field !== 't_wpml') {
                if ( $_field !== 't_wpml' ) {
                    $field_settings['value'] = $field_settings['label'];
                } else {
                    $field_settings['value'] = true;
                }
            }
            if ( isset($default_settings[$_field]['pro']) && $default_settings[$_field]['pro'] ) {
                $field_settings['disabled'] = true;
            }
            $forms_helper->input($field_settings['input_form'], $field_settings); 
        }
        $contents = ob_get_contents(); ob_end_clean();

        // Premium tooltips
        require_once( 'frm/premium-tooltips.php' );
        $message = __('Only available in <a href="%1$s" target="_blank">PRO version</a>', 'wp-multi-step-checkout');
        $message = wp_kses( $message, array('a' => array('href' => array(), 'target'=> array())));
        $message = sprintf( $message, 'https://www.silkypress.com/woocommerce-multi-step-checkout-pro/?utm_source=wordpress&utm_campaign=wmsc_free&utm_medium=banner');
        new SilkyPress_PremiumTooltips($message); 

        // Show the page
        include_once 'admin-template.php';
        echo str_replace('{$content}', $contents, $template);

        include_once 'right_columns.php';

    }


    /**
     * Validate the $_POST values
     */
    private function validate( $post, $fields ) {

        // filter only the allowed fields
        $fields = array_fill_keys( $fields, '' );
        $post = array_intersect_key( $post, $fields );

        foreach($fields as $_key => $_value ) {
            // Add the unchecked checkboxes
            if ( !isset($post[$_key])) {
                $post[$_key] = false;
            }

            // Get the defaults
            $settings = $this->get_settings( $_key );

            // Validate the checkboxes
            if ( $settings['input_form'] == 'checkbox' && $post[$_key] == 'on' ) {
                if ($post[$_key] == 'on') $post[$_key] = true;
                if ( !is_bool($post[$_key])) $post[$_key] = $settings['value'];
            }

            // Validate colors
            if ( $settings['input_form'] == 'input_color' && !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $post[$_key]) ) {
                $post[$_key] = $settings['value'];
                $this->add_message('info', __('Unrecognized <b>'.$settings['label'].'</b>. The value was reset to <b>'.$settings['value'] . '</b>') );
            }

            // Sanitize text
            if ( $settings['input_form'] == 'input_text' ) {
                $post[$_key] = filter_var($post[$_key], FILTER_SANITIZE_STRING);
            }

            // Validate against a values set 
            if ( in_array( $settings['input_form'], array('button', 'radio')) ) {
                if ( !array_key_exists($post[$_key], $settings['values']) ) {
                    $value = $settings['value'];
                    $this->add_message('info', __('Unrecognized <b>'.$settings['label'].'</b>. The value was reset to <b>'.$settings['value'] . '</b>') );
                }
            }

            if ( isset($settings['validate'])) {
                if ($settings['validate']['type'] == 'int') {
                    $post[$_key] = (int)$post[$_key];
                }
                if ($settings['validate']['type'] == 'float') {
                    $post[$_key] = (float)$post[$_key];
                }
                $min = $settings['validate']['range'][0];
                $max = $settings['validate']['range'][1];

                if ( !is_numeric($post[$_key]) || $post[$_key] < $min || $post[$_key] > $max ) {
                    $post[$_key] = $settings['value'];
                    $this->add_message('info', __('<b>'.$settings['label'].'</b> accepts values between '.$min.' and '.$max .'. Your value was reset to <b>' . $settings['value'] .'</b>') );
                }

            }
        }

        return $post;
    }


    /**
     * Build an array with settings that will be used in the form
     * @access public
     */
    public function get_settings( $id  = '' ) {

        if ( isset( $this->settings[$id] ) ) {
            $this->settings[$id]['name'] = $id;
            return $this->settings[$id];
        } 

        return $this->settings;
    }


    /**
     * Add a message to the $this->messages array
     * @type    accepted types: success, error, info, block
     * @access private
     */
    private function add_message( $type = 'success', $text ) {
        global $comment;
        $messages = $this->messages;
        $messages[] = array('type' => $type, 'text' => $text);
        $comment[] = array('type' => $type, 'text' => $text);
        $this->messages = $messages;
    }

    /**
     * Output the form messages
     * @access public
     */
    public function show_messages() {
        global $comment;
        if ( !$comment || sizeof( $comment ) == 0 ) return;
        $output = '<div class="col-lg-12">';
        foreach ( $comment as $message ) {
            $output .= '<div class="alert alert-'.$message['type'].'">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  '. $message['text'] .'</div>';
        }
        $output .= '</div>';
        return $output;
    }


    /**
     * Show admin warnings
     */
    function warnings() {

        require_once( 'frm/warnings.php' );

        $allowed_actions = array(
            'wmsc_dismiss_oceanwp',
            'wmsc_dismiss_avada_one_page_checkout',
            'wmsc_dismiss_suki_theme',
            'wmsc_dismiss_german_market_hooks',
        );

        $w = new SilkyPress_Warnings($allowed_actions); 


        if ( !$w->is_url('plugins') && !$w->is_url('wmsc-settings') ) {
            return;
        }

        // Warning about the OceanWP theme
        if ( strpos( strtolower(get_template()), 'oceanwp') !== false && $w->is_url('wmsc-settings') && true == get_theme_mod( 'ocean_woo_multi_step_checkout', false )) { 
            $message = __('Currently the <b>OceanWP theme</b> is overriding the steps on the checkout page. If you want to use the steps from the <b>WooCommerce Multi-Step Checkout Pro</b> plugin, then you need to disable the "Multi-Step Checkout" option on the <b>WP Admin -> Customize -> WooCommerce Checkout</b> page.', 'wp-multi-step-checkout-pro');
            $w->add_notice( 'wmsc_dismiss_oceanwp', $message);
        }

        // Warning about the Avada theme
        if ( strpos( strtolower(get_template()), 'avada') !== false && $w->is_url('wmsc-settings') ) {
            $avada_options = get_option('fusion_options');
            if ( isset($avada_options['woocommerce_one_page_checkout'] ) && $avada_options['woocommerce_one_page_checkout'] != '1' ) {
                $message = __('When using the <b>WooCommerce Multi-Step Checkout</b> plugin with the <b>Avada</b> theme, if you notice some design issues, try changing the <b>WooCommerce One Page Checkout</b> option to <b>ON</b> on the <a href="themes.php?page=avada_options">WP Admin -> Avada -> Theme Options -> WooCommerce</a>, as shown in <a href="https://www.silkypress.com/wp-content/uploads/2019/02/avada-one-page-checkout.png" target="_blank">this screenshot</a>.', 'wp-multi-step-checkout-pro');
                $w->add_notice( 'wmsc_dismiss_avada_one_page_checkout', $message);
                
            }
        }

        // Warning about the Suki theme
        if ( strpos( strtolower(get_template()), 'suki') !== false && $w->is_url('wmsc-settings') ) {
            $message = __('The Suki theme adds some HTML elements to the checkout page in order to create the two columns. This additional HTML messes up the steps from the multi-step checkout plugin. Unfortunately the multi-step checkout plugin isn\'t compatibile with the Suki theme.', 'wp-multi-step-checkout-pro');
            $w->add_notice( 'wmsc_dismiss_suki_theme', $message);
        }


        // Warning if the hooks from the German Market plugin are turned on
        if ( class_exists('Woocommerce_German_Market') && get_option( 'gm_deactivate_checkout_hooks', 'off' ) != 'off' && $w->is_url('wmsc-settings') ) {
            $message = __('The "Deactivate German Market Hooks" option on the <b>WP Admin -> WooCommerce -> German Market -> Ordering</b> page will interfere with the proper working of the <b>WooCommerce Multi-Step Checkout</b> plugin. Please consider turning the option off.', 'wp-multi-step-checkout-pro');
            $w->add_notice( 'wmsc_dismiss_german_market_hooks', $message);
        }


        $w->show_warnings();
    }


}

new WPMultiStepCheckout_Settings();
