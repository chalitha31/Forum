<?php
require "connection.php";

$pid = $_GET["id"];

// echo $pid;
$repotRs = Database::search("SELECT * FROM `post` WHERE `id` = '" . $pid . "'  ");
$reportnumR = $repotRs->num_rows;

if ($reportnumR == "1") {

    Database::iud("UPDATE `post` SET `hidden` = '1' WHERE `id` = '" . $pid . "' ");

    echo "success";
} else {

    echo "error";
}
