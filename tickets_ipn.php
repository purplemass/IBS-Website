<?php

define('INCLUDE_CHECK', true);

require 'models/functions.php';

$count = $_REQUEST['num_cart_items'];
$total_amt = $_REQUEST['mc_gross'] . " " . $_REQUEST['mc_currency'];
$payment_status = $_REQUEST['payment_status'];
$payment_date = $_REQUEST['payment_date'];
$buyer_name = $_REQUEST['first_name'].' '.$_REQUEST['last_name'];
$email_addr = $_REQUEST['option_selection1_1'];
$guest_list = $_REQUEST['option_selection2_1'];
$shipping_address = $_REQUEST['address_name'].'<br>'.
                    $_REQUEST['address_street'].'<br>'.
                    $_REQUEST['address_city'].'<br>'.
                    $_REQUEST['address_state'].'<br>'.
                    $_REQUEST['address_zip'].'<br>'.
                    $_REQUEST['address_country'];

$body  = "<html><body>";

$body .= "<p>Thank you for purchasing tickets for the IBS event. Below are the details of your purchase.</p>";

$body .= "<table>";
$body .= "<tr><td><b>Name</b></td><td>$buyer_name</td></tr>";
$body .= "<tr><td><b>Email Address</b></td><td>$email_addr</td></tr>";
$body .= "<tr valign=\"top\"><td><b>Shipping Address</b></td><td>$shipping_address</td></tr>";
$body .= "<tr><td><b>Items in cart</b></td><td>$count</td></tr>";
for ($i=1; $i<=$count; $i++)
{
    $item     = $_REQUEST['item_name'.$i];
    $quantity = $_REQUEST['quantity'.$i];
    $amount   = $_REQUEST['mc_gross_'.$i] . " " . $_REQUEST['mc_currency'];
    
    $body .= "<tr bgcolor=\"#6699CC\"><td><b>Item</b></td><td>$i</td></tr>";
    $body .= "<tr><td><b>Item</b></td><td>$item</td></tr>";
    $body .= "<tr><td><b>Quantity</b></td><td>$quantity</td></tr>";
    $body .= "<tr><td><b>Amount</b></td><td>$amount</td></tr>";
}
$body .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
$body .= "<tr><td><b>Total Amount</b></td><td>$total_amt</td></tr>";
$body .= "<tr><td><b>Payment Status</b></td><td>$payment_status</td></tr>";
$body .= "<tr><td><b>Payment Date</b></td><td>$payment_date</td></tr>";
$body .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
$body .= "<tr><td><b>Guest List</b></td><td>$guest_list</td></tr>";
$body .= "</table>";


/*
$body .= "<table>";
foreach ($_REQUEST as $key => $value)
{
    $body .= "<tr><td>$key</td><td>$value</td></tr>";
}
$body .= "</table>";
*/


$body .= "</body></html>";

// send email to admin

$from		= "info@ibsproject.org";
$to			= "p.paykari@ibsproject.org,katypalizban@yahoo.co.uk,b.hatamian@ibsproject.org,mankassarian@aol.com,rezzzza@yahoo.com";
$subject	= "IBS Project - Tickets Purchased";
$body 		= $body;

send_mail($from,$to,$subject,$body);

// send email to buyer

$to			= $email_addr;
$subject	= "IBS Project - Tickets Purchased - Thank You";

send_mail($from,$to,$subject,$body);

?>
