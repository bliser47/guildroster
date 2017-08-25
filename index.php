<?php  
require_once('apiClient.php');
require_once('utils.php');
/*
Plugin Name: Guild Roster
Description: Shows guild roster of Eventide (raiders and trials)
Author: Kas
Version: 0.1
*/

function printRoster($guildRoster) 
{
	$realm                = "[EN] Evermoon";
	$guild                = "Eventide";
	$client               = new ApiClient ();
	$response             = $client->getGuildRoster($realm, $guild);
	$guildRoster          = $response['response']['guildList'];
	foreach ($guildRoster as $member) {
		if($member['rank_name'] == 'Trial' || $member['rank_name'] == 'Raider' ||  $member['rank_name'] == 'Officer') {
			echo '<h1 style="color: ' . getClassColor($member['class']) . ';">' . member['name'] . "</h1>" . "     " . "<b>" . $member['rank_name'] . "</b>" . " "  .getRace($member['race']). "<br>";
		}
	}
	echo $totalTrials;

}
    


add_shortcode('roster', 'printRoster');

?>