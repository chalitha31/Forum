<?php

session_start();
require_once("connection.php");

$sechCat = $_GET["serchC"];
$searchtect = $_GET["searchtect"];
$cat = $_GET["cat"];

// echo $sechCat;
// echo $searchtect;
// echo $cat;



$query = "SELECT * FROM `post` ";

$status = 0;

// if ($status == 0) {

if (!empty($searchtect) &&  $sechCat == "0") {

    $query .= " WHERE (`post_title` LIKE '%" . $searchtect . "%' OR `post_content` LIKE '%" . $searchtect . "%') AND `hidden` = '0' ";
    // $status = 1;
} else if (empty($searchtect) && $sechCat != "0") {

    $query .= " WHERE `category_id` = '" . $sechCat . "' AND `hidden` = '0'";
    // $status = 1;
} else if (!empty($searchtect) && $sechCat != "0") {
    // echo $sechCat;
    $query .= " WHERE (`post_title` LIKE '%" . $searchtect . "%' OR `post_content` LIKE '%" . $searchtect . "%') AND `category_id` = '" . $sechCat . "' AND `hidden` = '0' ";
    // $status = 1;
} else {
    $query .= " WHERE  `hidden` = '0'";
}
// } else if ($status ==   1) {

//     if (!empty($searchtect) &&  $sechCat == "0") {

//         $query .= " AND `title` LIKE '%" . $searchtect . "%' OR `post_content` LIKE '%" . $searchtect . "%' ";
//         $status = 1;
//     } else if (empty($searchtect) && $sechCat != "0") {

//         $query .= " AND `category` = '" . $$sechCat . "' OR `post_content` LIKE '%" . $searchtect . "%' ";
//         $status = 1;
//     }
// }

$query1 = $query;

$products = Database::search($query);
$nProduct = $products->num_rows; //total results
$userProducts = $products->fetch_assoc();


$selectedrs = Database::search($query1);

$srn = $selectedrs->num_rows;

