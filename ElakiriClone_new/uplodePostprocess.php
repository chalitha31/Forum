<?php
session_start();
require "connection.php";

$title = $_POST["title"];
$media = $_FILES["media"];
$postContent = $_POST["postContent"];
$cid = $_POST["cid"];

// echo ($postContent);

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
// $date = $d->format("Y-m-d");
$date = $d->format("Y-m-d H:i;s");

$allowed_image_extensions = array("image/jpeg", "image/jpg", "image/png", "image/svg", "image/webp");
$allowed_video_extensions = array("video/mp4", "video/avi", "video/mov");
$allowed_audio_extensions = array("audio/mpeg", "audio/mp3", "audio/wav", "audio/ogg", "audio/aac");

// Get the file extension of the uploaded file
$file_extension = $media["type"];
$file_tmp_name = $media["tmp_name"];

// echo $file_extension;
// echo $file_tmp_name;

if (in_array($file_extension, $allowed_image_extensions)) {
    // Process image upload

    $new_image_extension = $file_extension;

    if ($file_extension == "image/jpeg") {
        $new_image_extension = ".jpeg";
    } else if ($file_extension == "image/webp") {
        $new_image_extension = ".jpg";
    } else if ($file_extension == "image/jpg") {
        $new_image_extension = ".jpg";
    } else if ($file_extension == "image/png") {
        $new_image_extension = ".png";
    } else if ($file_extension == "image/svg") {
        $new_image_extension = ".svg";
    }

    $ImgProfuniq_name = uniqid() . $new_image_extension;
    $ProffileName = "images/post/image/" . $ImgProfuniq_name;

    move_uploaded_file($file_tmp_name, $ProffileName);

    // echo $title;
    // echo $ImgProfuniq_name;
    // echo $postContent;

    // Save image file information to the database

    Database::iud("INSERT INTO `post` (`user_email`,`category_id`,`post_title`,`media`,`post_content`,`date`) VALUES('" . $_SESSION["user_email"] . "','" . $cid . "','" . $title . "','" . $ImgProfuniq_name . "','" . $postContent . "','" . $date . "')");

    // Display success message or perform further actions
    echo "uploaded successfully";
} else if (in_array($file_extension, $allowed_video_extensions)) {
    // Process video upload

    $new_video_extension = $file_extension;

    if ($file_extension == "video/mp4") {
        $new_video_extension = ".mp4";
    } else if ($file_extension == "video/avi") {
        $new_video_extension = ".mp4";
    } else if ($file_extension == "video/mov") {
        $new_video_extension = ".mp4";
    }

    $VideoProfuniq_name = uniqid() . $new_video_extension;
    $ProffileName = "images/post/video/" . $VideoProfuniq_name;

    move_uploaded_file($file_tmp_name, $ProffileName);

    // echo $title;
    // echo $VideoProfuniq_name;
    // echo $postContent;

    // Save video file information to the database

    Database::iud("INSERT INTO `post` (`user_email`,`category_id`,`post_title`,`media`,`post_content`,`date`) VALUES('" . $_SESSION["user_email"] . "','" . $cid . "','" . $title . "','" . $VideoProfuniq_name . "','" . $postContent . "','" . $date . "')");

    // Display success message or perform further actions
    echo "uploaded successfully";
} else if (in_array($file_extension, $allowed_audio_extensions)) {
    // Process audio upload

    $allowed_audio_extensions = array("mp3", "wav", "ogg", "aac", "mpeg");

    $new_audio_extension = $file_extension;

    if ($file_extension == "audio/mp3") {
        $new_audio_extension = ".mp3";
    } else if ($file_extension == "audio/wav") {
        $new_audio_extension = ".mp3";
    } else if ($file_extension == "audio/ogg") {
        $new_audio_extension = ".mp3";
    } else if ($file_extension == "audio/aac") {
        $new_audio_extension = ".mp3";
    } else if ($file_extension == "audio/mpeg") {
        $new_audio_extension = ".mp3";
    }

    $AudioProfuniq_name = uniqid() . $new_audio_extension;
    $ProffileName = "images/post/audio/" . $AudioProfuniq_name;

    move_uploaded_file($file_tmp_name, $ProffileName);

    // echo $title;
    // echo $AudioProfuniq_name;
    // echo $postContent;

    // Save audio file information to the database

    Database::iud("INSERT INTO `post` (`user_email`,`category_id`,`post_title`,`media`,`post_content`,`date`) VALUES('" . $_SESSION["user_email"] . "','" . $cid . "','" . $title . "','" . $AudioProfuniq_name . "','" . $postContent . "','" . $date . "')");

    // Display success message or perform further actions
    echo "uploaded successfully";
} else {
    // File extension not allowed
    echo "Invalid file type.";
}
