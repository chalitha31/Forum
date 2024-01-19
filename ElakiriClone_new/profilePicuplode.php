<?php
require "connection.php";
session_start();

$pimg = $_FILES["pimg"];

echo $pimg["name"];
$allowd_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
$fileex = $pimg["type"];
// echo  $pimg["name"];
if (!in_array($fileex, $allowd_image_extention)) {

    echo "Please Select A Valid Image";
} else {

    $newimageextention;
    if ($fileex == "image/jpg") {
        $newimageextention = ".jpg";
    } else if ($fileex = "image/jpeg") {
        $newimageextention = ".jpeg";
    } else if ($fileex = "image/png") {
        $newimageextention = ".png";
    } else if ($fileex = "image/svg") {
        $newimageextention = ".svg";
    }

    $uniqName = uniqid() . $newimageextention;

    $file_name = "images//profile_pic//" . $uniqName;
    //   echo $file_name;
    move_uploaded_file($pimg["tmp_name"], $file_name);

    $userpicrs = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $_SESSION["user_email"] . "'  ");
    $picNumrow = $userpicrs->num_rows;
    if ($picNumrow == 1) {

        Database::iud("UPDATE `profile_pic` SET `image` = '" . $uniqName . "' WHERE `email` = '" . $_SESSION["user_email"] . "' ");
    } else {
        Database::iud("INSERT INTO `profile_pic` (`image`,`email`) VALUES ('" . $uniqName . "','" . $_SESSION["user_email"] . "')");
    }
}
