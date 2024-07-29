<?php
// PayPal settings
$email_to = 'ahmedhamed1986@gmail.com'; // Your contact email
$email_subject = 'Your eBook Purchase - Custom SolidWorks Add-ons eBook';
$return_url = 'www.aterosolutions.com';
$cancel_url = 'https://www.gmail.com';
$notify_url = 'https://www.aterosolutions.com/ipn.php';

// Include the PayPal library
require 'paypal.php';
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

// Read POST data
$postdata = file_get_contents('php://input');

// Parse the POST data
parse_str($postdata, $data);

// Validate the transaction
if ($data['payment_status'] == 'Completed') {
    $item_name = $data['item_name'];
    $item_number = $data['item_number'];
    $payment_status = $data['payment_status'];
    $payment_amount = $data['mc_gross'];
    $payment_currency = $data['mc_currency'];
    $txn_id = $data['txn_id'];
    $receiver_email = $data['receiver_email'];
    $payer_email = $data['payer_email'];

    // Check if payment amount and currency match
    if ($payment_amount == 0.01 && $payment_currency == 'USD') {
        // Send the eBook
        $email_message = "Dear Customer,\n\nThank you for purchasing the 'Custom SolidWorks Add-ons eBook'.\n\nYou can download your eBook using the link below:\n\nhttps://www.aterosolutions.com.com/downloads/Deploy _Your_Add-in_to_The_Task_pane.pdf\n\nIf you have any issues, please contact us.\n\nBest Regards,\nYour Company Name";
        
        $headers = "From: no-reply@aterosolutions.com\r\n";
        $headers .= "Reply-To: support@yaterosolutions.com\r\n";
        
        mail($payer_email, $email_subject, $email_message, $headers);
    }
}
?>
