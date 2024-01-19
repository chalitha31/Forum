<?php

require("header.php");
require("sidebar.php");

$pid = $_GET["pid"];

if (isset($_SESSION["user_email"])) {
    $checkusr = 1;
} else {
    $checkusr = 2;
}

echo "<script>


let hsrc = document.getElementById('serachMaindiv');

hsrc.style.display  = 'none';


</script>"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/view-post.css">
    <link rel="stylesheet" href="css/comments.css">
    <link rel="stylesheet" href="css/common.css">
</head>

<body onload="loadcomment('<?php echo $pid; ?>'),   likedislikecount('<?php echo $pid; ?>');">



    <div class="view-post-container">

        <?php
        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $ndate = $d->format("Y-m-d H:i:s");

        if (isset($_SESSION["user_email"])) {

            $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pid . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
            $Vnrow = $viewsrs->num_rows;
            if ($Vnrow == 1) {

                $viewsData = $viewsrs->fetch_assoc();
                // echo $viewsData["views"];
                // $viewCount =  $viewsData["views"] + 1;

                // Database::iud("UPDATE `reaction` SET `views` = '" . $viewCount . "' WHERE `id` = '" . $viewsData["id"] . "'");
            } else {

                Database::iud("INSERT INTO `reaction` (`post_id`,`react_id`,`user_email`) VALUES('" . $pid . "','3','" . $_SESSION["user_email"] . "')");
            }
        }

        $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `id` = '" . $pid . "'  ");
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
                        <img onclick='profileview("<?php echo $Authordata["email"] ?>");' src="./images/profile_pic/<?php echo $VpicData["image"] ?>" alt="user" class="view-user-pic">
                    <?php
                    } else {
                    ?>
                        <img onclick='profileview("<?php echo $Authordata["email"] ?>");' src="./images/header/forum-user-img.avif" alt="user" class="view-user-pic">
                    <?php
                    }


                    ?>

                </div>
                <div class="view-user-des-cont">
                    <div onclick='profileview("<?php echo $Authordata["email"] ?>");' class="view-user-name"><?php echo $Authordata["fname"] . " " . $Authordata["lname"] ?> </div>

                    <?php
                    if (isset($_SESSION['user_email'])) {
                        $followrs = Database::search("SELECT * FROM `follow` WHERE `email` = '" . $Authordata["email"] . "' AND `followed_email` = '" . $_SESSION["user_email"] . "' ");

                        $followrow = $followrs->num_rows;
                        $followdata = $followrs->fetch_assoc();



                        if ($followrow == "1") {



                            if ($followdata["unfollow"] == "0") {
                    ?>
                                <button onclick="follow('<?php echo $Authordata['email'] ?>');" id="picSave" class="view-user-follow-btn followed-btn">Followed</button>
                            <?php
                            } else {
                            ?>
                                <button onclick="follow('<?php echo $Authordata['email'] ?>');" id="picSave" class="view-user-follow-btn ">Follow</button>

                            <?php
                            }
                        } else {
                            ?>
                            <button onclick="follow('<?php echo $Authordata['email'] ?>');" id="picSave" class="view-user-follow-btn ">Follow</button>

                    <?php
                        }
                    }
                    ?>
                    <!-- <button class="view-user-follow-btn followed-btn">Followed</button> -->
                    <!-- <div style="margin-bottom: -30px; align-self: flex-end;"><i class="bi bi-three-dots-vertical"></i></div> -->
                </div>
            </div>
            <?php
            if (isset($_SESSION["user_email"])) {
                if ($Authordata["email"] == $_SESSION["user_email"]) {
            ?>
                    <i class="fa-solid fa-ellipsis fa-rotate-90  view-type-dots"></i>


                    <div class="view-type-cont">
                        <input onclick="viewpost('<?php echo $pid ?>','public')" type="radio" name="asvvt" class="vvti" id="vt1" <?php if ($TrCtPostdata["view_id"] == "1") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt1" class="vvl">Public</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input onclick="viewpost('<?php echo $pid ?>','followers')" type="radio" name="asvvt" class="vvti" id="vt2" <?php if ($TrCtPostdata["view_id"] == "2") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt2" class="vvl">Followers</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input onclick="viewpost('<?php echo $pid ?>','private')" type="radio" name="asvvt" class="vvti" id="vt3" <?php if ($TrCtPostdata["view_id"] == "3") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt3" class="vvl">Private</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input type="radio" name="asvvt" class="vvti" id="vt4">
                        <label for="vt4" class="vvl">Edit</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input onclick="deletepost('<?php echo $pid ?>')" type="radio" name="asvvt" class="vvti" id="vt5">
                        <label for="vt5" class="vvl">Delete</label>
                        <i class="fa-solid fa-check vvt"></i>
                    </div>

                <?php
                } else {
                ?>

                    <i style="display: none;" class="fa-solid fa-ellipsis fa-rotate-90  view-type-dots"></i>


                    <div style="display: none;" class="view-type-cont">
                        <input onclick="viewpost('<?php echo $pid ?>','public')" type="radio" name="asvvt" class="vvti" id="vt1" <?php if ($TrCtPostdata["view_id"] == "1") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt1" class="vvl">Public</label>
                        <i class="fa-solid fa-check vvt"></i>
                        <input onclick="viewpost('<?php echo $pid ?>','followers')" type="radio" name="asvvt" class="vvti" id="vt2" <?php if ($TrCtPostdata["view_id"] == "2") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt2" class="vvl">Followers</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input onclick="viewpost('<?php echo $pid ?>','private')" type="radio" name="asvvt" class="vvti" id="vt3" <?php if ($TrCtPostdata["view_id"] == "3") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                        <label for="vt3" class="vvl">Private</label>
                        <i class="fa-solid fa-check vvt"></i>


                        <input type="radio" name="asvvt" class="vvti" id="vt4">
                        <label for="vt4" class="vvl">Edit</label>
                        <i class="fa-solid fa-check vvt"></i>

                        <input type="radio" name="asvvt" class="vvti" id="vt5">
                        <label for="vt5" class="vvl">Delete</label>
                        <i class="fa-solid fa-check vvt"></i>

                    </div>

                <?php
                }
            } else {
                ?>

                <i style="display: none;" class="fa-solid fa-ellipsis fa-rotate-90  view-type-dots"></i>


                <div style="display: none;" class="view-type-cont">
                    <input onclick="viewpost('<?php echo $pid ?>','public')" type="radio" name="asvvt" class="vvti" id="vt1" <?php if ($TrCtPostdata["view_id"] == "1") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                    <label for="vt1" class="vvl">Public</label>
                    <i class="fa-solid fa-check vvt"></i>
                    <input onclick="viewpost('<?php echo $pid ?>','followers')" type="radio" name="asvvt" class="vvti" id="vt2" <?php if ($TrCtPostdata["view_id"] == "2") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                    <label for="vt2" class="vvl">Followers</label>
                    <i class="fa-solid fa-check vvt"></i>
                    <input onclick="viewpost('<?php echo $pid ?>','private')" type="radio" name="asvvt" class="vvti" id="vt3" <?php if ($TrCtPostdata["view_id"] == "3") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                    <label for="vt3" class="vvl">Private</label>
                    <i class="fa-solid fa-check vvt"></i>


                    <input type="radio" name="asvvt" class="vvti" id="vt4">
                    <label for="vt4" class="vvl">Edit</label>
                    <i class="fa-solid fa-check vvt"></i>

                    <input type="radio" name="asvvt" class="vvti" id="vt5">
                    <label for="vt5" class="vvl">Delete</label>
                    <i class="fa-solid fa-check vvt"></i>

                </div>

            <?php
            }
            ?>
        </div>


        <div class="post-title">

            <?php echo $TrCtPostdata["post_title"] ?>
        </div>


        <div class="post-media-holder">

            <?php

            if (isset($_SESSION["user_email"])) {
                if ($_SESSION["user_email"] == $TrCtPostdata["user_email"]) {

                    // $reportRs = Database::search("SELECT * FROM `report`  WHERE `post_id` = '" . $pid . "'  ");
                    $reportRs = Database::search("SELECT tittle, COUNT(*) AS event_count FROM report  WHERE `post_id` = '" . $pid . "' GROUP BY tittle HAVING COUNT(*) >= 5");
                    $reportnumRow = $reportRs->num_rows;
                    // echo $_SESSION["user_email"];
                    // echo $TrCtPostdata["user_email"];

                    if ($reportnumRow > 0) {
                        $reportData = $reportRs->fetch_assoc();
            ?>

                        <span class="view-reported-note">
                            <span>Your Post is Reported</span>
                            <span class="view-reported-note-sub"><?php echo $reportData["tittle"] ?></span>
                        </span>



            <?php
                    }
                }
            }
            ?>


            <?php

            if ($file_extension == "mp3") {
            ?>
                <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio post-media">
                <audio controls class="post-pic post-audio">
                    <source src="images/post/audio/<?php echo $TrCtPostdata["media"] ?>" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>

            <?php

            } elseif ($file_extension == "mp4") {
            ?>
                <video controls class="post post-media">
                    <source src="images/post/video/<?php echo $TrCtPostdata["media"] ?>" type="video/mp4">
                    Your browser does not support the video element.
                </video>

            <?php
            } else {

            ?>

                <img src="images/post/image/<?php echo $TrCtPostdata["media"] ?>" alt="" class="post-media">
            <?php
            }

            ?>
            <!-- <img src="images/home/post-pic-2.png" alt="" class="post-media"> -->

        </div>


        <div class="post-text-content"> <?php echo $TrCtPostdata["post_content"] ?> </div>

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

                <div class="report-holder">
                    <span class="report-tag"><i class="fa-regular fa-flag"></i>&nbsp;Report</span>
                    <div class="report-container">
                        <h4 class="report-heading">report content</h4>
                        <div class="report-list">
                            <input class="rep-radio" value="<?php echo $pid ?>" type="radio" name="report-mark" id="l1">
                            <label for="l1">sexual content</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l2">
                            <label for="l2">Violent or repulsive content</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l3">
                            <label for="l3">Hateful or abusive content</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l4">
                            <label for="l4">Harassment or bullying</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l5">
                            <label for="l5">Harmful or dangerous acts</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l6">
                            <label for="l6">Child abuse</label>
                            <input value="<?php echo $pid ?>" class="rep-radio" type="radio" name="report-mark" id="l7">
                            <label for="l7">Spam or misleading</label>
                        </div>
                        <div class="option-container">
                            <span class="rep-cancel">cancel</span>
                            <span class="rep-finish">report</span>
                        </div>
                    </div>
                </div>

                <div class="like-dis-con">

                    <div class="like-con">


                        <?php
                        if ($checkusr == 1) {
                            $bookmarkss = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $pid . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                            if ($bookmarkss->num_rows == 1) {

                        ?>

                                <i style=" color: #1d8ae9;" onclick="addToBookmark('<?php echo $pid ?>'); " class=" fa-solid fa-bookmark vp-bookm bookmark<?php echo $pid; ?>" id="bookmark<?php echo $pid; ?>"></i>
                            <?php

                            } else {

                            ?>
                                <i style=" color: gray;" onclick="addToBookmark('<?php echo $pid ?>');" class=" fa-solid fa-bookmark vp-bookm bookmark<?php echo $pid; ?>" id="bookmark<?php echo $pid; ?>"></i>
                            <?php
                            }
                        } else {

                            ?>
                            <i style=" color: gray;" onclick="addToBookmark('<?php echo $pid ?>');" class=" fa-solid fa-bookmark vp-bookm bookmark<?php echo $pid; ?>" id="bookmark<?php echo $pid; ?>"></i>

                        <?php
                        }

                        ?>

                    </div>

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
                        <i style=" color: gray;" class=" fa-solid fa-bookmark vp-bookm "></i>
                    </div>
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
                <?php
                if (isset($_SESSION["user_email"])) { ?>
                    <div class="user-pic-holder">
                        <?php
                        $proRs  = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $_SESSION["user_email"] . "'");
                        $picrow = $proRs->num_rows;
                        if ($picrow == "1") {
                            $picData = $proRs->fetch_assoc();
                        ?>
                            <img onclick='profileview("<?php echo $_SESSION["user_email"] ?>");' class="user-pic" src="images/profile_pic/<?php echo $picData["image"] ?>" alt="user" />
                        <?php
                        } else {
                        ?>
                            <img onclick='profileview("<?php echo $_SESSION["user_email"] ?>");' class="user-pic" src="images/profile_pic/user.svg" alt="user" />
                        <?php
                        }
                        ?>

                    </div>
                    <input class="comment-bar" id="comment" type="text" placeholder="Add a comment..." />

                    <i onclick="sendcomment('<?php echo $_SESSION['user_email'] ?>','<?php echo $pid ?>')" class="fa-solid fa-circle-chevron-up"></i>

                <?php
                } else {
                ?>
                    <div class="user-pic-holder">

                        <img onclick='profileview("<?php echo $_SESSION["user_email"] ?>");' class="user-pic" src="images/profile_pic/user.svg" alt="user" />


                    </div>
                    <input class="comment-bar" id="comment" type="text" placeholder="Add a comment..." />

                    <i onclick="nousercomment()" class="fa-solid fa-circle-chevron-up"></i>

                <?php

                }
                ?>
            </div>
            <!--BELOW **This is the Main reply unit 1 -->

            <div id="loadcomment">

            </div>


        </div>


    </div>

    <script src="js/reaction.js"></script>
    <!-- <script src="js/user-profile.js"></script> -->
    <script src="js/bookmark.js"></script>
    <script src="js/view-post.js"></script>
    <script src="js/deletepost.js"></script>
</body>

</html>