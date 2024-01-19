<?php
require "connection.php";

$email =  $_GET["email"];
$pid = $_GET["pid"];
$ststus = $_GET["ststus"];

$resultset = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
$nrow = $resultset->num_rows;
if ($nrow == 1) {
    $rdata = $resultset->fetch_assoc();

    if ($ststus == "like") {

        if ($rdata["react_id"] == 1) {

            Database::iud("UPDATE `reaction` SET `react_id` = '3' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "removelike";
        } elseif ($rdata["react_id"] == 2) {

            Database::iud("UPDATE `reaction` SET `react_id` = '1' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "like";
        } elseif ($rdata["react_id"] == 3) {

            Database::iud("UPDATE `reaction` SET `react_id` = '1' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "like";
        }
    } else {

        if ($rdata["react_id"] == 1) {

            Database::iud("UPDATE `reaction` SET `react_id` = '2' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "dislike";
        } elseif ($rdata["react_id"] == 2) {

            Database::iud("UPDATE `reaction` SET `react_id` = '3' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "removelike";
        } elseif ($rdata["react_id"] == 3) {

            Database::iud("UPDATE `reaction` SET `react_id` = '2' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
            echo "dislike";
        }
    }
} else {


    if ($ststus == "like") {



        Database::iud("UPDATE `reaction` SET `react_id` = '1' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
        echo "like";
    } else {



        Database::iud("UPDATE `reaction` SET `react_id` = '2' WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
        echo "dislike";
    }
}
