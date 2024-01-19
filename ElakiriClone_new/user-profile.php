<?php
require_once("header.php");
// require_once("connection.php");
$email = $_GET['email'];
// $email = "samanali@gmail.com";


// $cid = "aa";



$userRs = Database::search("SELECT * FROM `users` WHERE email = '" . $email . "'");
$usNro = $userRs->num_rows;
if ($usNro == 1) {
    $userData = $userRs->fetch_assoc();
}

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$ndate = $d->format("Y-m-d H:i:s");

echo "<script>


let hsrc = document.getElementById('serachMaindiv');

hsrc.style.display  = 'none';


</script>"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/header/Forum-logo.png">
    <link href="http://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css" integrity="sha512-9YHSK59/rjvhtDcY/b+4rdnl0V4LPDWdkKceBl8ZLF5TB6745ml1AfluEU6dFWqwDw9lPvnauxFgpKvJqp7jiQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/user-profile.css">
</head>

<body>
    <div class="user-container">
        <div class="profile-edit-container">
            <div class="profile-card">


                <?php
                if (isset($_SESSION["user_email"])) {
                    if ($_SESSION['user_email'] ==  $email) {

                ?>
                        <span class="edit-click"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit Profile</span>

                    <?php
                    } else {
                    ?>

                        <span style="display: none;" class="edit-click"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit Profile</span>
                <?php
                    }
                }
                ?>
                <!-- <div class="image-holder" style="background-image: url(./images/profile_pic/user.svg);">
                    <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                    <label class="top-logo-label" for="top-logo">
                        <i style="color:  rgba(48, 47, 46, 0.897);" class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                        <h5 style="color: rgba(48, 47, 46, 0.897);">Upload Profile pic</h5>
                    </label>
                </div> -->

                <?php
                $picrs = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $userData["email"] . "' ");

                $picrow = $picrs->num_rows;

                if ($picrow == "1") {
                    $picData = $picrs->fetch_assoc();
                ?>

                    <div class="image-holder" style="background-image: url(./images/profile_pic/<?php echo $picData["image"] ?>);">
                        <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                        <label class="top-logo-label" for="top-logo">
                            <i style="color:  rgba(48, 47, 46, 0.897);" class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                            <h5 style="color: rgba(48, 47, 46, 0.897);">Upload Profile pic</h5>
                        </label>
                    </div>

                <?php
                } else {
                ?>
                    <div class="image-holder" style="background-image: url(./images/profile_pic/user.svg);">
                        <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                        <label style="display: none;" class="top-logo-label" for="top-logo">
                            <i style="color:  rgba(48, 47, 46, 0.897); " class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                            <h5 style="color: rgba(48, 47, 46, 0.897);">Upload Profile pic</h5>
                        </label>
                    </div>
                    <?php
                }
                if (isset($_SESSION["user_email"])) {
                    if ($_SESSION['user_email'] ==  $email) {

                    ?>

                        <span class="user-name"><?php echo $userData["username"]  ?></span>
                <?php
                    }
                }
                ?>
                <span class="user-name"><?php echo $userData["fname"] . " " . $userData["lname"] ?></span>
                <span class="user-mail"><?php echo $userData["email"] ?></span>



                <?php
                if (isset($_SESSION['user_email'])) {
                    $followrs = Database::search("SELECT * FROM `follow` WHERE `email` = '" . $email . "' AND `followed_email` = '" . $_SESSION["user_email"] . "' ");

                    $followrow = $followrs->num_rows;
                    $followdata = $followrs->fetch_assoc();


                    $followCountrs = Database::search("SELECT * FROM `follow` WHERE `email` = '" . $email . "' AND `unfollow` = '0' ");

                    $countrow = $followCountrs->num_rows;

                ?>

                    <span>
                        <i class='fas fa-user-friends' style='font-size:15px;color:gray'></i>&nbsp;&nbsp; <?php echo $countrow ?>
                    </span>

                    <button class="picsave" onclick="verify('<?php echo $email ?>');" id="profpicSave">Save profile picture</button>
                    <?php

                    if ($followrow == "1") {

                        if ($followdata["unfollow"] == "0") {
                    ?>
                            <button onclick="follow('<?php echo $email ?>');" style="background-color: rgb(200, 200, 199); color:black" id="picSave" class="follow-click">Followed</button>
                        <?php
                        } else {
                        ?>
                            <button onclick="follow('<?php echo $email ?>');" id="picSave" class="follow-click">Follow</button>

                        <?php
                        }
                    } else {
                        ?>
                        <button onclick="follow('<?php echo $email ?>');" id="picSave" class="follow-click">Follow</button>

                <?php
                    }
                }
                ?>

            </div>

            <?php
            if (isset($_SESSION["user_email"])) {
                if ($_SESSION['user_email'] ==  $email) {

            ?>
                    <div class="edit-card">

                        <div class="user-input-container">
                            <input id="fname" type="text" placeholder="First Name">
                            <input id="lname" type="text" placeholder="Last Name">
                            <input id="em" type="email" placeholder="User Name">
                            <input id="psw" type="password" placeholder="current  Password">
                        </div>
                        <div class="btn-con">
                            <button class="cancel-click">Cancel</button>
                            <button class="save-click">Save Profile</button>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div style="display: none;" class="edit-card">

                        <div class="user-input-container">
                            <input id="fname" type="text" placeholder="First Name">
                            <input id="lname" type="text" placeholder="Last Name">
                            <input id="em" type="email" placeholder="User Name">
                            <input id="psw" type="password" placeholder="current  Password">
                        </div>
                        <div class="btn-con">
                            <button class="cancel-click">Cancel</button>
                            <button class="save-click">Save Profile</button>
                        </div>
                    </div>
            <?php
                }
            }
            ?>



        </div>

        <div class="container-header">
            <div class="container-title">All Posts</div>

            <div style="display: none;" class="sort-cont">
                <div class="sort-lable">Sort by :</div>
                <select name="" id="">
                    <option value="name">name</option>
                    <option value="reg-date">reg-date</option>
                    <option value="reg-date">blocked</option>
                </select>
            </div>
        </div>

        <!--             POSTS                  -->

        <div class="member-container">

            <?php


            $frpostrs = Database::search("SELECT * FROM `post` WHERE  `user_email` ='" . $userData["email"] . "' ");
            $frRow = $frpostrs->num_rows;
            if ($frRow > 0) {
                $viewRs =  " AND `view_id` = '1' ";
                for ($f = 1; $f <= $frRow; $f++) {

                    $frpostData = $frpostrs->fetch_assoc();








                    $hidepost = " ";
                    if (isset($_SESSION["user_email"])) {

                        if ($userData["email"] != $_SESSION["user_email"]) {

                            $hidepost = " AND `hidden` = '0' ";

                            if ($frpostData["view_id"] == "2") {
                                $frindRS = Database::search("SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $frpostData["user_email"] . "'  AND `unfollow` = '0'");
                                $friendData = $frindRS->num_rows;
                                // echo "  s";
                                if ($friendData == "1") {
                                    $viewRs = " AND NOT  `view_id` = '3' ";
                                } else {
                                    $viewRs =  " AND `view_id` = '1' ";
                                }
                            } else {
                                $viewRs =  " AND `view_id` = '1' ";
                            }
                        } else {
                            $hidepost = " AND `hidden` = '0' ";
                            $viewRs =  "  ";
                        }
                    } else {
                        $hidepost = " AND `hidden` = '0' ";
                    }

                    // echo $viewRs;
                    // $postrs = Database::search("SELECT * FROM `post` WHERE  `user_email` ='" . $userData["email"] . "'  $hidepost  $viewRs  ");
                    $postrs = Database::search("SELECT * FROM `post` WHERE  `id` ='" . $frpostData["id"] . "'  $hidepost  $viewRs  ");
                    $postNrow = $postrs->num_rows;
                    // $p = "SELECT * FROM `post` WHERE  `id` ='" . $frpostData["id"] . "'  $hidepost  $viewRs";

                    // echo $p;
                    if ($postNrow > 0) {

                        // for ($i = 1; $i <= $postNrow; $i++) {

                        $postdata = $postrs->fetch_assoc();

                        $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $postdata["id"] . "' ");
                        $Vnrow = $viewsrs->num_rows;

                        $file_name = $postdata["media"];
                        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            ?>

                        <div onclick="viewpost('<?php echo $postdata['id'] ?>')" class="post-block">
                            <div class="general-post-model">
                                <div class="post-image-holder">
                                    <?php

                                    if ($file_extension == "mp3") {

                                    ?>

                                        <img src="images/post/audio/Audio_CD.png" alt="" class="post-image">
                                    <?php

                                    } elseif ($file_extension == "mp4") {
                                    ?>

                                        <img src="images/post/video/Video-icon.png" alt="" class="post-image">


                                    <?php
                                    } else {

                                    ?>

                                        <img src="images/post/image/<?php echo $postdata["media"] ?>" alt="" class="post-image">
                                    <?php
                                    }

                                    ?>
                                </div>

                                <?php

                                $postdate1 = new DateTime($postdata["date"]);
                                $postdate2 = new DateTime($ndate);


                                $postdatearray = explode(" ", $postdata["date"]);

                                $postinterval = $postdate1->diff($postdate2);

                                $Tcommentrs = Database::search("SELECT * FROM `comments` WHERE `post_id` = '" . $postdata["id"] . "' ORDER BY `date_time` DESC");
                                $tcnrow = $Tcommentrs->num_rows;

                                $Tlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $postdata["id"] . "' AND `react_id` = '1' ");
                                $Tlikenrow = $Tlikers->num_rows;
                                // echo $likenrow;

                                $Tdislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $postdata["id"] . "' AND `react_id` = '2' ");
                                $Tdislikenrow = $Tdislikers->num_rows;

                                ?>

                                <div class="post-details-container">
                                    <div class="post-main-details">
                                        <div class="post-subject"><?php echo $postdata["post_title"] ?></div>
                                        <div class="post-author"><?php echo $userData["fname"] . " " . $userData["lname"] ?></div>
                                    </div>
                                    <div class="post-sub-details">

                                        <?php
                                        $reportRs = Database::search("SELECT * FROM `report`  WHERE `post_id` = '" .  $postdata["id"] . "'  ");
                                        $reportnumRow = $reportRs->num_rows;
                                        // echo $pid;

                                        if ($reportnumRow > 4) {
                                            $reportData = $reportRs->fetch_assoc();
                                        ?>


                                            <div class="post-sub-details-blocked-cont">
                                                <span>Your Post is Reported</span>
                                                <span class="view-reported-note-sub"><?php echo $reportData['tittle'] ?></span>
                                            </div>

                                        <?php
                                        } else if ($frpostData["view_id"] == "3") {
                                            // $reportData = $reportRs->fetch_assoc();
                                        ?>


                                            <div class="post-sub-details-blocked-cont">
                                                <span>only me!</span>
                                                <!-- <span class="view-reported-note-sub"><?php echo $reportData['tittle'] ?></span> -->
                                            </div>

                                        <?php
                                        }
                                        ?>


                                        <div class="post-created-con">
                                            <div class="post-created-date"><?php if ($postinterval->y > 0) {
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
                                            <div class="con-lable">posted date</div>
                                        </div>
                                        <div class="post-views-con">
                                            <div class="post-views"><?php echo $Vnrow ?></div>
                                            <div class="con-lable">views</div>
                                        </div>
                                        <div class="post-com-con">
                                            <div class="post-com-count"><?php echo $tcnrow ?></div>
                                            <div class="con-lable">comments</div>
                                        </div>
                                        <div class="like-dis-con">
                                            <div class="like-con">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                                <div class="like-count"><?php echo $Tlikenrow ?></div>
                                            </div>
                                            <div class="dis-con">
                                                <i class="fa-solid fa-thumbs-down"></i>
                                                <div class="dislike-count"><?php echo $Tdislikenrow ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                <?php
                        // }
                    }
                }
            } else {
                ?>
                <div style="text-align: center;" class="">empty</div>
            <?php
            }
            ?>

            <!-- <div class="post-block">
                <div class="general-post-model">
                    <div class="post-image-holder">
                        <img src="" alt="" class="post-image">
                    </div>
                    <div class="post-details-container">
                        <div class="post-main-details">
                            <div class="post-subject">Here is the title of the post</div>
                            <div class="post-author">author name</div>
                        </div>
                        <div class="post-sub-details">
                            <div class="post-created-con">
                                <div class="post-created-date">2023/04/01</div>
                                <div class="con-lable">posted date</div>
                            </div>
                            <div class="post-views-con">
                                <div class="post-views">1400</div>
                                <div class="con-lable">views</div>
                            </div>
                            <div class="post-com-con">
                                <div class="post-com-count">100</div>
                                <div class="con-lable">comments</div>
                            </div>
                            <div class="like-dis-con">
                                <div class="like-con">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <div class="like-count">10</div>
                                </div>
                                <div class="dis-con">
                                    <i class="fa-solid fa-thumbs-down"></i>
                                    <div class="dislike-count">5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="post-block">
                <div class="general-post-model">
                    <div class="post-image-holder">
                        <img src="" alt="" class="post-image">
                    </div>
                    <div class="post-details-container">
                        <div class="post-main-details">
                            <div class="post-subject">Here is the title of the post</div>
                            <div class="post-author">author name</div>
                        </div>
                        <div class="post-sub-details">
                            <div class="post-created-con">
                                <div class="post-created-date">2023/04/01</div>
                                <div class="con-lable">posted date</div>
                            </div>
                            <div class="post-views-con">
                                <div class="post-views">1400</div>
                                <div class="con-lable">views</div>
                            </div>
                            <div class="post-com-con">
                                <div class="post-com-count">100</div>
                                <div class="con-lable">comments</div>
                            </div>
                            <div class="like-dis-con">
                                <div class="like-con">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <div class="like-count">10</div>
                                </div>
                                <div class="dis-con">
                                    <i class="fa-solid fa-thumbs-down"></i>
                                    <div class="dislike-count">5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> -->


        </div>
    </div>

    <script src="js/user-profile.js"></script>
    <script src="js/category.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <?php
    if (isset($_SESSION["user_email"])) {
        if ($email == $_SESSION["user_email"]) {
    ?>

            <script>
                ownerView();

                // alert("s")
            </script>

    <?php
        }
    }
    ?>
</body>

</html>