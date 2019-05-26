<?php

/**
 * PayPal IPN Forwarder class
 *
 * This class defines all code necessary to IPN forwarder functionality 
 *
 * @since      1.0.0
 * @package    paypal-ipn-for-wordpress
 * @subpackage paypal-ipn-for-wordpress/includes
 * @author     Angell EYE <service@angelleye.com>
 */
class AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder {

    /**
     * init for the Ipn_Forwarder.
     */
    public static function init() {

        add_action('paypal_ipn_for_wordpress_ipn_smarter_forwarding_handler', array(__CLASS__, 'paypal_ipn_for_wordpress_ipn_forwarding_handler'), 10, 2);

        // // Check PayPal Standard is enabled
        $woocommerce_paypal_settings = get_option('woocommerce_paypal_settings');

        if (isset($woocommerce_paypal_settings['enabled']) && $woocommerce_paypal_settings['enabled'] == 'yes') {

            add_filter('woocommerce_paypal_args', array(__CLASS__, 'paypal_ipn_for_wordpress_standard_parameters'), 10, 1);

            
        }
        
        add_filter('paypal_ipn_for_wordpress_ipn_forwarding_setting', array(__CLASS__, 'paypal_ipn_for_wordpress_ipn_forwarding_setting'), 10, 1);
        
        add_filter('paypal_ipn_for_wordpress_ipn_forwarding_remote_post_response', array(__CLASS__, 'paypal_ipn_for_wordpress_ipn_forwarding_remote_post_response'), 10, 4);
        add_action( 'paypal_ipn_for_wordpress_ipn_forwarding_remote_post', array(__CLASS__, 'paypal_ipn_for_wordpress_ipn_forwarding_remote_post'), 10, 3 );
    }

