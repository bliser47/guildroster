<?php  
require_once('apiClient.php');

/*
Plugin Name: Guild Roster
Description: Shows guild roster of Eventide (raiders and trials)
Author: Kas
Version: 0.1
*/

	function getClassColor($classCode) {
		switch($classCode) {
			case 11:
				return "#FF7D0A";
			case 1:
				return "#C79C6E";
			case 2:
				return "#F58CBA";
			case 3:
				return "#ABD473";
			case 4:
				return "#FFF569";
			case 5:
				return "#FFFFFF";
			case 6:
				return "#C41F3B";
			case 7:
				return "#0070DE";
			case 8:
				return "#69CCF0";
			case 9:
				return "#9482C9";
			case 10:
				return "#00FF96";
			default:
				return "#000000";
		}
	}
	function getRace($code) {
		switch($code) {
			
			case 2:
				return 'Orc';
			case 5:
				return 'Undead';
			case 6:
				return 'Tauren';
			case 9:
				return 'Gnome';
			case 8:
				return 'Troll';
			case 10:
				return 'Blood Elf';
			case 26:
				return 'Pandaren';
			default:
				return '';
			}
	}

	function printRoster($guildRoster) {
    $realm                = "[EN] Evermoon";
    $guild                = "Eventide";
    $client               = new ApiClient ();
    $response             = $client->getGuildRoster($realm, $guild);
    $guildRoster          = $response['response']['guildList'];
    //print_r($guildRoster);
	    foreach ($guildRoster as $member) {
	    	if($member['rank_name'] == 'Trial' || $member['rank_name'] == 'Raider' 
	    		||  $member['rank_name'] == 'Officer') {
          echo '<h1 style="color: ' . 
      		getClassColor($member['class']) . 
      		';">' . 
      		$member['name'] . "</h1>" . "     " . "<b>" . $member['rank_name'] . "</b>" . " "  .getRace($member['race']). "<br>";
      		}
        }
        echo $totalTrials;

	}
    


    add_shortcode('roster', 'printRoster');

  ?>