<?php
require "connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin-pannel.css">
    <title>report post</title>
</head>

<body>

    <header>
        <div class="header-left">
            <a onclick="pageTravel('../home.php')"><img src="../images/header/Forum-logo.png" alt="LOGO" class="header-logo"></a>
        </div>
        <nav class="header-mid">
            <!-- <a class="navs nav" href="dashboard.php">Dashboard</a> -->
            <a class="navs" href="adminpannel.php">Members</a>
            <a class="navs nav-active" href="">Report</a>
            <a class="navs" href="admin-posts.php">Posts</a>
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
            <a class="navsi nav-icon" href=""><i class="fa-solid fa-shield-halved"></i></a>
            <a class="navsi" href="admin-posts.php"><i class="fa-solid fa-file"></i></a>
            <a class="navsi" href="admin-moderator.php"><i class="fa-solid fa-user-plus"></i></a>
        </div>
    </header>

    <div class="admin-container">
        <div class="container-header">
            <div class="container-title">All Members</div>
            <div style="display: none;" class="sort-cont">
                <div class="sort-lable">Sort by :</div>
                <select name="" id="">
                    <option value="name">category</option>
                    <option value="reg-date">reg-date</option>
                </select>
            </div>
        </div>
        <div class="report-container">

            <?php

            $reportRs = Database::search("SELECT * FROM `report`    ");
            $reportnumRow = $reportRs->num_rows;

            if ($reportnumRow > 0) {

                for ($i = 1; $i <= $reportnumRow; $i++) {
                    $reportData = $reportRs->fetch_assoc();

                    $postRs = Database::search("SELECT * FROM `post` WHERE `id` = '" . $reportData["post_id"] . "'");
                    if ($postRs->num_rows == "1") {
                        $postData = $postRs->fetch_assoc();

                        $usertRs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $postData["user_email"] . "'");

                        $userData = $usertRs->fetch_assoc();

                        $categoryRs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $postData["category_id"] . "'");

                        $categoryData = $categoryRs->fetch_assoc();
            ?>
                        <div class="report-block">
                            <div class="report-number"><?php echo $i ?>.</div>
                            <div class="report-title">
                                <span><?php echo $postData["post_title"] ?></span>
                                <div class="report-name">
                                    <div>Author : <span><?php echo $userData["fname"] . " " .  $userData["lname"] ?></span></div>
                                    <div>Category : <span><?php echo $categoryData["name"] ?></span></div>
                                </div>
                            </div>

                            <div class="reporter">
                                <div onclick="viewprofile('<?php echo $reportData['report_email'] ?>');">
                                    <span>Reporter : </span>
                                    <span><b><?php echo $reportData["report_email"] ?></b></span>
                                </div>
                                <!-- <div class="report-type">Spam or misleading</div> -->
                                <div class="report-type"><?php echo $reportData["tittle"] ?></div>
                            </div>


                            <div class="report-state">
                                <button onclick="adminviewpost('<?php echo $reportData['post_id'] ?>')" class="member-view-btn">VIEW</button>

                                <button onclick="removepost('<?php echo $reportData['post_id'] ?>','<?php echo $reportData['id'] ?>')" class="report-block-btn">Remove</button>


                            </div>
                            <div class="report-blank"></div>

                        </div>
                <?php
                    }
                }
            } else {
                ?>
                <h1 style="color: gray; text-align: center; margin-top: 100px;">no report post</h1>
            <?php
            }

            ?>




            <!-- <div class="report-block">
                <div class="report-number">1.</div>
                <div class="report-title">Post Tile</div>
                <div class="report-state">
                    <button class="member-view-btn">VIEW</button>
                    <button class="report-block-btn">Remove</button>
                </div>
                <div class="report-blank"></div>
                <div class="report-name">
                    <div>Author : <span>FirstName LastName</span></div>
                    <div>Category : <span>Category Name</span></div>
                </div>
                
            </div> -->

        </div>
    </div>
    <script src="js/admin-common.js"></script>
    <script src="js/admin-panel.js"></script>
</body>

</html>