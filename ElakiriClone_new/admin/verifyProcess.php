<?php

session_start();
require "connection.php";

if (!isset($_GET["id"])) {

    echo "Please Enter Verification Code";
} else {

    $code = $_GET["id"];
    $rs = Database::search("SELECT * FROM `admin` WHERE `otp` = '" . $code . "' ");
    if ($rs->num_rows == 1) {
        $admin_data = $rs->fetch_assoc();
        $_SESSION["admin_type"] = $admin_data["admin_type_id"];
        echo "success";
    } else {
        echo "Invalid Code";
    }
}
