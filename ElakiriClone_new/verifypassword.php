<?php
require("connection.php");

$cuemail = $_POST["email"];
$oldpsw = $_POST["oldpsw"];
$em = $_POST["em"];

// echo $cuemail;
// echo $oldpsw;
// echo $em;

if (empty($em)) {
    echo "please enter your email address!";
} elseif (empty($oldpsw)) {
    echo "please enter your current password!";
} elseif ($em != $cuemail) {
    echo "invalid email address!";
} else {
    // echo "success!";

    $hash = hash("sha256", $oldpsw);

    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $em . "' AND `password` = '" . $hash . "' ");
    $n = $resultset->num_rows;

    if ($n == 1) {

        echo "success";
        // $data = $resultset->fetch_assoc();
    } else {
        echo "invalid password!";
    }
}
