<?php
require "connection.php";

$data = $_GET["data"];
$condition = $_GET["condition"];
$shortpost = $_GET["shortpost"];
// echo $shortpost;
// echo $data;
// echo $data;

$row = 0;
if ($condition == "1") {

    if ($shortpost == "all") {

        $result =  Database::search("SELECT * FROM `post` WHERE  `post_title` LIKE '%" . $data . "%' OR `post_content` LIKE '%" . $data . "%'");
        $rowd = $result->num_rows;
    } else if ($shortpost == "block") {

        $result =  Database::search("SELECT * FROM `post` WHERE `hidden` = '1' AND (`post_title` LIKE '%" . $data . "%' OR `post_content` LIKE '%" . $data . "%')");
        $rowd = $result->num_rows;
    } else if ($shortpost == "unblock") {

        $result =  Database::search("SELECT * FROM `post` WHERE `hidden` = '0' AND (`post_title` LIKE '%" . $data . "%' OR `post_content` LIKE '%" . $data . "%')");
        $rowd = $result->num_rows;
    }
} elseif ($condition == "2") {
    $result =  Database::search("SELECT * FROM `users` WHERE (`fname` LIKE '%" . $data . "%' OR `lname` LIKE '%" . $data . "%')");
    $rowd = $result->num_rows;
} elseif ($condition == "3") {
    $result =  Database::search("SELECT * FROM `category` WHERE  `name` LIKE '%" . $data . "%' ");
    $rowd = $result->num_rows;
}



$countN = 1;
// echo $rowd;
if ($rowd > 0) {



    $d = new DateTime();
    $tz = new DateTimezone("Asia/Colombo");
    $d->setTimezone($tz);
    $ndate = $d->format("Y-m-d H:i:s");

    for ($t = 1; $t <= $rowd; $t++) {
        $dat = $result->fetch_assoc();

        $TrCtnrow = 0;

        if ($condition == "3") {
            $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `category_id` = '" . $dat["id"] . "'");
            $TrCtnrow = $CposttrendRS->num_rows;
        } elseif ($condition == "2") {
            $CposttrendRS = Database::search("SELECT * FROM `post`  WHERE `user_email` = '" . $dat["email"] . "'");
            $TrCtnrow = $CposttrendRS->num_rows;
        } elseif ($condition == "1") {
            $CposttrendRS = Database::search("SELECT * FROM `post` WHERE `id` = '" . $dat["id"] . "'");
            $TrCtnrow = $CposttrendRS->num_rows;
        }

        // $CposttrendRS = Database::search("SELECT * FROM `post`");

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
                    <div class="post-number"><?php echo $countN ?>.</div>

                    <div style="<?php if ($TrCtPostdata["hidden"] == "1") {
                                    echo "border: 1px solid red;";
                                } ?>" onclick="adminviewpost('<?php echo $TrCtPostdata['id'] ?>')" class="general-post-model">
                        <div class="post-image-holder">
                            <?php
                            $countN = $countN + 1;
                            if ($file_extension == "mp3") {
                            ?>


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
        }




        // <!-- <div style="text-align: center;" class="">no post!</div> -->


    }
} else {
    ?>
    <p style="text-align: center; margin-top: 130px; font-size: 80px; color: gray;">empty result</p>
<?php
}
