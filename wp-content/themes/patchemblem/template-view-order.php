<?php
/* Template Name: View Order Page */
@session_start();
ob_start();
get_header();
?>
<?php
$order_id = $_SESSION['order_id'];
$method_of_payment = $_SESSION['method_of_payment'];
if($order_id == ''){
    wp_safe_redirect( get_site_url() . '/patch-emblem-payment-form/' );
    exit;    
}
if($order_id){
    $full_name = get_field( "full_name", $order_id );
    $email = get_field( "email", $order_id );
    $extra_notes = get_field( "extra_notes", $order_id );
    $address = get_field( "address", $order_id );
    $phone_number = get_field( "phone_number", $order_id );
    $deposited_amount = get_field( "deposited_amount", $order_id );
    $full_amount = get_field( "full_amount", $order_id );
    $partial_amount = get_field( "partial_amount", $order_id ); 
    $total_amount = $deposited_amount + $partial_amount;  
    if($partial_amount){
    update_field('total_amount', $total_amount, $order_id);  
    }
    
     /*if($method_of_payment == 'deposit'){
            //valued fetch from order post
            $email = get_field( "email", $order_id );
            $full_name = get_field( "full_name", $order_id );
            $extra_notes = get_field( "extra_notes", $order_id );
            $address = get_field( "address", $order_id );
            $phone_number = get_field( "phone_number", $order_id );
            $deposited_amount = get_field( "deposited_amount", $order_id );
            
            //Email to admin and user from here
            $headers[] = 'From: Patch Emblem <sales@patch-emblem.com>';
            $message = 'Dear '.$full_name.', <br /> <br />Thank you for your Order.<br />';
            $message .='<h2>Here are the order Details</h2>';
            $message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Deposit Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $message .='</tbody></table><br /> Regards, <br /> Patch Emblem Team';
            
            // wp mail function for admin and user for Deposit payment option
            wp_mail( $email, 'Patch Emblem Payment Order', $message, $headers );
            
            $admin_email = get_option( 'admin_email' );
            // admin Message html
            $admin_message = 'Dear Admin, <br /> <br />'.$full_name.' done payment on Patch Emblem payment.<br />';
            $admin_message .='<h2>Here are the order Details For '.$full_name.'</h2>';
            $admin_message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Deposit Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $admin_message .='</tbody></table>';
            
            wp_mail( $admin_email, 'Patch Emblem Payment Order', $admin_message, $headers );
            
        }
        elseif ($method_of_payment == 'fullpayment') {
            $full_name = get_field( "full_name", $patch_emblem_post_id );
            $extra_notes = get_field( "extra_notes", $patch_emblem_post_id );
            $address = get_field( "address", $patch_emblem_post_id );
            $phone_number = get_field( "phone_number", $patch_emblem_post_id );
            $deposited_amount = get_field( "deposited_amount", $patch_emblem_post_id );
            $email = get_field( "email", $patch_emblem_post_id );
            
            
            $headers[] = 'From: Patch Emblem <sales@patch-emblem.com>';
            $message = 'Dear '.$full_name.', <br /> <br />Thank you for your Order.<br />';
            $message .='<h2>Here are the order Details</h2>';
            $message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Full Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $message .='</tbody></table><br /> Regards, <br /> Patch Emblem Team';
            
            //wp mail function for admin and user for Full payement option
            wp_mail( $email, 'Patch Emblem Payment Order', $message, $headers );
            
            $admin_email = get_option( 'admin_email' );
            
            $admin_message = 'Dear Admin, <br /> <br />'.$full_name.' done payment on Patch Emblem payment.<br /> <br />Full Amount '.$deposited_amount.' Payment is sucessfull.<br />';
            $admin_message .='<h2>Here are the order Details of '.$full_name.'</h2>';
            $admin_message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
            $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Full Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
            $admin_message .='</tbody></table>';
            
            wp_mail( $admin_email, 'Patch Emblem Payment Order', $admin_message, $headers );
        }
        elseif ($method_of_payment == 'partialpayment') {
            // $form_post_id = $_POST['deposited_order_id'];
            // // user need to enter order ID with PE text so removed PE text from order post ID
            // $update_post_id = str_replace("pe","",$form_post_id);
            // // wp query and arg passed to check post id entered is exist or not
            // $args = array(
            //     'post_type' => 'embroidery_orders',
            //     'p' => $update_post_id,    
            // );
            // $the_query = new WP_Query( $args );
            // if ( $the_query->have_posts() ) {
                
            //     $update_partial_amount =  update_post_meta($update_post_id, 'partial_amount', $_POST['partial_amount']);
            //     // order id inserted to session to get detail on order detail thankyou page
            //     $_SESSION['order_id'] = $update_post_id;
            //     if($update_partial_amount){
                    
                    
                    $email = get_field( "email", $patch_emblem_post_id );
                    $full_name = get_field( "full_name", $patch_emblem_post_id );
                    $extra_notes = get_field( "extra_notes", $patch_emblem_post_id );
                    $address = get_field( "address", $patch_emblem_post_id );
                    $phone_number = get_field( "phone_number", $patch_emblem_post_id );
                    $deposited_amount = get_field( "deposited_amount", $patch_emblem_post_id ); 

                    $headers[] = 'From: Patch Emblem <sales@patch-emblem.com>';
                    $message = 'Dear User, <br /> <br />Thank you for your Order.<br />';
                    $message .='<h2>Here are the order Details</h2>';
                    $message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
                    $message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Balance Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
                    $message .='</tbody></table><br /> Regards, <br /> Patch Emblem Team';
                    wp_mail( $email, 'Patch Emblem Payment Order', $message, $headers );
                    
                    $admin_email = get_option( 'admin_email' );            
                    $admin_message = 'Dear '.$full_name.', <br /> <br />'.$full_name.' done Balance payment on Patch Emblem payment.<br /> <br />Balance Amount '.$full_amount.' Payment is sucessfull<br />';
                    $admin_message .='<h2>Here are the order Details of '.$full_name.'</h2>';
                    $admin_message .='<table id="content" style="margin-top: 10px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff"><tbody>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td colspan="2"><div style="padding-top: 15px; padding-bottom: 1px; font-weight: bold; color: #000;">Full Name</div><div style="color: #000;">'.$full_name.'</div></td></tr>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Email</div><div style="color: #000;">'.$email.'</div></td></tr>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Extra Notes</div><div style="color: #000;">'.$extra_notes.'</div></td></tr>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Address</div><div style="color: #000;">'.$address.'</div></td></tr>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Phone Number</div><div style="color: #000;">'.$phone_number.'</div></td></tr>';
                    $admin_message .='<tr style="font-size: 11px; color: #999999;"><td style="border-top: solid 1px #d9d9d9;" colspan="2"><div style="padding-top: 15px; padding-bottom: 5px; font-weight: bold; color: #000;">Full Amount</div><div style="color: #000;">'.$deposited_amount.'</div></td></tr>';
                    $admin_message .='</tbody></table>';
                    
                    wp_mail( $admin_email, 'Patch Emblem Payment Order', $admin_message, $headers );
            //     }
            // } else {
            //     wp_safe_redirect( get_home_url() . '/patch-emblem-payment-form/' );
            //     exit;
            // }
        } */
    ?>
<div class="row">
    <div class="container">
        <div class="order-details-section section-spacing">
            <h2>Here are the order Details</h2>
            <div class="col-md-12 info-fields"> 
                <span>Full Name:</span><?php echo $full_name; ?> 
            </div>  
            <div class="col-md-12 info-fields">     
                <span>Email:</span><?php echo $email; ?> 
            </div>    
            <div class="col-md-12 info-fields">   
                <span>Extra Notes:</span><?php echo $extra_notes; ?> 
            </div>  
            <div class="col-md-12 info-fields">  
                <span>Address:</span><?php echo $address; ?>  
            </div>  
            <div class="col-md-12 info-fields">   
                <span>Phone Numbers:</span><?php echo $phone_number; ?> 
            </div>  
            <?php if($deposited_amount) { ?>  
            <div class="col-md-12 info-fields">   
                <span>Deposit Amount:</span><?php echo $deposited_amount; ?>  
            </div>   
            <?php } ?>  
            <?php if($full_amount) { ?> 
            <div class="col-md-12 info-fields">   
                <span>Full Amount:</span><?php echo $full_amount; ?> 
            </div>    <?php } ?>   
            <?php if($partial_amount) { ?>   
            <div class="col-md-12 info-fields">   
                <span>Partial Amount:</span><?php echo $partial_amount; ?>
            </div> 
           <?php } ?>  
        </div>
    </div>
</div>  
  <?php } ?>
<?php get_footer();