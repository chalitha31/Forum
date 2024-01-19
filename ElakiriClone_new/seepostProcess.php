<?php
require "connection.php";

$pid = $_GET["pid"];
$view = $_GET["view"];

$viewId = 1;

if ($view == "public") {
    $viewId = "1";
} elseif ($view == "followers") {
    $viewId = "2";
} elseif ($view == "private") {
    $viewId = "3";
}
// echo $viewId;

$postrs = Database::search("SELECT * FROM `post` WHERE  `id` ='" . $pid . "' ");
$postNrow = $postrs->num_rows;

if ($postNrow > 0) {

    // $postdata = $postrs->fetch_assoc();

    Database::iud("UPDATE `post` SET `view_id` = '" . $viewId . "' WHERE `id` = '" . $pid . "' ");

    echo "success";
} else {
    echo "error";
}
