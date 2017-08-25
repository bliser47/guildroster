<?php  
require_once('apiClient.php');
require_once('utils.php');
/*
Plugin Name: Guild Roster
Description: Shows guild roster of Eventide (raiders and trials)
Author: Kas
Version: 0.1
*/

function getGuildMembers($_realmName, $_guildName)
{
    $guildRoster = (new ApiClient())->getGuildRoster($_realmName, $_guildName);
    return $guildRoster['response']['guildList'];
}

function getBannedNamesFromRoster()
{
    return array(
        "Stormcell",
        "Bjwithteeth",
        "Taxigrim",
        "Edwoo",
        "Junate",
        "Léxane",
        "Cuckerson",
        "Tiggers",
        "Bigmong"
    );
}

function getBannedRanksFromRoster()
{
    return array(
        6, 7, 20
    );
}

function isBannedMemberName($_memberName)
{
    return in_array($_memberName, getBannedNamesFromRoster());
};

function isBannedMemberRank($_memberRank)
{
    return in_array($_memberRank, getBannedRanksFromRoster());
}


function isBannedMember($_member)
{
    return isBannedMemberName($_member["name"]) || isBannedMemberRank($_member["rank"]);
}

function printRoster($guildRoster) 
{
    $guildMembers = getGuildMembers("[EN] Evermoon","Eventide");
    usort($guildMembers,function($m1,$m2){
        return $m1["rank"] > $m2["rank"];
    });
    $output = "<table>";
    foreach ( $guildMembers as $guildMember )
    {
        if ( isBannedMember($guildMember) )
        {
            continue;
        }
        $memberName = $guildMember["name"];
        $memberRank = $guildMember["rank"];
        $memberClassCodename = getClassCodename($guildMember["class"]);

        $output .= "<tr>";
            $output .= "<td>";
                $output .= "<div class='wr-class-text wr-" . $memberClassCodename . "'>" . $memberName . "</div>";
            $output .= "</td>";
            $output .= "<td>";
                $output .= "<div class='wr-icon wr-" . $memberClassCodename . "'></div>";
            $output .= "</td>";
        $output .= "</tr>";
    }
    $output .= "</table>";
    echo $output;
}
    


add_shortcode('roster', 'printRoster');

?>