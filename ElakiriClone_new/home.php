<?php

require("header.php");
require("sidebar.php");


// session_start();

if (isset($_SESSION["user_email"])) {
    $checkusr = 1;
} else {
    $checkusr = 2;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>


    <div id="result" class="home-container">

        <h2 class="container-title">Trending Section</h2>

        <div class="home-trending-container">


            <?php
            $Caresultset = Database::search("SELECT `post_id`, COUNT(`post_id`) AS `a` FROM `reaction` GROUP BY `post_id` ORDER BY `a` DESC LIMIT 6");
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
                            $frindRS = Database::search("SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $frpostData["user_email"] . "' AND `unfollow` = '0' ");
                            $friendData = $frindRS->num_rows;
                            if ($friendData == "1") {
                                // echo "  s";
                                $viewRs = " AND NOT  `view_id` = '3' ";
                            }
                        }
                    }


                    // echo $viewRs;
                    // echo " /  ";


                    $Trresultset = Database::search("SELECT * FROM `post` WHERE `id` = '" . $CtPostdata["post_id"] . "' AND `hidden` = '0'  $viewRs   ORDER BY  `id` ASC LIMIT 1 ");
                    $Tnrow = $Trresultset->num_rows;
                    if ($Tnrow > 0) {
                        for ($i = 0; $i < $Tnrow; $i++) {
                            $TrPostdata = $Trresultset->fetch_assoc();

                            $viewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $TrPostdata["id"] . "' ");
                            $Vnrow = $viewsrs->num_rows;
                            // $views = 0;
                            // if ($Vnrow == 1) {

                            // $viewsData = $viewsrs->fetch_assoc();
                            // $views = $viewsData["views"];
                            // }

                            $file_name = $TrPostdata["media"];
                            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                            // echo $file_extension;
            ?>
                            <div onclick="viewpost('<?php echo $TrPostdata['id'] ?>')" class="trending-post-container">
                                <div class="post-pic-holder">

                                    <?php

                                    if ($file_extension == "mp3") {
                                    ?>
                                        <!-- <audio controls class="post-pic">
                                    <source src="images/post/audio/<?php echo $TrPostdata["media"] ?>" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio> -->
                                        <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                                    <?php

                                    } elseif ($file_extension == "mp4") {
                                    ?>
                                        <video controls class="post">
                                            <source src="images/post/video/<?php echo $TrPostdata["media"] ?>" type="video/mp4">
                                            Your browser does not support the video element.
                                        </video>

                                    <?php
                                    } else {

                                    ?>

                                        <img src="images/post/image/<?php echo $TrPostdata["media"] ?>" alt="" class="post-pic">
                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="post-description">
                                    <div class="post-title"><?php echo $TrPostdata["post_title"] ?></div>
                                    <p class="post-paragraph"><?php echo $TrPostdata["post_content"] ?></p>

                                    <?php

                                    $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $TrPostdata["user_email"] . "'");
                                    $Anrow = $authorResult->num_rows;
                                    if ($Anrow == 1) {

                                        $Authordata = $authorResult->fetch_assoc();
                                    }



                                    $resultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $TrPostdata["category_id"] . "'");
                                    $nrow = $resultset->num_rows;
                                    if ($nrow > 0) {

                                        $Cdata = $resultset->fetch_assoc();
                                    }

                                    $i = $TrPostdata["user_email"];
                                    ?>

                                    <div class="post-footer">
                                        <div class="post-author" onclick='profileview("<?php echo $i ?>"); event.stopPropagation();'><?php echo $Authordata["username"] ?></div>
                                        <div class="post-footer-bottom">
                                            <div class="post-category"><?php echo $Cdata["name"] ?></div>
                                            <!-- <div class="views-block"></div> -->
                                            <div class="views-block"> <?php
                                                                        if ($checkusr == 1) {
                                                                            $bookmarkss = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $TrPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                                                            if ($bookmarkss->num_rows == 1) {
                                                                        ?>

                                                        <i style=" color: #1d8ae9;" onclick='addToBookmark(<?php echo $TrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrPostdata["id"]; ?>" id="bookmark<?php echo $TrPostdata["id"]; ?>"></i>
                                                    <?php
                                                                            } else {
                                                    ?>
                                                        <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrPostdata["id"]; ?>" id="bookmark<?php echo $TrPostdata["id"]; ?>"></i>
                                                    <?php
                                                                            }
                                                                        } else {

                                                    ?>
                                                    <i style=" color: gray;" onclick='addToBookmark(<?php echo $TrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $TrPostdata["id"]; ?>" id="bookmark<?php echo $TrPostdata["id"]; ?>"></i>

                                                <?php
                                                                        }

                                                ?><i class="fa-solid fa-eye"></i><span class="view-count"><?php echo $Vnrow ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                <?php
                        }
                    }
                }
            } else {
                ?>

                <div class="home-page-no-post-text">no Post!</div>

            <?php

            }

            ?>



            <!-- <div class="trending-post-container">
                <div class="post-pic-holder">
                    <img src="images/home/post-pic-1.png" alt="" class="post-pic">
                </div>
                <div class="post-description">
                    <div class="post-title">Post TitleLorem ipsum dolor sit amet consectetur
                    </div>
                    <p class="post-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
                        sapiente alias recusandae, Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
                        sapiente alias recusandae, corporis consequatur iste officiis illum excepturi? Consequuntur,
                        dignissimos!</p>

                    <div class="post-footer">
                        <div class="post-author">Author</div>
                        <div class="post-footer-bottom">
                            <div class="post-category">Category</div>
                            <div class="views-block"><i class="fa-solid fa-eye"></i><span class="view-count">1000</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="trending-post-container">
                <div class="post-pic-holder">
                    <img src="images/home/post-pic-2.png" alt="" class="post-pic">
                </div>
                <div class="post-description">
                    <div class="post-title">Post TitleLorem ipsum dolor
                    </div>
                    <p class="post-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
                        dignissimos!</p>

                    <div class="post-footer">
                        <div class="post-author">Author</div>
                        <div class="post-footer-bottom">
                            <div class="post-category">Category</div>
                            <div class="views-block"><i class="fa-solid fa-eye"></i><span class="view-count">1000</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="trending-post-container">
                <div class="post-pic-holder">
                    <img src="images/home/post-pic-3.png" alt="" class="post-pic">
                </div>
                <div class="post-description">
                    <div class="post-title">Post TitleLorem
                    </div>
                    <p class="post-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
                        dignissimos!</p>

                    <div class="post-footer">
                        <div class="post-author">Author</div>
                        <div class="post-footer-bottom">
                            <div class="post-category">Category</div>
                            <div class="views-block"><i class="fa-solid fa-eye"></i><span class="view-count">1000</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div> -->

        </div>



        <!-- category 1 Trending -->




        <?php
        $Tcr = Database::search("SELECT `post_id`, COUNT(`post_id`) AS `a` FROM `reaction` GROUP BY `post_id` ORDER BY `a` DESC ");
        $Tcn = $Tcr->num_rows;
        $Duplidates = array();
        if ($Tcn > 0) {
            for ($g = 0; $g < $Tcn; $g++) {
                $TD = $Tcr->fetch_assoc();

                $Tpo = Database::search("SELECT DISTINCT `category_id`  FROM `post` WHERE `id` = '" . $TD["post_id"] . "'  ");
                $TpoD = $Tpo->fetch_assoc();

                if (!in_array($TpoD["category_id"], $Duplidates)) {

                    $Duplidates[] = $TpoD["category_id"];
                }
            }
        }

        $firstFiveData = 0;
        if (is_array($Duplidates)) {
            $firstFiveData = array_slice($Duplidates, 0, 5);
        }

        foreach ($firstFiveData as $dup_date) {

            // echo  $dup_date;


            $TrCaresultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $dup_date . "' ");
            $TrCtnrow = $TrCaresultset->num_rows;

            if ($TrCtnrow > 0) {
                for ($n = 0; $n < $TrCtnrow; $n++) {
                    $TrCtPostdata = $TrCaresultset->fetch_assoc();

        ?>
                    <h2 class="container-title"><?php echo $TrCtPostdata["name"] ?></h2>
                    <div class="home-trending-container">

                        <?php

                        $AllviewRs =  " AND `view_id` = '1' ";

                        $Allfrpostrs = Database::search("SELECT * FROM `post` WHERE  `category_id` = '" .   $TrCtPostdata["id"] . "' ");
                        $AllfrpostData = $Allfrpostrs->fetch_assoc();



                        // echo $friendData;
                        // echo "  ";
                        if (isset($_SESSION["user_email"])) {
                            if ($AllfrpostData["view_id"] == "2") {
                                $AllfrindRS = Database::search("SELECT * FROM `follow` WHERE  `email` = '" . $_SESSION["user_email"] . "' AND `followed_email` = '" . $AllfrpostData["user_email"] . "'  AND `unfollow` = '0'");
                                $AllfriendData = $AllfrindRS->num_rows;
                                if ($AllfriendData == "1") {
                                    $AllviewRs = " AND NOT  `view_id` = '3' ";
                                }
                            }
                        }

                        // echo $AllviewRs;
                        // echo "  s";
                        // echo $AllfrpostData["view_id"];

                        $CTrresultset = Database::search("SELECT * FROM `post` WHERE `category_id` = '" . $TrCtPostdata["id"] . "' AND `hidden` = '0' $AllviewRs  ORDER BY  `date` DESC LIMIT 4 ");
                        $Cnrow = $CTrresultset->num_rows;
                        if ($Cnrow > 0) {
                            for ($k = 0; $k < $Cnrow; $k++) {
                                $CTrPostdata = $CTrresultset->fetch_assoc();

                                $Tviewsrs = Database::search("SELECT * FROM `reaction` WHERE `post_id` = '" . $CTrPostdata["id"] . "' ");
                                $TVnrow = $Tviewsrs->num_rows;
                                // echo $TVnrow;
                                // $Tviews = 0;
                                // if ($TVnrow == 1) {

                                // $TviewsData = $Tviewsrs->fetch_assoc();
                                // $Tviews = $TviewsData["views"];
                                // }

                                $file_name = $CTrPostdata["media"];
                                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                                // echo $file_extension;
                        ?>
                                <div onclick="viewpost('<?php echo $CTrPostdata['id'] ?>')" class="trending-post-container">
                                    <div class="post-pic-holder">

                                        <?php
                                        // echo $TVnrow;
                                        if ($file_extension == "mp3") {
                                        ?>
                                            <!-- <audio controls class="post-pic">
                                    <source src="images/post/audio/<?php echo $CTrPostdata["media"] ?>" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio> -->
                                            <img src="images/post/audio/Audio_CD.png" alt="" class="post-audio">
                                        <?php

                                        } elseif ($file_extension == "mp4") {
                                        ?>
                                            <video controls class="post">
                                                <source src="images/post/video/<?php echo $CTrPostdata["media"] ?>" type="video/mp4">
                                                Your browser does not support the video element.
                                            </video>

                                        <?php
                                        } else {

                                        ?>

                                            <img src="images/post/image/<?php echo $CTrPostdata["media"] ?>" alt="" class="post-pic">
                                        <?php
                                        }

                                        ?>

                                    </div>
                                    <div class="post-description">
                                        <div class="post-title"><?php echo $CTrPostdata["post_title"] ?></div>
                                        <p class="post-paragraph"><?php echo $CTrPostdata["post_content"] ?></p>

                                        <?php

                                        $authorResult = Database::search("SELECT * FROM `users` WHERE `email` = '" . $CTrPostdata["user_email"] . "'");
                                        $Anrow = $authorResult->num_rows;
                                        if ($Anrow == 1) {

                                            $Authordata = $authorResult->fetch_assoc();
                                        }



                                        $resultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $CTrPostdata["category_id"] . "'");
                                        $nrow = $resultset->num_rows;
                                        if ($nrow > 0) {

                                            $Cdata = $resultset->fetch_assoc();
                                        }

                                        $i = $CTrPostdata["user_email"];
                                        ?>

                                        <div class="post-footer">
                                            <div onclick='profileview("<?php echo $i ?>"); event.stopPropagation();' class="post-author"><?php echo $Authordata["username"] ?></div>
                                            <div class="post-footer-bottom">
                                                <div class="post-category"><?php echo $Cdata["name"] ?></div>

                                                <div class="views-block"> <?php
                                                                            if ($checkusr == 1) {
                                                                                $bookmarkss = Database::search("SELECT * FROM `bookmark` WHERE `postid` = '" . $CTrPostdata["id"] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                                                                if ($bookmarkss->num_rows == 1) {
                                                                            ?>

                                                            <i style=" color: #1d8ae9;" onclick='addToBookmark(<?php echo $CTrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $CTrPostdata["id"]; ?>" id="bookmark<?php echo $CTrPostdata["id"]; ?>"></i>
                                                        <?php
                                                                                } else {
                                                        ?>
                                                            <i style=" color: gray;" onclick='addToBookmark(<?php echo $CTrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $CTrPostdata["id"]; ?>" id="bookmark<?php echo $CTrPostdata["id"]; ?>"></i>
                                                        <?php
                                                                                }
                                                                            } else {

                                                        ?>
                                                        <i style=" color: gray;" onclick='addToBookmark(<?php echo $CTrPostdata["id"] ?>); event.stopPropagation();' class=" fa-solid fa-bookmark bookmark<?php echo $CTrPostdata["id"]; ?>" id="bookmark<?php echo $CTrPostdata["id"]; ?>"></i>

                                                    <?php
                                                                            }

                                                    ?><i class="fa-solid fa-eye"></i><span class="view-count"><?php echo $TVnrow ?></span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            <?php
                            }
                        } else {
                            ?>

                            <h3 style="text-align: center;" class="home-page-no-post-text">no Post!</h3>

                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
            } else {
                ?>

                <div class="home-page-no-post-text">no Post!</div>

        <?php
            }
        }
        ?>








        <!-- <h2 class="container-title">Categories</h2>
        <div class="home-categories-container">
            <div class="home-category-item">Name</div>
            <div class="home-category-item">Namdadsd</div>
            <div class="home-category-item">Nameasd</div>
            <div class="home-category-item">Nameawd awda</div>
            <div class="home-category-item">Nameasd asd</div>
            <div class="home-category-item">Namea</div>
            <div class="home-category-item">Name asda</div>
            <div class="home-category-item">Namedsa</div>
            <div class="home-category-item">Name awdwd wdawd</div>
            <div class="home-category-item">Nameasd dsdw s</div>
            <div class="home-category-item">Namesdda</div>
        </div> -->
    </div>

    <script src="js/home.js"></script>
    <script src="js/reaction.js"></script>
    <script src="js/category.js"></script>
    <script src="js/bookmark.js"></script>

</body>

</html>