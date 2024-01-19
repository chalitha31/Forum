<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];


if (empty($email)) {
    echo "please enter your Email";
    exit();
} else if (empty($password)) {
    echo "please enter your Password";
    exit();
} else {

    $hash = hash("sha256", $password);

    $resultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $hash . "' ");
    $n = $resultset->num_rows;



    if ($n == 1) {

        $data = $resultset->fetch_assoc();

        if ($data["blocked"] == "0") {

            $storeHash = $data["password"];


            // compare the resulting hash value to the stored hash value

            if ($hash === $storeHash) {


                session_regenerate_id();
                $_SESSION["user_fname"] = $data["fname"];
                $_SESSION["user_lname"] = $data["lname"];
                $_SESSION["user_email"] = $data["email"];
                $_SESSION["username"] = $data["username"];


                if ($rememberMe == "true") {
                    setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                    setcookie("password", $password, time() + (60 * 60 * 24 * 365));
                } else {

                    setcookie("email", "", -1);
                    setcookie("password", "", -1);
                }

                $Adrs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $data["email"] . "' ");
                if ($Adrs->num_rows == 1) {

                    echo "admin";
                } else {
                    echo "user";
                }


                exit();
            } else {

                echo "Please Check your Password";
                exit();
            }
        } else {
            echo "Sorry! You have been blocked by admin.";
            exit();
        }
    } else {

        echo "Invalid Email  Or Password";
        exit();
    }
}
