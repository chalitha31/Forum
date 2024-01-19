<?php

require("connection.php");
// require("sidebar.php");
session_start();

$pid = $_GET["pid"];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/view-post.css">
    <link rel="stylesheet" href="../css/comments.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="css/admin-view-post.css">
</head>

<body onload="loadcomment('<?php echo $pid; ?>')">

    <header>
        <div class="header-left">
            <a onclick="pageTravel('../home.php')"><img src="../images/header/Forum-logo.png" alt="LOGO" class="header-logo"></a>
        </div>
        <nav class="header-mid">
            <!-- <a class="navs nav" href="dashboard.php">Dashboard</a> -->
            <a class="navs" href="adminpannel.php">Members</a>
            <a class="navs" href="report-post.php">Report</a>
            <a class="navs " href="admin-posts.php">Posts</a>
            <?php
            if ($_SESSION["admin_type"] == "1") {
            ?>
                <a class="navs" href="admin-moderator.php">Moderators</a>
            <?php
            }
            ?>
        </nav>
        <div class="header-right">
            <a class="navsi" href="adminpannel.php"><i class="fa-solid fa-users"></i></a>
            <a class="navsi" href="report-post.php"><i class="fa-solid fa-shield-halved"></i></a>
            <a class="navsi nav-icon" href=""><i class="fa-solid fa-file"></i></a>
            <a class="navsi" href="admin-moderator.php"><i class="fa-solid fa-user-plus"></i></a>
        </div>
    </header>

    <div class="view-post-container">

        <?php
        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $ndate = $d->format("Y-m-d H:i:s");



        $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `id` = '" . $pid . "' ");
        $TrCtnrow = $CposttrendRS->num_rows;

        if ($TrCtnrow == 1) {

            $TrCtPostdata = $CposttrendRS->fetch_assoc();

            $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $TrCtPostdata["user_email"] . "'");
            $Anrow = $authorResult->num_rows;


            $Authordata = $authorResult->fetch_assoc();

            $file_name = $TrCtPostdata["media"];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        }


        $Tlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '1' ");
        $Tlikenrow = $Tlikers->num_rows;
        // echo $likenrow;

        $Tdislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '2' ");
        $Tdislikenrow = $Tdislikers->num_rows;



        $postdate1 = new DateTime($TrCtPostdata["date"]);
        $postdate2 = new DateTime($ndate);


        $postdatearray = explode(" ", $TrCtPostdata["date"]);

        $postinterval = $postdate1->diff($postdate2);

        if (isset($_SESSION["user_email"])) {

            $Tuserlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
            $Tuserlikenrow = $Tuserlikers->num_rows;
            if ($Tuserlikenrow == "1") {

                $Tuserlikedata = $Tuserlikers->fetch_assoc();
            }
        }

        $ViproRs  = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $Authordata["email"] . "'");
        $Vpicrow = $ViproRs->num_rows;
        ?>

        <div class="view-user-cont">
            <div class="view-user-sec-cont">
                <div class="view-user-pic-holder">
                    <?php
                    if ($Vpicrow == "1") {
                        $VpicData = $ViproRs->fetch_assoc();
                    ?>
                        <img src="../images/profile_pic/<?php echo $VpicData["image"] ?>" alt="user" class="view-user-pic">
                    <?php
                    } else {
                    ?>
                        <img src="../images/header/forum-user-img.avif" alt="user" class="view-user-pic">
                    <?php
                    }


                    ?>
                </div>
                <div class="view-user-des-cont">
                    <div class="view-user-name"><?php echo $Authordata["fname"] . " " . $Authordata["lname"] ?> </div>
                </div>
            </div>
            <!-- <button class="view-user-follow-btn followed-btn">Re list</button> -->
            <?php

            $reportRs = Database::search("SELECT * FROM `report`  WHERE `post_id` = '" . $pid . "'  ");
            $reportnumRow = $reportRs->num_rows;
            // echo $pid;

            if ($reportnumRow > 4) {
                $reportData = $reportRs->fetch_assoc();
            ?>


                <button style="background-color: lightgreen; color: black;" onclick="removepost('<?php echo $pid ?>','<?php echo $reportData['id'] ?>')" class="view-user-follow-btn ">Re list</button>


            <?php
            }
            ?>

        </div>



        <div class="post-title"><?php echo $TrCtPostdata["post_title"] ?></div>
        <div class="post-media-holder">

            <?php
            $removeRs = Database::search("SELECT * FROM `remove_post`  WHERE `post_id` = '" . $pid . "'  ");
            $removeRow = $removeRs->num_rows;


            if ($removeRow > "0") {
                $removeData = $removeRs->fetch_assoc();
            ?>

                <span class="view-reported-note">
                    <span>Post is removed</span>
                    <span class="view-reported-note-sub"><?php echo $removeData["reason"] ?></span>
                </span>


            <?php

            }

            if ($file_extension == "mp3") {
            ?>
                <img src="../images/post/audio/Audio_CD.png" alt="" class="post-audio post-media">
                <audio controls class="post-pic post-audio">
                    <source src="../images/post/audio/<?php echo $TrCtPostdata["media"] ?>" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>

            <?php

            } elseif ($file_extension == "mp4") {
            ?>
                <video controls class="post post-media">
                    <source src="../images/post/video/<?php echo $TrCtPostdata["media"] ?>" type="video/mp4">
                    Your browser does not support the video element.
                </video>

            <?php
            } else {

            ?>

                <img src="../images/post/image/<?php echo $TrCtPostdata["media"] ?>" alt="" class="post-media">
            <?php
            }

            ?>
            <!-- <img src="images/home/post-pic-2.png" alt="" class="post-media"> -->

        </div>


        <p class="post-text-content">
            <?php echo $TrCtPostdata["post_content"] ?>
        </p>

        <div class="post-details">
            <div class="post-date"><?php if ($postinterval->y > 0) {
                                        echo $postdatearray[0];
                                    } elseif ($postinterval->m > 0) {
                                        echo $postdatearray[0];
                                    } elseif ($postinterval->days > 0) {
                                        echo $postinterval->days . " " . "days ago";
                                    } elseif ($postinterval->h > 0) {
                                        echo $postinterval->h . " " . "hours ago";
                                    } elseif ($postinterval->i > 0) {
                                        echo $postinterval->i . " " . "minutes ago";
                                    } elseif ($postinterval->s > 0) {
                                        echo $postinterval->s . " " . "seconds ago";
                                    } else {
                                        echo "just now";
                                    } ?></div>
            <?php
            if (isset($_SESSION["user_email"])) { ?>

                <div class="like-dis-con">



                    <div class="like-con">


                        <i id="likeb" onclick="like('<?php echo $_SESSION['user_email'] ?>','<?php echo $pid ?>','like')" class="likedefault fa-solid fa-thumbs-up <?php if ($Tuserlikedata["react_id"] == "1") {
                                                                                                                                                                        echo "like";
                                                                                                                                                                    } ?>"></i>

                        <div id="like-count" class="like-count"><span></span></div>
                    </div>
                    <div class="dis-con">
                        <i id="dislikeb" onclick="like('<?php echo $_SESSION['user_email'] ?>','<?php echo $pid ?>','dis')" class="likedefault fa-solid fa-thumbs-down <?php if ($Tuserlikedata["react_id"] == "2") {
                                                                                                                                                                            echo "dislike";
                                                                                                                                                                        } ?>"></i>
                        <div id="dislike-count" class="dislike-count"><span></span></div>
                    </div>
                </div>
            <?php
            } else {
            ?>

                <div class="like-dis-con">

                    <div class="like-con">

                        <i class="likedefault fa-solid fa-thumbs-up"></i>
                        <div class="like-count"><?php echo $Tlikenrow ?></div>
                    </div>
                    <div class="dis-con">
                        <i class="likedefault fa-solid fa-thumbs-down "></i>
                        <div class="dislike-count"><?php echo $Tdislikenrow ?></div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>



        <?php
        $commentrs = Database::search("SELECT * FROM `comments` WHERE `post_id` = '" . $pid . "' ORDER BY `date_time` DESC");
        $cnrow = $commentrs->num_rows;
        ?>

        <div class="comments">
            <div class="comment-header">
                <div class="nmbr-of-comments"><span id="numofcomment"><?php echo $cnrow ?></span> Comments</div>
                <!-- <div class="sort">
        <img class="sort-icon" src="images/coments/short-by.svg" alt="short" />
        <div>SORT BY</div>
    </div> -->
            </div>
            <div class="user-comment-container">
                <div class="user-pic-holder">
                    <img class="user-pic" src="../images/coments/user.svg" alt="user" />
                </div>
                <input class="comment-bar" id="comment" type="text" placeholder="Add a comment..." disabled />

            </div>
            <!--BELOW **This is the Main reply unit 1 -->

            <div id="loadcomment">

            </div>


        </div>


    </div>
    <script src="js/admin-common.js"></script>
    <!-- <script src="js/reaction.js"></script>
    <script src="js/bookmark.js"></script> -->
</body>

</html>