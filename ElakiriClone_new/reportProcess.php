<?php
require "connection.php";
session_start();

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$ndate = $d->format("Y-m-d H:i:s");

$content = $_POST["content"];
$postId = $_POST["postId"];

Database::iud("INSERT INTO `report` (`report_email`,`post_id`,`tittle`) VALUES ('" . $_SESSION["user_email"] . "','" . $postId . "','" . $content . "')");
$last_id = Database::$connecrtion->insert_id;
$repotRs = Database::search("SELECT * FROM `report` WHERE `post_id` = '" . $postId . "' AND `tittle` = '" . $content . "' ");
$reportnumR = $repotRs->num_rows;

// echo $reportnumR;
if ($reportnumR >= "5") {

    Database::iud("UPDATE `post` SET `hidden` = '1' WHERE `id` = '" . $postId . "' ");
    Database::iud("UPDATE `report` SET `status` = '1' WHERE `post_id` = '" . $postId . "' ");

    Database::iud("INSERT INTO `report_notificaion` (`post_id`,`block`,`datetime`) VALUES('" . $postId . "','1','" . $ndate . "') ");
    echo "removepost";
} else {




    Database::iud("INSERT INTO `report_notificaion` (`post_id`,`datetime`) VALUES('" . $postId . "','" . $ndate . "') ");

    echo "success";
}
