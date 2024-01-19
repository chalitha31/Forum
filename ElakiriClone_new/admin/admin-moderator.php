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
    <title>Admin Moderator Add</title>
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
            <a class="navs" href="admin-posts.php">Posts</a>
            <?php
            if ($_SESSION["admin_type"] == "1") {
            ?>
                <a class="navs nav-active" href="">Moderators</a>
            <?php
            }
            ?>

        </nav>
        <div class="header-right">
            <a class="navsi" href="adminpannel.php"><i class="fa-solid fa-users"></i></a>
            <a class="navsi" href="report-post.php"><i class="fa-solid fa-shield-halved"></i></a>
            <a class="navsi" href="admin-posts.php"><i class="fa-solid fa-file"></i></a>
            <a class="navsi nav-icon" href=""><i class="fa-solid fa-user-plus"></i></a>
        </div>
    </header>


    <div class="admin-container">
        <div class="container-header">
            <div class="container-title">Add Moderator</div>
        </div>
        <div class="moderator-container">
            <div class="add-admin-con">
                <!-- <label for="fName">First Name</label>
                <input type="text" name="" id="fName">
                <label for="lName">Last Name</label>
                <input type="text" name="" id="lName"> -->
                <label for="aEmail">Email</label>
                <input type="email" name="" id="aEmail">
                <!-- <select id="aEmail">
                    <option value="0">Select email</option>
                    <?php
                    $userRs  = Database::search("SELECT `users`.`blocked`,`users`.`email`, `users`.`fname`, `users`.`lname` FROM `users` 
                        LEFT JOIN `admin`  ON `users`.`email` = `admin`.`email` WHERE     `admin`.`email` IS NULL  ");

                    $Arow = $userRs->num_rows;

                    for ($m = 0; $m < $Arow; $m++) {
                        $udata = $userRs->fetch_assoc();
                    ?>
                        <option value="<?php echo $udata["email"] ?>"><?php echo $udata["email"] ?></option>
                    <?php
                    }
                    ?>
                </select> -->
                <button onclick="addadmin()" class="add-btn">ADD</button>
            </div>
        </div>

        <div class="container-header">
            <div class="container-title">Moderators</div>
        </div>
        <div class="member-container">
            <?php
            $resultset = Database::search("SELECT * FROM `admin` WHERE `admin_type_id` != '1' ");

            $nrow = $resultset->num_rows;
            for ($i = 1; $i <= $nrow; $i++) {

                $AData = $resultset->fetch_assoc();

                $ADresultset = Database::search("SELECT * FROM `users` WHERE `email` = '" . $AData["email"] . "' ");
                $Alldata = $ADresultset->fetch_assoc();


            ?>

                <div class="member-num-con">
                    <div class="moderator-number"><?php echo $i ?>.</div>
                    <div class="moderator-block">
                        <div class="moderator-name"><?php echo $Alldata["fname"] . " " . $Alldata["lname"]  ?> </div>
                        <div class="moderator-mail"><?php echo $Alldata["email"] ?></div>
                        <div class="moderator-state">
                            <!-- <button class="moderator-block-btn">BLOCK</button> -->
                            <?php
                            if ($AData["blocked"] == "0") {
                            ?>
                                <button id="btn<?php echo $Alldata['email'] ?>" onclick="blockAdmin('<?php echo $Alldata['email'] ?>')" class="moderator-block-btn">BLOCK</button>
                            <?php
                            } else {
                            ?>
                                <button id="btn<?php echo $Alldata['email'] ?>" onclick="blockAdmin('<?php echo $Alldata['email'] ?>')" class="moderator-block-btn unbk-btn">UNBLOCK</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- <div class="member-num-con">
                <div class="moderator-number">1.</div>
                <div class="moderator-block">
                    <div class="moderator-name">FirstName LastName</div>
                    <div class="moderator-mail">abcd@gmail.com</div>
                    <div class="moderator-state">
                        <button class="moderator-block-btn unbk-btn">UNBLOCK</button>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    <script src="js/admin-common.js"></script>
    <script src="js/admin-panel.js"></script>
</body>

</html>