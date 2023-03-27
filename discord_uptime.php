<?php

///////////////////////////////////////////////////////////////////////
////////////////////////// Hooks Uptime Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['uptimeWebHookURL'] = "<DISCORD_URL>";
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

// Network Issue Notifications
$networkIssueAdd = true;            // New Network Issue Added Notification
$networkIssueEdit = true;           // Network Issue Edited Notification
$networkIssueClosed = true;         // Network Issue Closed Notification
$networkIssueReopen = true;         // Network Issue Re-Open Notification
$networkIssueDeleted = true;        // Network Issue Deleted Notification

///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($networkIssueAdd === true):
	add_hook('NetworkIssueAdd', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A New Network Issue Has Been Created',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => uptimeFix($vars['description']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'New Network Issue'
					),
					'fields' => array(
						array(
							'name' => 'Start Date',
							'value' => $vars['startdate'],
							'inline' => true
						),
						array(
							'name' => 'End Date',
							'value' => $vars['enddate'],
							'inline' => true
						),
						array(
							'name' => 'Title',
							'value' => uptimeFix($vars['title']),
							'inline' => true
						),
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						)
					)
				)
			)
		);
		uptimeNotification($dataPacket);
	});
endif; 

if($networkIssueEdit === true):
	add_hook('NetworkIssueEdit', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Edited',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => uptimeFix($vars['description']),
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Edited'
					),
					'fields' => array(
						array(
							'name' => 'Start Date',
							'value' => $vars['startdate'],
							'inline' => true
						),
						array(
							'name' => 'End Date',
							'value' => $vars['enddate'],
							'inline' => true
						),
						array(
							'name' => 'Title',
							'value' => uptimeFix($vars['title']),
							'inline' => true
						),
						array(
							'name' => 'Priority',
							'value' => $vars['priority'],
							'inline' => true
						)
					)
				)
			)
		);
		uptimeNotification($dataPacket);
	});
endif; 

if($networkIssueClosed === true):
	add_hook('NetworkIssueClose', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Closed',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Closed'
					)
				)
			)
		);
		uptimeNotification($dataPacket);
	});
endif;

if($networkIssueReopen === true):
	add_hook('NetworkIssueReopen', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Re-Open',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Re-Open'
					)
				)
			)
		);
		uptimeNotification($dataPacket);
	});
endif;

if($networkIssueDeleted === true):
	add_hook('NetworkIssueDeleted', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => 'A Network Issue Has Been Deleted',
					'url' => $GLOBALS['whmcsAdminURL'] . 'networkissues.php?action=manage&id=' . $vars['id'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Network Issue Deleted'
					)
				)
			)
		);
		uptimeNotification($dataPacket);
	});
endif;

function uptimeNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['uptimeWebHookURL']);
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

function uptimeFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
