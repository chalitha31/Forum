<?php
require "connection.php";
session_start();

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$em = $_POST["em"];
$psw = $_POST["psw"];
// echo $fname;
// echo $lname;
$uniqName = 0;
$noimage = false;

if (empty($_FILES["pimg"])) {

    // $uniqName = "user.svg";
    $uniqName = $_POST["pimg"];
    $noimage = false;
    // echo  $pimg;
} else {

    $pimg = $_FILES["pimg"];
    // $img = $pimg["name"];

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

        $noimage = true;
    }
}



$userrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $_SESSION["user_email"] . "'  ");
$UserNumrow = $userrs->num_rows;
if ($UserNumrow == 1) {
    $hash = hash("sha256", $psw);
    $userData = $userrs->fetch_assoc();

    $storeHash = $userData["password"];

    if ($hash === $storeHash) {

        if ($noimage == true) {

            $userpicrs = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $_SESSION["user_email"] . "'  ");
            $picNumrow = $userpicrs->num_rows;
            if ($picNumrow == 1) {

                Database::iud("UPDATE `profile_pic` SET `image` = '" . $uniqName . "' WHERE `email` = '" . $_SESSION["user_email"] . "' ");
            } else {
                Database::iud("INSERT INTO `profile_pic` (`image`,`email`) VALUES ('" . $uniqName . "','" . $_SESSION["user_email"] . "')");
            }
        }

        Database::iud("UPDATE `users` SET `fname` = '" . $fname . "' ,  `lname` = '" . $lname . "',  `username` = '" . $em . "' WHERE `email` = '" . $_SESSION["user_email"] . "' ");

        $_SESSION["user_fname"] = $fname;
        $_SESSION["user_lname"] = $lname;
        // $_SESSION["user_email"] = $data["email"];
        $_SESSION["username"] = $em;
    } else {

        echo "Invalid your Password";
        exit();
    }
    echo "success";
}


// echo $fname;
// echo $lname;
// echo $em;
// echo $psw;
// echo $img;
