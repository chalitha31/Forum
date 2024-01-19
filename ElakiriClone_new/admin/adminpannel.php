<?php

session_start();
require "connection.php";
?>

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
    <title>Admin Panel</title>
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
            <a class="navs nav-active" href="">Members</a>
            <a class="navs" href="report-post.php">Report</a>
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
            <a class="navsi nav-icon" href=""><i class="fa-solid fa-users"></i></a>
            <a class="navsi" href="report-post.php"><i class="fa-solid fa-shield-halved"></i></a>
            <a class="navsi" href="admin-posts.php"><i class="fa-solid fa-file"></i></a>
            <a class="navsi" href="admin-moderator.php"><i class="fa-solid fa-user-plus"></i></a>
        </div>
    </header>


    <div class="admin-container">
        <div class="container-header">
            <div class="container-title">All Members</div>
            <div class="search-cont">
                <input id="memberserch" onkeyup="memberSearch()" type="text" class="search-by" placeholder="Search by Name">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="sort-cont">
                <div class="sort-lable">Sort by :</div>
                <select name="" id="shortvalue" onchange="membersort()">
                    <option value="regdate">reg-date</option>
                    <option value="unblocked">unblocked</option>
                    <option value="blocked">blocked</option>
                </select>
            </div>
        </div>
        <div id="memberResult" class="member-container">






            <!-- <div class="member-block">
                <div class="member-number">1.</div>
                <div class="member-name">FirstName LastName</div>
                <div class="member-state">
                    <button class="member-view-btn">VIEW</button>
                    <button class="member-block-btn unbk-btn">UNBLOCK</button>
                </div>

            </div>
            <div class="member-block">
                <div class="member-number">100.</div>
                <div class="member-name">FirstName LastName</div>
                <div class="member-state">
                    <button class="member-view-btn">VIEW</button>
                    <button class="member-block-btn">BLOCK</button>
                </div>
              
            </div> -->

        </div>
    </div>

    <script src="js/admin-common.js"></script>
    <script src="js/admin-panel.js"></script>
    <script src="js/admin-member-control.js"></script>
</body>

</html>