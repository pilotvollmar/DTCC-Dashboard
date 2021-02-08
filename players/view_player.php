<?php include "../include/components/head.php";
include "../include/elements.php";


// SQL ADDITIONS
// players table + backstory +av_full +steam_link
// public_players +av_full +backstory +steam_link
// 

isset ($_GET["id"]) ? $player_id = $_GET["id"] : $player_id = null;
$pInfo = CollectPlayerInfo($player_id);

function CollectPlayerInfo($steam_id)
{
    $pInfo = new stdClass();
    $pInfo->public_player = getPublicPlayer($steam_id);
    $pInfo->app_history = getApps($steam_id);
    $pInfo->warnings = getStrikes($steam_id);
    $pInfo->public_verified_shifts = getShiftData($steam_id);
    $pInfo->test_history = getTests($steam_id);
    $pInfo->notes = getNotes($steam_id);
    return $pInfo;
}




function getPublicPlayer($steam_id)
{
    $pInfo = Query("SELECT * from `public_players` where `steam_id` = '$steam_id'");
    if($pInfo)
    {   return $pInfo[0];
    }
    else{
        return null;
    }
}

function getSumShifts($steam_id)
{
    $sql = "SELECT SUM(`duration`) as `sum` FROM `public_verified_shifts` WHERE `steam_id`='$steam_id'";
    return Query($sql)[0]->sum;
}

function getShiftData($steam_id)
{
    $sql = "SELECT * FROM `public_verified_shifts` WHERE `steam_id` = '$steam_id'";
    return Query($sql);
}

function getTests($steam_id)
{
    $sql = "SELECT * FROM `test_history` WHERE `steam_id` = '$steam_id'";
    return Query($sql);
}

function getApps($steam_id)
{

    $sql = "SELECT * FROM `app_history` WHERE `steam_id` = '$steam_id'";
    return Query($sql);
}
function getStrikes($steam_id)
{
    $sql = "SELECT * FROM `public_strikes` WHERE `steam_id` = '$steam_id'";
    return Query($sql);
}

function getMetas($type, $ver)
{
    $sql = "SELECT `pass_mark`,`max_score` FROM `tests_meta` WHERE `type`='$type' AND `version`='$ver'";
    return Query($sql)[0];
}

function getNotes($steam_id)
{
    $sql = "SELECT * FROM `notes` WHERE `doc_id` = '$steam_id' AND `doc_type` = 'player' ORDER BY `timestamp` DESC";
    return Query($sql);
}

if (isset($_POST['leaveNote'])) {
    isset($_SESSION["steam_id"]) ? $steam_id = $_SESSION["steam_id"] : $steam_id = null;
    $time = time();
    $doc_type = "player";
    $doc_id = $player_id;
    $message = quotefix($_POST['message']);
    $sql = "INSERT INTO private_notes (`doc_id`, `doc_type`, `steam_id`, `timestamp`, `message`) VALUES ('$doc_id','$doc_type','$steam_id','$time','$message')";
    Query($sql);
}


function PassFail($ret, $score_percent)
{
    $pass_percent = (round($ret->pass_mark / $ret->max_score, 2));
    //echo $score_percent . "/" . $pass_percent . "<br>";
    if ($score_percent >= $pass_percent) {
        return "PASS";
    } else {
        return "FAIL";
    }
}



if(Rank("Supervisor")) {
    include "elems/modals.php";
}
include "elems/profile.php";

include "../include/components/foot.php"; ?>