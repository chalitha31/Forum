<?php
require "connection.php";

$email = $_GET["em"];
// echo $email;
$inrs = Database::search("SELECT * FROM `admin` WHERE `email` =  '" . $email . "'");

if ($inrs->num_rows == 1) {
    $indata = $inrs->fetch_assoc();

    if ($indata["blocked"] == '1') {
        Database::iud("UPDATE `admin` SET `blocked` = '0'  WHERE `email` = '" . $email . "'");
        echo "User Unblocked";
    } else if ($indata["blocked"] == '0') {
        Database::iud("UPDATE `admin` SET `blocked` = '1' WHERE `email` = '" . $email . "'");
        echo "User Blocked";
    }
} else {

    echo "no user";
}
