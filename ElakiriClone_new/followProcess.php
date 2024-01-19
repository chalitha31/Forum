<?php
require("connection.php");
session_start();


$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$ndate = $d->format("Y-m-d H:i:s");

$email = $_GET["email"];
// echo $_SESSION["user_email"];

$followrs = Database::search("SELECT * FROM `follow` WHERE `email` = '" . $email . "' AND `followed_email` = '" . $_SESSION["user_email"] . "' ");

$followrow = $followrs->num_rows;
$followData = $followrs->fetch_assoc();

if ($followrow == "1") {

    if ($followData["unfollow"] == "1") {

        Database::iud("UPDATE `follow` SET `unfollow` = '0' WHERE `id` = '" . $followData["id"] . "' ");
        Database::iud("INSERT INTO `follow_notification` (`follow_id`,`datetime`) VALUES('" . $followData["id"] . "','" . $ndate . "') ");
        echo "following";
    } else {

        Database::iud("UPDATE `follow` SET `unfollow` = '1' WHERE `id` = '" . $followData["id"] . "' ");
        echo "unfollow";
    }

    // Database::iud("DELETE FROM `follow` WHERE `email` = '" . $email . "' AND `followed_email` = '" . $_SESSION["user_email"] . "'  ");

} else {
    Database::iud("INSERT INTO `follow` (`email`, `followed_email`) VALUES('" . $email . "','" . $_SESSION["user_email"] . "') ");

    $last_id = Database::$connecrtion->insert_id;

    Database::iud("INSERT INTO `follow_notification` (`follow_id`,`datetime`) VALUES('" . $last_id . "','" . $ndate . "') ");


    echo "following";
}
