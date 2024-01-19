<?php
require_once("connection.php");

$email = $_POST["email"];
$comment = $_POST["comment"];
$pid = $_POST["pid"];

if (empty($comment)) {
    echo "please enter a comment";
    exit();
} else {
    $d = new DateTime();
    $tz = new DateTimezone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i;s");

    Database::iud("INSERT INTO `comments` (`user_email`,`post_id`,`comment`,`date_time`) VALUES('" . $email . "','" . $pid . "','" . $comment . "','" . $date . "')");
    echo "success";
}
