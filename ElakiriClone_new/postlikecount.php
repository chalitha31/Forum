<?php
require "connection.php";

$pid = $_GET["pid"];

$object2 = new stdClass();
$object2->data = array();

$Tlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pid . "' AND `react_id` = '1' ");
$Tlikenrow = $Tlikers->num_rows;
// echo $likenrow;

$Tdislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pid . "' AND `react_id` = '2' ");
$Tdislikenrow = $Tdislikers->num_rows;


$object2->likec = $Tlikenrow;
$object2->dislc = $Tdislikenrow;

$likejosn2 = json_encode($object2);

echo $likejosn2;