    /**
     * paypal_ipn_for_wordpress_ipn_forwarding_handler helper function used for IPN handler
     * @since    1.0.0
     * @access   public
     */
    public static function paypal_ipn_for_wordpress_ipn_forwarding_handler($posted, $post_id) {

        if (!isset($posted) || empty($posted)) {
            return;
        }
        $posted = stripslashes_deep($posted);
        $ipn_forwarding_setting_serialize = apply_filters('paypal_ipn_for_wordpress_ipn_forwarding_setting', maybe_unserialize(get_option('ipn_forwarding_setting')));
        if (isset($ipn_forwarding_setting_serialize) && !empty($ipn_forwarding_setting_serialize)) {
            foreach ($ipn_forwarding_setting_serialize as $serialize_key => $serialize_value) {
                if ((isset($serialize_value['paypal_ipn_url']) && !empty($serialize_value['paypal_ipn_url'])) && isset($serialize_value['active_inactive_checkbox']) && $serialize_value['active_inactive_checkbox'] == 'on') {
                    if (isset($serialize_value) && count($serialize_value) <= 3) {
                        AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_remote_post($posted, $serialize_value, $post_id);
                    } else {
                        $paypal_ipn_field = $serialize_value['paypal_ipn_field'];
                        $paypal_ipn_fieldcondition = $serialize_value['paypal_ipn_fieldcondition'];
                        $paypal_ipn_fieldvalue = $serialize_value['paypal_ipn_fieldvalue'];
                        if (isset($paypal_ipn_field) && !empty($paypal_ipn_field)) {
                            switch ($paypal_ipn_field) {
                                case 'all':
                                    if (isset($serialize_value['paypal_ipn_fieldcondition']) && !empty($serialize_value['paypal_ipn_fieldcondition']) && isset($serialize_value['paypal_ipn_fieldvalue']) && $serialize_value['paypal_ipn_fieldvalue'] == 'all') {
                                        AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_remote_post($posted, $serialize_value, $post_id);
                                    }
                                    break;
                                case 'transaction_type':
                                    $paypalhelper = new AngellEYE_Paypal_Ipn_For_Wordpress_Paypal_Helper();
                                    $txn_type = AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_parse_txn_type($posted);
                                    $txn_type_own = $txn_type['txn_type_own'];
                                    if (AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_dynamic_condition($serialize_value, $posted, $txn_type_own) == true) {
                                        AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_remote_post($posted, $serialize_value, $post_id);
                                    }
                                    break;
                                default:
                                    if (AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_dynamic_condition($serialize_value, $posted) == true) {
                                        AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::paypal_ipn_for_wordpress_ipn_forwarding_remote_post($posted, $serialize_value, $post_id);
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * 
     * @param type $paypal_args
     * @return string
     */
    public static function paypal_ipn_for_wordpress_standard_parameters($paypal_args) {

        $paypal_args['bn'] = 'AngellEYE_SP_WooCommerce';
        $paypal_args['notify_url'] = add_query_arg( 'keys', 'paypal_standard', site_url('?AngellEYE_Paypal_Ipn_For_Wordpress&action=ipn_handler') );

        /**
         *  PayPal request args add to log file 
         */
        $debug = (get_option('paypal_ipn_for_wordpress_paypal_debug') == '1') ? 'yes' : 'no';

        if ('yes' == $debug) {
            $log = new AngellEYE_Paypal_Ipn_For_Wordpress_Logger();
            $log->add('paypal', 'PayPal Request args: ' . print_r($paypal_args, true));
        }

        return $paypal_args;
    }

    /**
     * 
     * @param type $ipn_forwarding_setting
     * @return type array
     */
    public static function paypal_ipn_for_wordpress_ipn_forwarding_setting($ipn_forwarding_setting) {
        if( !empty($_GET['keys']) ) {
            $inbuild_ipn_forwarding_array = array();
            if('paypal_standard' == $_GET['keys']) {
                $inbuild_ipn_forwarding_array[0] = array(
                    'paypal_ipn_url' => WC()->api_request_url( 'WC_Gateway_Paypal' ),
                    'active_inactive_checkbox' => 'on',
                    'keys' => 'paypal_standard'
                );
            } elseif('paypal_plus' == $_GET['keys']) {
                $inbuild_ipn_forwarding_array[0] = array(
                    'paypal_ipn_url' => WC()->api_request_url( 'Woo_Paypal_Plus_Gateway' ),
                    'active_inactive_checkbox' => 'on',
                    'keys' => 'paypal_plus',
                );
            }
            return $inbuild_ipn_forwarding_array;
        } else {
           return $ipn_forwarding_setting; 
        }
    }

    public static function paypal_ipn_for_wordpress_ipn_forwarding_remote_post($posted = null, $serialize_value = null, $post_id) {
        $params = array(
            'body' => $posted,
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
	     ),
            'sslverify' => false,
            'timeout' => 60,
            'httpversion' => '1.1',
            'compress' => false,
            'decompress' => false,
            'user-agent' => 'paypal-ipn/'
        );
        $response = wp_safe_remote_post($serialize_value['paypal_ipn_url'], $params);
        return apply_filters('paypal_ipn_for_wordpress_ipn_forwarding_remote_post_response', $response, $posted, $serialize_value, $post_id);
    }

    public static function paypal_ipn_for_wordpress_ipn_forwarding_dynamic_condition($serialize_value = null, $posted = null, $txn_type_own = null) {
        $paypal_ipn_field = $serialize_value['paypal_ipn_field'];

        if (isset($paypal_ipn_field) && $paypal_ipn_field == 'transaction_amount') {
            $mc_gross = $posted['mc_gross'];
            if (isset($mc_gross) && !empty($mc_gross)) {
                $posted[$paypal_ipn_field] = $mc_gross;
            } else {
                $transaction_amount = $posted['transaction_amount'];
                $mc_amount3 = $posted['mc_amount3'];
                if (isset($transaction_amount) && !empty($transaction_amount)) {
                    $posted[$paypal_ipn_field] = $transaction_amount;
                } elseif (isset($mc_amount3) && !empty($mc_amount3)) {
                    $posted[$paypal_ipn_field] = $mc_amount3;
                }
            }
        } elseif (isset($paypal_ipn_field) && $paypal_ipn_field == 'transaction_type') {
            if (isset($txn_type_own) && !empty($txn_type_own)) {
                $posted[$paypal_ipn_field] = $txn_type_own;
            }
        }



        $paypal_ipn_fieldcondition = $serialize_value['paypal_ipn_fieldcondition'];
        $paypal_ipn_fieldvalue = $serialize_value['paypal_ipn_fieldvalue'];

        if (isset($posted[$paypal_ipn_field]) && !empty($posted[$paypal_ipn_field])) {
            switch ($paypal_ipn_fieldcondition) {
                case 'equalto':
                    if ($posted[$paypal_ipn_field] == $paypal_ipn_fieldvalue) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                case 'contains':
                    if (strpos($posted[$paypal_ipn_field], $paypal_ipn_fieldvalue) !== false) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                case 'lessthen':
                    if ($posted[$paypal_ipn_field] < $paypal_ipn_fieldvalue) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                case 'graterthen':
                    if ($posted[$paypal_ipn_field] > $paypal_ipn_fieldvalue) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                case 'exists' :
                    return true;
            }
        } else {
            return false;
        }
    }

    public static function paypal_ipn_for_wordpress_ipn_forwarding_dynamic_condition_for_txn_type($serialize_value = null, $posted = null, $txn_type_own) {
        $paypal_ipn_fieldvalue = $serialize_value['paypal_ipn_fieldvalue'];
        if (isset($txn_type_own) && !empty($txn_type_own)) {
            if ($paypal_ipn_fieldvalue == $txn_type_own) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function paypal_ipn_for_wordpress_parse_txn_type($posted = null) {

        $newposted = array();
        $txn_type = (isset($posted['txn_type'])) ? $posted['txn_type'] : '';
        $reason_code = (isset($posted['reason_code'])) ? $posted['reason_code'] : '';
        $payment_status = (isset($posted['payment_status'])) ? $posted['payment_status'] : '';
        $account_key = (isset($posted['account_key'])) ? $posted['account_key'] : '';
        $transaction_type = (isset($posted['transaction_type'])) ? $posted['transaction_type'] : '';

        if (strtoupper($txn_type) == 'NEW_CASE' || strtoupper($payment_status) == 'REVERSED' || strtoupper($payment_status) == 'CANCELED_REVERSAL' || strtoupper($txn_type) == 'ADJUSTMENT') {

            $newposted['txn_type_own'] = 'Disputes';
        } elseif (strtoupper($reason_code) == 'REFUND') {

            $newposted['txn_type_own'] = 'Refund';
        } elseif (strtoupper($txn_type) == 'MASSPAY') {

            $newposted['txn_type_own'] = 'Mass payments';
        } elseif (strtoupper($txn_type) == 'MC_CANCEL' || strtoupper($txn_type) == 'MC_SIGNUP') {

            $newposted['txn_type_own'] = 'Billing agreements';
        } elseif (strtoupper($txn_type) == 'PAYOUT') {

            $newposted['txn_type_own'] = 'Payouts';
        } elseif (strtoupper($txn_type) == 'SUBSCR_SIGNUP' || strtoupper($txn_type) == 'SUBSCR_FAILED' || strtoupper($txn_type) == 'SUBSCR_CANCEL' || strtoupper($txn_type) == 'SUBSCR_EOT' || strtoupper($txn_type) == 'SUBSCR_MODIFY') {

            $newposted['txn_type_own'] = 'Subscriptions';
        } elseif (strtoupper($txn_type) == 'SUBSCR_PAYMENT') {

            $newposted['txn_type_own'] = 'Subscription payment';
        } elseif (strtoupper($txn_type) == 'MERCH_PMT') {

            $newposted['txn_type_own'] = 'Merchant payments';
        } elseif (strtoupper($txn_type) == 'MP_CANCEL' || strtoupper($txn_type) == 'MP_SIGNUP') {

            $newposted['txn_type_own'] = 'Billing agreements';
        } elseif (strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_CREATED' || strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_CANCEL' || strtoupper($txn_type) == 'RECURRING_PAYMENT_PROFILE_MODIFY') {

            $newposted['txn_type_own'] = 'Recurring payment profile';
        } elseif (strtoupper($txn_type) == 'RECURRING_PAYMENT' || strtoupper($txn_type) == 'RECURRING_PAYMENT_SKIPPED' || strtoupper($txn_type) == 'RECURRING_PAYMENT_FAILED' || strtoupper($txn_type) == 'RECURRING_PAYMENT_SUSPENDED_DUE_TO_MAX_FAILED_PAYMENT' || strtoupper($txn_type) == 'RECURRING_PAYMENT_EXPIRED' || strtoupper($txn_type) == 'RECURRING_PAYMENT_SUSPENDED') {

            $newposted['txn_type_own'] = 'Recurring payments';
        } elseif (strtoupper($reason_code) != 'REFUND' && ( strtoupper($txn_type) == 'CART' || strtoupper($txn_type) == 'EXPRESS_CHECKOUT' || strtoupper($txn_type) == 'VIRTUAL_TERMINAL' || strtoupper($txn_type) == 'WEB_ACCEPT' || strtoupper($txn_type) == 'SEND_MONEY' || strtoupper($txn_type) == 'INVOICE_PAYMENT' || strtoupper($txn_type) == 'PRO_HOSTED' )) {

            $newposted['txn_type_own'] = 'Orders';
        } elseif (strtoupper($transaction_type) == 'ADAPTIVE PAYMENT PREAPPROVAL' || strtoupper($transaction_type) == 'ADAPTIVE PAYMENT PAY' || !empty($account_key)) {

            $newposted['txn_type_own'] = 'Adaptive paments';
        } else {

            $newposted['txn_type_own'] = 'other';
        }

        return $newposted;
    }
    
    public static function paypal_ipn_for_wordpress_ipn_forwarding_remote_post_response($response, $posted, $serialize_value, $post_id) {
        $paypal_ipn_forwarder_url_name_array = array();
        if( !empty($serialize_value['ipn_url_name'])) {
            if( !empty($post_id) ) {
                $paypal_ipn_forwarder_url_name = get_post_meta($post_id, 'paypal_ipn_forwarder_url_name', true);
                if( !empty($paypal_ipn_forwarder_url_name) ) {
                    $paypal_ipn_forwarder_url_name_array = array_merge($paypal_ipn_forwarder_url_name, array($serialize_value['ipn_url_name']));
                    update_post_meta($post_id, 'paypal_ipn_forwarder_url_name', $paypal_ipn_forwarder_url_name_array);
                } else {
                    $paypal_ipn_forwarder_url_name_array = array_merge($paypal_ipn_forwarder_url_name_array, array($serialize_value['ipn_url_name']));
                    update_post_meta($post_id, 'paypal_ipn_forwarder_url_name', $paypal_ipn_forwarder_url_name_array);
                }
            }
        }
    }
}

AngellEYE_Paypal_Ipn_For_Wordpress_Ipn_Forwarder::init();
