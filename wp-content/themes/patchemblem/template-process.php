<?php
/* Template Name: Payment Process Page */
@session_start();
ob_start();
get_header();
?>
   <div class="row process_page_conteiner" id="process_page_conteiner">
        <div class="container">
            <div class="loading-process text-center section-spacing">
                <div>Please wait while you are redirecting to the <br/> Paypal gateway make payment..</div>
                <img src="<?php echo get_template_directory_uri();?>/img/icon_loading.gif" alt=""/> <br />
                <a href="javascript:void(0)" onclick="redirect()">Click here to redirect if page does not redirect in 3 seconds</a>
            </div>
        </div>
   </div>
   <script type="text/javascript">
       function redirect(){
           jQuery('.wp_accept_pp_button_form_classic').submit();
       }
   </script>
    <?php
if (isset($_POST['submit'])) {
    
    //print_r($_POST);
    //exit();
    $_SESSION['myKey'] = "Some data I need later";
    // if (($_POST['method_of_payment'] == 'deposit') || ($_POST['method_of_payment'] == 'fullpayment') || ($_POST['method_of_payment'] == 'partialpayment')) {
        
        $six_digit_random_number = mt_rand(100000, 999999);
        // Create Imei post object
        $patch_emblem_order      = array(
            'post_type' => 'embroidery_orders',
            'post_title' => $six_digit_random_number,
            'post_status' => 'publish'
        );
        // Insert the post into the database
        $patch_emblem_post_id    = wp_insert_post($patch_emblem_order);
        $_SESSION['order_id']    = $patch_emblem_post_id;
        // $_SESSION['method_of_payment']    = $_POST['method_of_payment'];
        $patch_emblem_post_array = $_POST;
        foreach ($patch_emblem_post_array as $key => $value) {
            update_post_meta($patch_emblem_post_id, $key, $value);
        }
        if ($patch_emblem_post_id) {
            $pe_order_id = 'pe' . $patch_emblem_post_id;
            update_field('pe_order_id', $pe_order_id, $patch_emblem_post_id);
        }
        
    // }
    $amount = $_POST['deposited_amount'];
    /*
    if ($_POST['method_of_payment'] == 'deposit') {
        $amount = $_POST['deposited_amount'];
    } elseif ($_POST['method_of_payment'] == 'fullpayment') {
        $amount = $_POST['full_amount'];
    } elseif ($_POST['method_of_payment'] == 'partialpayment') {
        $amount = $_POST['partial_amount'];
    }
    */
    //echo $amount;die('die');
    echo Paypal_payment_accept($amount,$patch_emblem_post_id);
} else {
    wp_safe_redirect(get_home_url() . '/patch-emblem-payment-form/');
    exit;
}
?>
<?php
get_footer();
?>
<script type="text/javascript">
   $(window).on("load", function () {
        //var urlHash = window.location.href.split("#")[1];
        $('html,body').animate({
            scrollTop: $('#process_page_conteiner').offset().top
        }, 100);
    });
</script>