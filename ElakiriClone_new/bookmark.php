<?php

require("header.php");
require("sidebar.php");


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
    <title>Bookmarks</title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>


    <div id="result" class="home-container">

        <h2 class="container-title">Bookmarks Section</h2>

        <div class="home-trending-container">


            <?php
            $Caresultset = Database::search("SELECT * FROM `bookmark` WHERE `user_email` = '" . $_SESSION["user_email"] . "'  ORDER BY `id` DESC ");
            $Ctnrow = $Caresultset->num_rows;
            if ($Ctnrow > 0) {
                for ($c = 0; $c < $Ctnrow; $c++) {
                    $CtPostdata = $Caresultset->fetch_assoc();


                    $Trresultset = Database::search("SELECT * FROM `post` WHERE `id` = '" . $CtPostdata["postid"] . "' AND `hidden` = '0' ORDER BY  `id` ASC LIMIT 1 ");
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


                                    ?>

                                    <div class="post-footer">
                                        <div class="post-author"><?php echo $Authordata["username"] ?></div>
                                        <div class="post-footer-bottom">
                                            <div class="post-category"><?php echo $Cdata["name"] ?></div>
                                            <div class="views-block"></div>
                                            <div class="views-block"><i onclick="removeBookmark('<?php echo  $CtPostdata['postid'] ?>'); event.stopPropagation();" class="fa-solid fa-bookmark"></i>&nbsp;<i class="fa-solid fa-eye"></i><span class="view-count"><?php echo $Vnrow ?></span>
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

                <div class="">no bookmark Post!</div>

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


    </div>

    <script src="js/home.js"></script>
    <script src="js/reaction.js"></script>
    <script src="js/category.js"></script>
    <script src="js/bookmark.js"></script>

</body>

</html>