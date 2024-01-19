<?php
require "connection.php";

// $fname = $_POST["fname"];
// $lname = $_POST["lname"];
$email = $_POST["email"];


// if (empty($fname)) {

//     echo "Please enter First Name";
//     exit();
// } elseif (empty($lname)) {

//     echo "Please enter Last Name";
//     exit();
// } elseif (empty($email)) {

//     echo "Please enter add email";
//     exit();
// } else if (strlen($email) >= 100) {
//     echo "Email must be less than 100 characters";
//     exit();
// } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     echo "Invalid email Address";
//     exit();
// } else {

$emailAvailable = false;
$authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
$Anrow = $authorResult->num_rows;
if ($Anrow == 1) {
    $emailAvailable = true;
    // $Authordata = $authorResult->fetch_assoc();

}


if (empty($email)) {

    echo "Please Enter Modareter Email!";
    exit();
} else if ($emailAvailable == false) {
    echo "Please enter the registered email on this website!";
} else {

    $resultset = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");

    $nrow = $resultset->num_rows;

    if ($nrow > 0) {

        echo "Already using this email";
    } else {

        // Database::iud("INSERT INTO `admin` (`fname`,`lname`,`email`,`type`) VALUES('" . $fname . "','" . $lname . "','" . $email . "','2')");
        Database::iud("INSERT INTO `admin` (`email`,`admin_type_id`) VALUES('" . $email . "','2')");
        echo "success";
    }
}
