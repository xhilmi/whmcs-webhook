<?php

///////////////////////////////////////////////////////////////////////
////////////////////////// Hooks Invoice Area /////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['invoiceWebHookURL'] = "<DISCORD_URL>";
// Note: Please be aware that the channel that you select when creating the web hook will be where the messages are sent.

// Your WHMCS Admin URL.
$GLOBALS['whmcsAdminURL'] = "<WHMCS_URL>";
// Note: Please include the end / on your URL. An example of an accepted link would be: https://account.whmcs.com/admin/

// Your Company Name.
$GLOBALS['companyName'] = "COMPANY";
// Note: This will be the name of the user that sends the message in the Discord channel.

// Discord Message Color
$GLOBALS['discordColor'] = hexdec("#FEE75C");
// Note: The color code format within this script is standard hex. Exclude the beginning # character if one is present.

// Discord Group ID Notification
$GLOBALS['discordGroupID'] = "GROUP_ID";
// Note: If you'd like to have a specific group pinged on each message, please place the ID here. An example of a group ID is: <@&343029528563548162>

// Discord Avatar Dynamic Image
$GLOBALS['discordWebHookAvatar'] = "<IMAGE_URL>";
// (OPTIONAL SETTING) Your desired Webhook Avatar. Please make sure you enter a direct link to the image (E.G. https://example.com/iownpaypal.png ).


///////////////////////////////////////////////////////////////////////
////////////////////////// Notification Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below notification settings to meet the requirements of your team and what you wish to send to the Discord channel.
// true = Notification enabled.
// false = Notification disabled.

// Invoice Notifications
$invoiceChangeGateway = true;      // Invoice Change Gateway Notification
$invoicePaid = true;               // Invoice Paid Notification
$invoiceUnpaid = true;             // Invoice Unpaid Notification
$invoiceRefunded = true;           // Invoice Refund Notification
$invoiceCancelled = true;          // Invoice Cancel Notification
$invoicePaymentReminder = true;    // Invoice Payment Reminder Notification
$addInvoiceLateFee = true;         // Add Invoice Late Fee Notification
$addInvoicePayment = true;  	   // Add Invoice Payment Notification

///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($invoiceChangeGateway === true):
	add_hook('InvoiceChangeGateway', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => 'New Payment Method ' . '#' . $vars['paymentmethod'],
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Change Gateway Payment'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($invoicePaid === true):
	add_hook('InvoicePaid', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Paid'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($invoiceUnpaid === true):
	add_hook('InvoiceUnpaid', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Unpaid'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;
		
if($invoiceRefunded === true):
	add_hook('InvoiceRefunded', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Refunded'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($invoiceCancelled === true):
	add_hook('InvoiceCancelled', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Cancel'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($invoicePaymentReminder === true):
	add_hook('InvoicePaymentReminder', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => 'Please suspend this account manually ' . '#' . $vars['type'],
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Payment Reminder Invoice'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($addInvoiceLateFee === true):
	add_hook('AddInvoiceLateFee', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Invoice Late Fee Added'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

if($addInvoicePayment === true):
	add_hook('AddInvoicePayment', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Invoice ' . $vars['invoiceid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'invoices.php?action=edit&id=' . $vars['invoiceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => 'Please suspend this account manually ' . '#' . $vars['type'],
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Payment Reminder Invoice'
					)
				)
			)
		);
		invoiceNotification($dataPacket);
	});
endif;

function invoiceNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['invoiceWebHookURL']);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataPacket));
    $output = curl_exec($curl);
    $output = json_decode($output, true);
	
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        logModuleCall('Discord Notifications', 'Notification Sending Failed', json_encode($dataPacket), print_r($output, true));
    } else {
		logModuleCall('Discord Notifications', 'Notification Successfully Sent', json_encode($dataPacket), print_r($output, true));
	}
	
    curl_close($curl);
}

function invoiceFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
