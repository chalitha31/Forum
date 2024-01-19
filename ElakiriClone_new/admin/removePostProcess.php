<?php
require "connection.php";

$postID = $_GET["postId"];
$rid = $_GET["rid"];

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$ndate = $d->format("Y-m-d H:i:s");

// echo $postID;

$repotRs = Database::search("SELECT * FROM `report` WHERE `post_id` = '" . $postID . "' AND `id` = '" . $rid . "' ");
$reportnumR = $repotRs->num_rows;

if ($reportnumR > 0) {
    $reportData = $repotRs->fetch_assoc();
    if ($reportData["status"] == "0") {

        Database::iud("INSERT INTO `remove_post` (`post_id`,`reason`) VALUES('" . $postID . "','" . $reportData["tittle"] . "') ");

        Database::iud("INSERT INTO `post_notification` (`post_id`,`datetime`,`remove`) VALUES('" . $postID . "','" . $ndate . "','1') ");

        Database::iud("DELETE FROM `report` WHERE `post_id` = '" . $postID . "'");

        Database::iud("UPDATE `post` SET `hidden` = '1' WHERE `id` = '" . $postID . "' ");

        echo "blockpost";
    } else {
        Database::iud("DELETE FROM `report` WHERE `post_id` = '" . $postID . "'");

        Database::iud("INSERT INTO `post_notification` (`post_id`,`datetime`,`relist`) VALUES('" . $postID . "','" . $ndate . "','1') ");

        Database::iud("UPDATE `post` SET `hidden` = '0' WHERE `id` = '" . $postID . "' ");

        echo "success";
    }
} else {
    echo "error";
}
