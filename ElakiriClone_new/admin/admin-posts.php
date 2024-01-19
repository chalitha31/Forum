<!-- <?php

        session_start();
        require "connection.php";
        ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin-pannel.css">
    <title>Admin Posts</title>
</head>

<body>
    <!-- <h1>Welcome adminpannel</h1>

    <?php
    if ($_SESSION["admin_type"] == "1") {
    ?>
    <h2>Welcome Super Admin</h2>
    <?php
    } else {
    ?>
    <h2>Welcome Moderator</h2>
    <?php
    }
    ?> -->

    <header>
        <div class="header-left">
            <a onclick="pageTravel('../home.php')"><img src="../images/header/Forum-logo.png" alt="LOGO" class="header-logo"></a>
        </div>
        <nav class="header-mid">
            <!-- <a class="navs nav" href="dashboard.php">Dashboard</a> -->
            <a class="navs" href="adminpannel.php">Members</a>
            <a class="navs" href="report-post.php">Report</a>
            <a class="navs nav-active" href="">Posts</a>
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


    <div class="admin-container">
        <div class="container-header">
            <div class="container-title">All Members</div>
            <div class="search-main-cont">
                <div class="search-cont">
                    <input id="postserch" onkeyup="postSearch()" type="text" class="search-by" placeholder="Search by Name">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="search-filter-con">
                    <p>search by</p>
                    <div class="filter-con">
                        <div>
                            <input type="radio" id="all" name="search-filter" value="all" checked>
                            <label onclick="catSearch(1)" for="all">All</label>
                        </div>
                        <div>
                            <input type="radio" id="title" name="search-filter" value="title">
                            <label onclick="catSearch(2)" for="title">name</label>
                        </div>
                        <div>
                            <input type="radio" id="cat" name="search-filter" value="category">
                            <label onclick="catSearch(3)" for="cat">Category</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sort-cont">
                <div class="sort-lable">Sort by :</div>
                <select name="" id="shortpost" onchange="postsort()">
                    <option value="all">All</option>
                    <option value="unblock">Available posts</option>
                    <option value="block">blocked post</option>
                    <!-- <option value="block">removed post</option> -->
                </select>
            </div>
        </div>
        <div id="postResult" class="member-container">

            <?php

            $d = new DateTime();
            $tz = new DateTimezone("Asia/Colombo");
            $d->setTimezone($tz);
            $ndate = $d->format("Y-m-d H:i:s");

            $CposttrendRS = Database::search("SELECT * FROM `post`");
            $TrCtnrow = $CposttrendRS->num_rows;
            if ($TrCtnrow > 0) {
                for ($n = 1; $n <= $TrCtnrow; $n++) {
                    $TrCtPostdata = $CposttrendRS->fetch_assoc();

                    $TrCaresultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $TrCtPostdata["category_id"] . "' ");
                    $CDname = $TrCaresultset->fetch_assoc();

                    $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' ");
                    $Vnrow = $viewsrs->num_rows;

                    $file_name = $TrCtPostdata["media"];
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            ?>

                    <div class="post-block">
                        <div class="post-number"><?php echo $n ?>.</div>

                        <div style="<?php if ($TrCtPostdata["hidden"] == "1") {
                                        echo "border: 1px solid red;";
                                    } ?>" onclick="adminviewpost('<?php echo $TrCtPostdata['id'] ?>')" class="general-post-model">
                            <div class="post-image-holder">
                                <?php

                                if ($file_extension == "mp3") {
                                ?>
                                    <!-- <audio controls class="post-pic">
<source src="images/post/audio/<?php echo $TrCtPostdata["media"] ?>" type="audio/mp3">
Your browser does not support the audio element.
</audio> -->
                                    <img src="../images/post/audio/Audio_CD.png" alt="" class="post-audio">
                                <?php

                                } elseif ($file_extension == "mp4") {
                                ?>

                                    <img src="../images/post/video/Video-icon.png" alt="" class="post-audio">
                                    <!-- <video controls class="post">
                                        <source src="images/post/video/<?php echo $TrCtPostdata["media"] ?>" type="video/mp4">
                                        Your browser does not support the video element.
                                    </video> -->

                                <?php
                                } else {

                                ?>

                                    <img src="../images/post/image/<?php echo $TrCtPostdata["media"] ?>" alt="" class="post-pic">
                                <?php
                                }

                                ?>
                            </div>
                            <div class="post-details-container">
                                <div class="post-main-details">
                                    <div class="post-subject"><?php echo $TrCtPostdata["post_title"] ?></div>

                                    <?php

                                    $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $TrCtPostdata["user_email"] . "'");
                                    $Anrow = $authorResult->num_rows;
                                    if ($Anrow == 1) {

                                        $Authordata = $authorResult->fetch_assoc();
                                    }

                                    $Tlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '1' ");
                                    $Tlikenrow = $Tlikers->num_rows;
                                    // echo $likenrow;

                                    $Tdislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '2' ");
                                    $Tdislikenrow = $Tdislikers->num_rows;

                                    if (isset($_SESSION["user_email"])) {

                                        $Tuserlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                        $Tuserlikenrow = $Tuserlikers->num_rows;
                                        if ($Tuserlikenrow == "1") {

                                            $Tuserlikedata = $Tuserlikers->fetch_assoc();
                                        }
                                    }



                                    $postdate1 = new DateTime($TrCtPostdata["date"]);
                                    $postdate2 = new DateTime($ndate);


                                    $postdatearray = explode(" ", $TrCtPostdata["date"]);

                                    $postinterval = $postdate1->diff($postdate2);
                                    ?>

                                    <div class="post-author"><?php echo $Authordata["fname"] . " " . $Authordata["lname"] ?></div>
                                    <div class="post-author"><?php echo $Authordata["email"] ?></div>
                                </div>
                                <div class="post-sub-details">
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

                                    <?php
                                    $Tcommentrs = Database::search("SELECT * FROM `comments` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' ORDER BY `date_time` DESC");
                                    $tcnrow = $Tcommentrs->num_rows;
                                    ?>

                                    <div class="post-com-con">
                                        <div class="post-com-count"><?php echo $tcnrow ?></div>
                                        <div class="con-lable">comments</div>
                                    </div>


                                    <div class="like-dis-con">
                                        <div class="like-con">
                                            <!-- <i class="likedefault fa-solid fa-bookmark"></i> -->


                                        </div>
                                        <div class="like-con">
                                            <i class="likedefault fa-solid fa-thumbs-up <?php if ($Tuserlikedata["react_id"] == "1") {
                                                                                            echo "like";
                                                                                        } ?>"></i>
                                            <div class="like-count"><?php echo $Tlikenrow ?></div>
                                        </div>
                                        <div class="dis-con">
                                            <i class="likedefault fa-solid fa-thumbs-down <?php if ($Tuserlikedata["react_id"] == "2") {
                                                                                                echo "dislike";
                                                                                            } ?>"></i>
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
                <div class="post-number">1.</div>
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
    <script src="js/admin-panel.js"></script>
</body>

</html>