<?php

///////////////////////////////////////////////////////////////////////
////////////////////////// Hooks Ticket Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['ticketWebHookURL'] = "<DISCORD_URL>";
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

// Ticket Notifications
$ticketUserOpen = true;             // New Ticket Opened Notification
$ticketUserReply = true;            // Ticket User Reply Received Notification
$ticketFlagged = true;              // Ticket Flagged To Staff Member Notification
$ticketNewNote = true;              // New Note Added To Ticket Notification
$ticketAdminReply = true;           // Ticket Admin Reply Notification
$ticketClose = true;                // Ticket Close Notification
$ticketDelete = true;               // Ticket Delete Notification
$ticketMerge = true;                // Ticket Merge Notification
//$ticketStatusChange = true;         // Ticket Status Change Notification


///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($ticketUserOpen === true):
	add_hook('TicketOpen', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => '#' . $vars['ticketmask'] . ' - ' . ticketFix($vars['subject']) . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => ticketFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'New Support Ticket'
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true
						),
						array(
							'name' => 'Ticket ID',
							'value' => '#' . $vars['ticketmask'],
							'inline' => true
						),
						array(
							'name' => 'Message',
							'value' => '#' . $vars['message'],
							'inline' => true
						)
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketUserReply === true):
	add_hook('TicketUserReply', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => ticketFix($vars['subject']) . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => ticketFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Reply by User'
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true
						),
						array(
							'name' => 'Ticket ID',
							'value' => '#' . $vars['ticketmask'],
							'inline' => true
						),
						array(
							'name' => 'Message',
							'value' => $vars['message'],
							'inline' => true
						)
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketFlagged === true):
	add_hook('TicketFlagged', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A ticket has been flagged to ' . $vars['adminname'] . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Flagged'
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketNewNote === true):
	add_hook('TicketAddNote', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Ticket Note Has Been Added' . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => ticketFix($vars['message']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Note Added'
					),
					'fields' => array(
						array(
							'name' => 'Message',
							'value' => $vars['message'],
							'inline' => true
						),
						array(
							'name' => 'Attachments',
							'value' => $vars['attachments'],
							'inline' => true
						)
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketAdminReply === true):
	add_hook('TicketAdminReply', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => ticketFix($vars['subject']) . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Reply by ' . $vars['admin']
					),
					'fields' => array(
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						),
						array(
							'name' => 'Department',
							'value' => $vars['deptname'],
							'inline' => true
						),
						array(
							'name' => 'Ticket ID',
							'value' => '#' . $vars['ticketid'],
							'inline' => true
						),
						array(
							'name' => 'Message',
							'value' => $vars['message'],
							'inline' => true
						)
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketClose === true):
	add_hook('TicketClose', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A ticket has been Closed' . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Close'
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketDelete === true):
	add_hook('TicketDelete', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A ticket has been Delete' . ' - #' . $vars['ticketid'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Delete'
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

if($ticketMerge === true):
	add_hook('TicketMerge', 1, function($vars)	{
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A ticket has been Merge' . ' - #' . $vars['masterTicketId'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['masterTicketId'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Ticket Merge'
					)
				)
			)
		);
		ticketNotification($dataPacket);
	});
endif;

// if($ticketStatusChange === true):
// 	add_hook('TicketStatusChange', 1, function($vars)	{
// 		$dataPacket = array(
// 			'content' => $GLOBALS['discordGroupID'],
// 			'username' => $GLOBALS['companyName'],
// 			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
// 			'embeds' => array(
// 				array(
// 					'title' => 'A Ticket Status Change' . ' - #' . $vars['ticketid'],
// 					'url' => $GLOBALS['whmcsAdminURL'] . 'supporttickets.php?action=view&id=' . $vars['ticketid'],
// 					'timestamp' => date(DateTime::ISO8601),
// 					'color' => $GLOBALS['discordColor'],
// 					'author' => array(
// 						'name' => 'Ticket Status Change'
// 					),
// 					'fields' => array(
// 						array(
// 							'name' => 'Status',
// 							'value' => $vars['status'],
// 							'inline' => true
// 						)
// 					)
// 				)
// 			)
// 		);
// 		ticketNotification($dataPacket);
// 	});
// endif;

function ticketNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['ticketWebHookURL']);
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

function ticketFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
