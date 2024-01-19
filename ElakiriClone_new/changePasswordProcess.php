<?php
require("connection.php");


$newpsw = $_POST["newpsw"];
$psw = $_POST["psw"];
$psw = $_POST["psw"];
$email = $_POST["email"];

// echo $cuemail;
// echo $oldpsw;
// echo $em;

if (empty($psw)) {
    echo "please enter new password!";
} elseif (empty($newpsw)) {
    echo "please enter your re-enter password!";
} elseif (strlen($psw) <= 5 || strlen($psw) >= 20) {
    echo "password length should be between 6 to 20!";
} elseif ($psw != $newpsw) {
    echo "re-enter password invalid!";
} else {

    $hash = hash("sha256", $psw);

    Database::iud("UPDATE `users` SET `password`='" . $hash . "' WHERE `email`='" . $email . "'");


    echo "success";
}