if ($cat == "0") {

?>
    <h2 class="container-title">Search Post</h2>
    <div class="home-trending-container">

        <?php

        if ($srn > 0) {

            while ($pps = $selectedrs->fetch_assoc()) {


                // $Caresultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pps["category_id"] . "' ");
                // $Ctnrow = $Caresultset->num_rows;




                $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pps["id"] . "' ");
                $Vnrow = $viewsrs->num_rows;
                // $views = 0;
                // if ($Vnrow == 1) {

                // $viewsData = $viewsrs->fetch_assoc();
                // $views = $viewsData["views"];
                // }

                $file_name = $pps["media"];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                // echo $file_extension;
        ?>
                <div onclick="viewpost('<?php echo $pps['id'] ?>')" class="trending-post-container">
                    <div class="post-pic-holder">

                        <?php

                        if ($file_extension == "mp3") {
                        ?>
                            <!-- <audio controls class="post-pic">
                                    <source src="images/post/audio/<?php echo $pps["media"] ?>" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio> -->
                            <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                        <?php

                        } elseif ($file_extension == "mp4") {
                        ?>
                            <video controls class="post">
                                <source src="images/post/video/<?php echo $pps["media"] ?>" type="video/mp4">
                                Your browser does not support the video element.
                            </video>

                        <?php
                        } else {

                        ?>

                            <img src="images/post/image/<?php echo $pps["media"] ?>" alt="" class="post-pic">
                        <?php
                        }

                        ?>

                    </div>
                    <div class="post-description">
                        <div class="post-title"><?php echo $pps["post_title"] ?></div>
                        <p class="post-paragraph"><?php echo $pps["post_content"] ?></p>

                        <?php

                        $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $pps["user_email"] . "'");
                        $Anrow = $authorResult->num_rows;
                        if ($Anrow == 1) {

                            $Authordata = $authorResult->fetch_assoc();
                        }



                        $resultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $pps["category_id"] . "'");
                        $nrow = $resultset->num_rows;
                        if ($nrow > 0) {

                            $Cdata = $resultset->fetch_assoc();
                        }


                        ?>

                        <div class="post-footer">
                            <div class="post-author"><?php echo $Authordata["username"] ?></div>
                            <div class="post-footer-bottom">
                                <div class="post-category"><?php echo $Cdata["name"] ?></div>
                                <div class="views-block"><i class="fa-solid fa-eye"></i><span class="view-count"><?php echo $Vnrow ?></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>





            <?php

            }
        } else {
            ?>

            <div style="width: 90vw; text-align: center;" class="">No Post!</div>

        <?php

        }
        ?>
    </div>

    <?php

} else {

    if ($srn > 0) {
    ?>
        <div class="category-title red-highlight">Search post</div>
        <div class="category-clicked-trending-container trend-box">
            <?php
            while ($pps = $selectedrs->fetch_assoc()) {



                $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pps["id"] . "' ");
                $Vnrow = $viewsrs->num_rows;
                // $views = 0;
                // if ($Vnrow == 1) {

                //     $viewsData = $viewsrs->fetch_assoc();
                //     $views = $viewsData["views"];
                // }


                $file_name = $pps["media"];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);


            ?>

                <div onclick="viewpost('<?php echo $pps['id'] ?>')" class="general-post-model">
                    <div class="post-image-holder">
                        <?php

                        if ($file_extension == "mp3") {
                        ?>
                            <!-- <audio controls class="post-pic">
<source src="images/post/audio/<?php echo $pps["media"] ?>" type="audio/mp3">
Your browser does not support the audio element.
</audio> -->
                            <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                        <?php

                        } elseif ($file_extension == "mp4") {
                        ?>

                            <img src="images/post/video/Video-icon.png" alt="" class="post-audio">
                            <!-- <video controls class="post">
                            <source src="images/post/video/<?php echo $pps["media"] ?>" type="video/mp4">
                            Your browser does not support the video element.
                        </video> -->

                        <?php
                        } else {

                        ?>

                            <img src="images/post/image/<?php echo $pps["media"] ?>" alt="" class="post-pic">
                        <?php
                        }

                        ?>
                    </div>
                    <div class="post-details-container">
                        <div class="post-main-details">
                            <div class="post-subject"><?php echo $pps["post_title"] ?></div>

                            <?php

                            $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $pps["user_email"] . "'");
                            $Anrow = $authorResult->num_rows;
                            if ($Anrow == 1) {

                                $Authordata = $authorResult->fetch_assoc();
                            }

                            $Tlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pps["id"] . "' AND `react_id` = '1' ");
                            $Tlikenrow = $Tlikers->num_rows;
                            // echo $likenrow;

                            $Tdislikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pps["id"] . "' AND `react_id` = '2' ");
                            $Tdislikenrow = $Tdislikers->num_rows;

                            if (isset($_SESSION["user_email"])) {

                                $Tuserlikers = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $pps["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                $Tuserlikenrow = $Tuserlikers->num_rows;
                                if ($Tuserlikenrow == "1") {

                                    $Tuserlikedata = $Tuserlikers->fetch_assoc();
                                }
                            }
                            ?>

                            <div class="post-author"><?php echo $Authordata["username"] ?></div>
                        </div>
                        <div class="post-sub-details">
                            <div class="post-created-con">
                                <div class="post-created-date">2023/04/01</div>
                                <div class="con-lable">posted date</div>
                            </div>
                            <div class="post-views-con">
                                <div class="post-views"><?php echo $Vnrow ?></div>
                                <div class="con-lable">views</div>
                            </div>
                            <div class="post-com-con">
                                <div class="post-com-count">100</div>
                                <div class="con-lable">comments</div>
                            </div>
                            <div class="like-dis-con">
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
            ?>
        </div>
    <?php
    } else {
    ?>

        <div style="width: 90vw; text-align: center;" class="">No Post!</div>

<?php

    }
}
?>