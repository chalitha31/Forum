<?php
session_start();
require "connection.php";

if (isset($_SESSION["user_email"])) {

    $id = $_GET["id"];
    $mail = $_SESSION["user_email"];
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("y-m-d H:i:s");
    $bookmarklistrs = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $id . "' AND `user_email` = '" . $mail . "' ");

    if ($bookmarklistrs->num_rows >= 1) {
        Database::iud("DELETE FROM `bookmark` WHERE `postid`='" . $id . "' AND `user_email` = '" . $mail . "' ");
        echo "Succes2";
    } else {

        Database::iud("INSERT INTO `bookmark` (`postid`,`user_email`,`date`) VALUES('" . $id . "','" . $mail . "','" . $date . "')");
        echo "Success";
    }
} else {
    echo "You Have to Sign In First";
}
