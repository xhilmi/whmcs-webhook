<?php

///////////////////////////////////////////////////////////////////////
////////////////////////// Hooks Module Area //////////////////////////
///////////////////////////////////////////////////////////////////////
// Configure the below variables to allow the script to work correct and connect to both your WHMCS install and Discord channel.
// NOTE: Be careful not to accidentily remove any of the " characters when copying and pasting details into the script.

// Your Discord WebHook URL.
$GLOBALS['moduleWebHookURL'] = "<DISCORD_URL>";
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

// Module Notifications
$moduleCreate = true;                   // Module Suspend Notification
$moduleCreateFailed = true;             // Module Suspend Notification
$moduleSuspend = true;                  // Module Suspend Notification
$moduleUnsuspend = true;                // Module Unsuspend Notification
$moduleTerminate = true;                // Module Terminate Notification
$moduleTerminate2 = true;               // Module Terminate2 Notification
$moduleTerminateFailed = true;          // Module Terminate Failed Notification


///////////////////////////////////////////////////////////////////////
////////  Don't edit below unless you know what you're doing.   ///////
///////////////////////////////////////////////////////////////////////

if($moduleCreate === true):
	add_hook('AfterModuleCreate', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Create'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)	
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

if($moduleCreateFailed === true):
	add_hook('AfterModuleCreateFailed', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Create Failed'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)	
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

if($moduleSuspend === true):
	add_hook('AfterModuleSuspend', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Suspended'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)	
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

if($moduleUnsuspend === true):
	add_hook('AfterModuleUnsuspend', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Unsuspended'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

if($moduleTerminate === true):
	add_hook('AfterModuleTerminate', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Terminate'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

if($moduleTerminate2 === true):
	add_hook('PreModuleTerminate', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Pre Terminate'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;


if($moduleTerminateFailed === true):
	add_hook('AfterModuleTerminateFailed', 1, function($vars) {
		$dataPacket = array(
			'content' => $GLOBALS['discordGroupID'],
			'username' => $GLOBALS['companyName'],
			'avatar_url' => $GLOBALS['discordWebHookAvatar'],
			'embeds' => array(
				array(
					'title' => $vars ['params']['producttype'] . ' - ' . $vars['params']['domain'],
					'url' => $GLOBALS['whmcsAdminURL'] . 'clientsservices.php?userid=' . $vars['params']['userid'] . '&id=' . $vars['params']['serviceid'],
					'timestamp' => date(DateTime::ISO8601),
					'description' => '',
					'color' => $GLOBALS['discordColor'],
					'author' => array(
						'name' => 'Service Terminate Failed'
					),
					'fields' => array(
						array(
							'name' => 'User ID',
							'value' => '#' . $vars['params']['userid'],
							'inline' => true
						),
						array(
							'name' => 'Service ID',
							'value' => '#' . $vars['params']['serviceid'],
							'inline' => true
						),
						array(
							'name' => 'Product ID',
							'value' => '#' . $vars['params']['pid'],
							'inline' => true
						),
						array(
							'name' => 'Username',
							'value' => '#' . $vars['params']['username'],
							'inline' => true
						)
					)
				)
			)
		);
		moduleNotification($dataPacket);
	});
endif;

function moduleNotification($dataPacket)	{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $GLOBALS['moduleWebHookURL']);
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

function moduleFix($value){
	if(strlen($value) > 150) {
		$value = trim(preg_replace('/\s+/', ' ', $value));
		$valueTrim = explode( "\n", wordwrap( $value, 150));
		$value = $valueTrim[0] . '...';
	}
	$value = mb_convert_encoding($value, "UTF-8", "HTML-ENTITIES"); // Allows special characters to be displayed on Discord.
	return $value;
}

?>
