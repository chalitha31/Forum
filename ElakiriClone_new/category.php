<?php
require_once("header.php");
require_once("sidebar.php");

$cid = $_GET["cid"];


$TrCaresultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $cid . "' ");
$CDname = $TrCaresultset->fetch_assoc();



if (isset($_SESSION["user_email"])) {
    $checkusr = 1;
} else {
    $checkusr = 2;
}

// let serchC = document.getElementById('serchC');
echo "<script>



var radioButtons = document.querySelectorAll('.category-radio');

radioButtons.forEach(function(radioButton) {
 
    var serchC = radioButton.value;
    var serchid = radioButton.id;

    if(serchC == $cid){
  
    let radioElement = document.getElementById(serchid);
    let icollapse = document.getElementById('icollapse');

    if (radioElement) {
        radioElement.checked = true;
        icollapse.style.display = 'none';
        radioElement.classList.add('checked');
    }

    }
        
});

let hsrc = document.getElementById('hsrc');

hsrc.onclick = null;


hsrc.onclick = function() {

    search(1);
  
};


</script>"

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum <?php echo $CDname["name"] ?></title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/common.css">
</head>

<body>

    <div class="category-clicked-page">

        <div id="result" class="category-posts">

            <h1 class="cat-name" style="padding-left: 20px; color:#0a74a5;"><?php echo $CDname["name"] ?></h1>

            <div class="category-title red-highlight">Trending Posts</div>
            <div class="category-clicked-trending-container trend-box">

                <?php
                $d = new DateTime();
                $tz = new DateTimezone("Asia/Colombo");
                $d->setTimezone($tz);
                $ndate = $d->format("Y-m-d H:i:s");

                $Caresultset = Database::search("SELECT `post_id`, COUNT(`post_id`) AS `a` FROM `reaction` JOIN `post` ON `post`.`id` = `reaction`.`post_id`  WHERE `post`.`category_id` = '" . $cid . "' AND  `post`.`hidden` = '0' AND NOT `post`.`view_id` = '3' GROUP BY `post_id` ORDER BY `a` DESC  LIMIT 4");
                $Ctnrow = $Caresultset->num_rows;
                if ($Ctnrow > 0) {
                    for ($c = 0; $c < $Ctnrow; $c++) {
                        $CtPostdata = $Caresultset->fetch_assoc();


                        $viewRs =  " AND `view_id` = '1' ";

                        $frpostrs = Database::search("SELECT * FROM `post` WHERE  `id` = '" . $CtPostdata["post_id"] . "' ");
                        $frpostData = $frpostrs->fetch_assoc();



                        // echo $friendData;
                        // echo "  ";
                        if (isset($_SESSION["user_email"])) {
                            if ($frpostData["view_id"] == "2") {
                                $frindRS = Database::search("SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $frpostData["user_email"] . "'  AND `unfollow` = '0'");
                                $friendData = $frindRS->num_rows;
                                // $p = "SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $frpostData["user_email"] . "'";
                                // echo $p;
                                if ($friendData == "1") {
                                    $viewRs = " AND NOT  `view_id` = '3' ";
                                }
                            }
                        }

                        $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `id` = '" . $CtPostdata["post_id"] . "' AND `hidden` = '0'  $viewRs ");
                        $TrCtnrow = $CposttrendRS->num_rows;
                        if ($TrCtnrow > 0) {
                            for ($n = 0; $n < $TrCtnrow; $n++) {
                                $TrCtPostdata = $CposttrendRS->fetch_assoc();

                                $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' ");
                                $Vnrow = $viewsrs->num_rows;
                                // $views = 0;
                                // if ($Vnrow == 1) {

                                //     $viewsData = $viewsrs->fetch_assoc();
                                //     $views = $viewsData["views"];
                                // }


                                $file_name = $TrCtPostdata["media"];
                                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);


                ?>

                                <div onclick="viewpost('<?php echo $TrCtPostdata['id'] ?>')" class="general-post-model">
                                    <div class="post-image-holder">
                                        <?php

                                        if ($file_extension == "mp3") {
                                        ?>
                                            <!-- <audio controls class="post-pic">
<source src="images/post/audio/<?php echo $TrCtPostdata["media"] ?>" type="audio/mp3">
Your browser does not support the audio element.
</audio> -->
                                            <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                                        <?php

                                        } elseif ($file_extension == "mp4") {
                                        ?>

                                            <img src="images/post/video/Video-icon.png" alt="" class="post-audio">
                                            <!-- <video controls class="post">
                                        <source src="images/post/video/<?php echo $TrCtPostdata["media"] ?>" type="video/mp4">
                                        Your browser does not support the video element.
                                    </video> -->

                                        <?php
                                        } else {

                                        ?>

                                            <img src="images/post/image/<?php echo $TrCtPostdata["media"] ?>" alt="" class="post-pic">
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

                                            <div class="post-author"><?php echo $Authordata["username"] ?></div>
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
                                                    <?php
                                                    if ($checkusr == 1) {
                                                        $bookmarkss = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $TrCtPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                                        if ($bookmarkss->num_rows == 1) {
                                                    ?>

                                                            <i style="color: #1d8ae9;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class="fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>
                                                        <?php
                                                        }
                                                    } else {

                                                        ?>
                                                        <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>

                                                    <?php
                                                    }

                                                    ?>

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

                    <?php
                                $userlikedata["react_id"] = 0;
                            }
                        }
                    }
                } else {
                    ?>

                    <div style="text-align: center;" class="">no Trending post!</div>

                <?php
                }
                ?>



                <!-- <div class="general-post-model">
                    <div class="post-image-holder">
                        <img src="" alt="post image" class="post-image">
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
                </div> -->



            </div>

            <div class="inside-add-container">
                Add plays Here
            </div>

            <div class="category-title red-highlight">Related Posts</div>
            <div class="category-clicked-related-post-container rel-box">



                <?php

                $AllviewRs =  " AND `view_id` = '1' ";

                $Allfrpostrs = Database::search("SELECT * FROM `post` WHERE  `category_id` = '" .   $cid . "' ");
                $Allfrrow = $Allfrpostrs->num_rows;
                if ($Allfrrow > 0) {
                    for ($s = 0; $s < $Allfrrow; $s++) {
                        $AllfrpostData = $Allfrpostrs->fetch_assoc();



                        // echo  $AllfrpostData["user_email"];
                        // echo "  ";
                        if (isset($_SESSION["user_email"])) {

                            if ($AllfrpostData["view_id"] == "2") {

                                $AllfrindRS = Database::search("SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $AllfrpostData["user_email"] . "'  AND `unfollow` = '0'");
                                $AllfriendData = $AllfrindRS->num_rows;
                                // $p = "SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $AllfrpostData["user_email"] . "'";
                                // echo  $p;
                                if ($AllfriendData == "1") {

                                    $AllviewRs = " AND NOT  `view_id` = '3' ";
                                }
                            }
                        }
                        // echo  $AllviewRs;
                        $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `id` = '" . $AllfrpostData["id"] . "' AND `hidden` = '0' $AllviewRs ");
                        $TrCtnrow = $CposttrendRS->num_rows;

                        // $p = "SELECT * FROM `post` WHERE `category_id` = '" . $cid . "' AND `hidden` = '0' $AllviewRs ";
                        // echo  $p;

                        if ($TrCtnrow > 0) {
                            for ($n = 0; $n < $TrCtnrow; $n++) {
                                $TrCtPostdata = $CposttrendRS->fetch_assoc();



                                $Tviewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' ");
                                $TVnrow = $Tviewsrs->num_rows;
                                // $Tviews = 0;
                                // if ($TVnrow == 1) {

                                //     $TviewsData = $Tviewsrs->fetch_assoc();
                                //     $Tviews = $TviewsData["views"];
                                // }

                                $file_name = $TrCtPostdata["media"];
                                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);


                ?>

                                <div onclick="viewpost('<?php echo $TrCtPostdata['id'] ?>')" class="general-post-model">
                                    <div class="post-image-holder">
                                        <?php

                                        if ($file_extension == "mp3") {
                                        ?>
                                            <!-- <audio controls class="post-pic">
<source src="images/post/audio/<?php echo $TrCtPostdata["media"] ?>" type="audio/mp3">
Your browser does not support the audio element.
</audio> -->
                                            <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                                        <?php

                                        } elseif ($file_extension == "mp4") {
                                        ?>

                                            <img src="images/post/video/Video-icon.png" alt="" class="post-audio">
                                            <!-- <video controls class="post">
                                        <source src="images/post/video/<?php echo $TrCtPostdata["media"] ?>" type="video/mp4">
                                        Your browser does not support the video element.
                                    </video> -->

                                        <?php
                                        } else {

                                        ?>

                                            <img src="images/post/image/<?php echo $TrCtPostdata["media"] ?>" alt="" class="post-pic">
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


                                            $likers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '1' ");
                                            $likenrow = $likers->num_rows;
                                            // echo $likenrow;

                                            $dislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `react_id` = '2' ");
                                            $dislikenrow = $dislikers->num_rows;

                                            if (isset($_SESSION["user_email"])) {

                                                $userlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                                $userlikenrow = $userlikers->num_rows;
                                                if ($userlikenrow == "1") {

                                                    $userlikedata = $userlikers->fetch_assoc();
                                                }
                                            }



                                            $date1 = new DateTime($TrCtPostdata["date"]);
                                            $date2 = new DateTime($ndate);


                                            $datearray = explode(" ", $TrCtPostdata["date"]);

                                            $interval = $date1->diff($date2);
                                            ?>

                                            <div class="post-author"><?php echo $Authordata["username"] ?></div>
                                        </div>
                                        <div class="post-sub-details">
                                            <div class="post-created-con">
                                                <div class="post-created-date"><?php if ($interval->y > 0) {
                                                                                    echo $datearray[0];
                                                                                } elseif ($interval->m > 0) {
                                                                                    echo $datearray[0];
                                                                                } elseif ($interval->days > 0) {
                                                                                    echo $interval->days . " " . "days ago";
                                                                                } elseif ($interval->h > 0) {
                                                                                    echo $interval->h . " " . "hours ago";
                                                                                } elseif ($interval->i > 0) {
                                                                                    echo $interval->i . " " . "minutes ago";
                                                                                } elseif ($interval->s > 0) {
                                                                                    echo $interval->s . " " . "seconds ago";
                                                                                } else {
                                                                                    echo "just now";
                                                                                } ?></div>
                                                <div class="con-lable">posted date</div>
                                            </div>
                                            <div class="post-views-con">
                                                <div class="post-views"><?php echo $TVnrow ?></div>
                                                <div class="con-lable">views</div>
                                            </div>

                                            <?php
                                            $commentrs = Database::search("SELECT * FROM `comments` WHERE `post_id` = '" . $TrCtPostdata["id"] . "' ORDER BY `date_time` DESC");
                                            $cnrow = $commentrs->num_rows;
                                            ?>

                                            <div class="post-com-con">
                                                <div class="post-com-count"><?php echo $cnrow ?></div>
                                                <div class="con-lable">comments</div>
                                            </div>
                                            <div class="like-dis-con">
                                                <div class="like-con">
                                                    <!-- <i class="likedefault fa-solid fa-bookmark" onclick=""></i> -->
                                                    <?php
                                                    if ($checkusr == 1) {
                                                        $bookmarkss = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $TrCtPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                                        if ($bookmarkss->num_rows == 1) {
                                                    ?>

                                                            <i style=" color: #1d8ae9;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class="fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>
                                                        <?php
                                                        }
                                                    } else {

                                                        ?>
                                                        <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrCtPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrCtPostdata["id"]; ?>" id="bookmark<?php echo $TrCtPostdata["id"]; ?>"></i>

                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                                <div class="like-con">
                                                    <i class="likedefault fa-solid fa-thumbs-up <?php if ($userlikedata["react_id"] == "1") {
                                                                                                    echo "like";
                                                                                                } ?>"></i>
                                                    <div class="like-count"><?php echo $likenrow ?></div>
                                                </div>
                                                <div class="dis-con">
                                                    <i class="likedefault fa-solid fa-thumbs-down <?php if ($userlikedata["react_id"] == "2") {
                                                                                                        echo "dislike";
                                                                                                    } ?>"></i>
                                                    <div class="dislike-count"><?php echo $dislikenrow ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                    <?php

                                $userlikedata["react_id"] = 0;
                            }
                        }
                    }
                } else {
                    ?>

                    <div style="text-align: center;" class="">no post!</div>

                <?php

                }
                ?>



            </div>
        </div>
        <div class="right-add-section add-box">
            <div class="add-post-right">Add plays Here</div>
            <div class="add-post-right">Add plays Here</div>
        </div>
    </div>

    <script src="js/bookmark.js"></script>
    <script src="js/reaction.js"></script>
    <script src="js/category.js"></script>
</body>

</html>