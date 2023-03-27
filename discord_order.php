<?php

///////////////////////////////////////////////////////////////////////
////////////////////////// Hooks Order Area ///////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['orderWebHookURL'] = "<DISCORD_URL>";
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

// Order Notifications
$pendingOrder = true;              // Order Set to Pending Notification
$orderPaid = true;                 // Order Paid Notification
$orderAccepted = true;             // Order Accepted Notification
$orderCancelled = true;            // Order Cancelled Notification
$orderCancelledRefunded = true;    // Order Cancelled & Refunded Notification
$orderFraud = true;                // Order Marked As Fraud Notification
$orderDeleted = true;              // Order Deleted Notification
$cancellationRequest = true;       // Cancellation Request Notification


///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($orderAccepted === true):
	add_hook('AcceptOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Accepted',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Accepted'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($orderCancelled === true):
	add_hook('CancelOrder', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Cancelled',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Cancelled'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($orderCancelledRefunded === true):
	add_hook('CancelAndRefundOrder', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Cancelled & Refunded',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Cancelled & Refunded'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($orderFraud === true):
	add_hook('FraudOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Marked As Fraudulent',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Marked As Fraud'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($orderPaid === true):
	add_hook('OrderPaid', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Paid',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Has been Paid'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($pendingOrder === true):
	add_hook('PendingOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Set to Pending',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Was Marked as Pending'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($orderDeleted === true):
	add_hook('DeleteOrder', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Order ' . $vars['orderid'] . ' Has Been Deleted',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Order Was Deleted'
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

if($cancellationRequest === true):
	add_hook('CancellationRequest', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'Service ' . $vars['relid'] . ' Has Been Cancelled',
					'url' => $GLOBALS['whmcsAdminURL'] . 'orders.php?action=view&id=' . $vars['orderid'],
					'timestamp' => date(DateTime::ISO8601),
					'reason' => $vars['reason'],
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Cancellation Request'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['relid'],
							'inline' => true
						),
					)
				)
			)
		);
		orderNotification($dataPacket);
	});
endif;

function orderNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['orderWebHookURL']);
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

function orderFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
