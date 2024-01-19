<?php
// require_once("header.php");
require_once("connection.php");
session_start();
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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/user-profile.css">
    <link rel="stylesheet" href="css/admin-pannel.css">
</head>

<body>

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

    <div class="user-container">
        <div class="profile-edit-container">
            <div class="profile-card">
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

                    <div class="image-holder" style="background-image: url(../images/profile_pic/<?php echo $picData["image"] ?>);">
                        <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                        <label class="top-logo-label" for="top-logo">
                            <i style="color:  rgba(48, 47, 46, 0.897);" class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                            <h5 style="color: rgba(48, 47, 46, 0.897);">Upload Profile pic</h5>
                        </label>
                    </div>

                <?php
                } else {
                ?>
                    <div class="image-holder" style="background-image: url(../images/profile_pic/user.svg);">
                        <input class="top-logo-upload-input" type="file" accept="image/*" name="image" id="top-logo" style="display:none;">
                        <label class="top-logo-label" for="top-logo">
                            <i style="color:  rgba(48, 47, 46, 0.897);" class="fa-solid fa-cloud-arrow-up upload-top-img"></i>
                            <h5 style="color: rgba(48, 47, 46, 0.897);">Upload Profile pic</h5>
                        </label>
                    </div>
                <?php
                }
                ?>

                <span class="user-name"><?php echo $userData["username"]  ?></span>
                <span class="user-name"><?php echo $userData["fname"] . " " . $userData["lname"] ?></span>
                <span class="user-mail"><?php echo $userData["email"] ?></span>
                <button id="picSave" class="follow-click" style="display: none;">Follow</button>
            </div>
            <div class="edit-card">
                <span class="edit-click"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit Profile</span>
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

            $postrs = Database::search("SELECT * FROM `post` WHERE  `user_email` ='" . $userData["email"] . "' ");
            $postNrow = $postrs->num_rows;

            if ($postNrow > 0) {

                for ($i = 1; $i <= $postNrow; $i++) {

                    $postdata = $postrs->fetch_assoc();

                    $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $postdata["id"] . "' ");
                    $Vnrow = $viewsrs->num_rows;

                    $file_name = $postdata["media"];
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);



            ?>

                    <div onclick="adminviewpost('<?php echo $postdata['id'] ?>')" class="post-block">
                        <div class="general-post-model">
                            <div class="post-image-holder">
                                <?php

                                if ($file_extension == "mp3") {
                                ?>

                                    <img src="../images/post/audio/Audio_CD.png" alt="" class="post-image">
                                <?php

                                } elseif ($file_extension == "mp4") {
                                ?>

                                    <img src="../images/post/video/Video-icon.png" alt="" class="post-image">


                                <?php
                                } else {

                                ?>

                                    <img src="../images/post/image/<?php echo $postdata["media"] ?>" alt="" class="post-image">
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
                                    <!-- <div class="post-sub-details-blocked-cont">
                                        <span>Your Post is Reported</span>
                                        <span class="view-reported-note-sub">Oya pamkak krlane</span>
                                    </div> -->


                                    <?php
                                    $reportRs = Database::search("SELECT * FROM `report`  WHERE `post_id` = '" .  $postdata["id"] . "'  ");
                                    $reportnumRow = $reportRs->num_rows;
                                    // echo $pid;

                                    if ($reportnumRow > 4) {
                                        $reportData = $reportRs->fetch_assoc();
                                    ?>


                                        <div class="post-sub-details-blocked-cont">
                                            <span> Post is Reported</span>
                                            <span class="view-reported-note-sub"><?php echo $reportData['tittle'] ?></span>
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
                }
            } else {
                ?>
                <div style="text-align: center;" class="">no post!</div>
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

    <script src="js/admin-common.js"></script>
    <script src="../js/user-profile.js"></script>
    <!-- <script src="../js/category.js"></script> -->
    <?php
    if ($email == $_SESSION["user_email"]) {
    ?>

        <script>
            ownerView();

            // alert("s")
        </script>

    <?php
    }
    ?>
</body>

</html>