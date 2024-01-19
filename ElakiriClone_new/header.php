<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="images/header/Forum-logo.png">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>
        <div class="header-left">
            <a><img onclick="pageTravel('home.php')" src="images/header/Forum-logo.png" alt="LOGO" class="header-logo"></a>
        </div>
        <nav id="serachMaindiv" class="header-mid">
            <div class="header-searchbar-con">
                <input id="searchtect" type="text" class="header-searchbar" placeholder="Search by">

                <div class="header-status-bar">
                    <span class="status-text">all</span>
                    <div id="icollapse" class="icon-dropper icon-collapse"></div>
                </div>
                <div class="header-search-by-cont">

                    <input class="inputRad" type="radio" name="rad" id="rad0" checked>
                    <label class="labelRad" for="rad0">all</label>
                    <i class="fa-solid fa-check iconRad"></i>

                    <?php
                    session_start();
                    require "connection.php";

                    $TrCaresultset = Database::search("SELECT * FROM `category` ");
                    $TrCtnrow = $TrCaresultset->num_rows;
                    if ($TrCtnrow > 0) {
                        for ($n = 0; $n < $TrCtnrow; $n++) {

                            $uniqueId = 'radio_' . $n;
                            $TrCtPostdata = $TrCaresultset->fetch_assoc();
                    ?>

                            <!-- vvt -- sst -->
                            <input class="inputRad category-radio" type="radio" value="<?php echo $TrCtPostdata["id"] ?>" name="rad" id="<?php echo $uniqueId ?>">
                            <label class="labelRad" for="<?php echo $uniqueId ?>"><?php echo $TrCtPostdata["name"] ?></label>
                            <i class="fa-solid fa-check iconRad"></i>

                    <?php
                        }
                    }
                    ?>

                </div>





            </div>
            <i id="hsrc" onclick="search(0)" class="fa-solid fa-magnifying-glass"></i>
        </nav>
        <div class="header-right">

            <!-- <div class="header-user">User</div> -->

            <?php


            if (!isset($_SESSION["user_email"])) {
            ?>

                <div class="header-sign-text">Sign in</div>
                <i class="fa-solid fa-comment-dots create-post-icon" style="display: none;"></i>



            <?php
            } else {

                $notifii = false;
                $notifyRs = Database::search("SELECT `read` FROM `follow_notification` WHERE `follow_id` IN (SELECT `id` FROM `follow` WHERE `email` = '" . $_SESSION["user_email"] . "' AND  `unfollow` = '0')  UNION 
                     SELECT `read` FROM `post_notification` WHERE `post_id` IN (SELECT `id` FROM `post` WHERE `user_email` = '" . $_SESSION["user_email"] . "') 
                      UNION  SELECT `read` FROM `report_notificaion` WHERE `post_id` IN (SELECT `id` FROM `post` WHERE `user_email` = '" . $_SESSION["user_email"] . "')  ");
                if ($notifyRs->num_rows > 0) {
                    for ($k = 0; $k < $notifyRs->num_rows; $k++) {
                        $notidyData = $notifyRs->fetch_assoc();

                        if ($notidyData["read"] == "0") {
                            $notifii = true;
                        }
                    }
                }
            ?>
                <i onclick="bookmrk();" class="fa-solid fa-bookmark header-bookmark"></i>


                <?php
                if ($notifii) {
                ?>
                    <i onclick="notification();" class="fa-solid fa-envelope i-active"></i>
                <?php
                } else {
                ?>
                    <i onclick="notification();" class="fa-solid fa-envelope header-envelope"></i>
                <?php
                }
                ?>


                <i class="fa-solid fa-comment-dots create-post-icon"></i>

                <div onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" class="header-sign-text signed-click">
                    <?php echo $_SESSION["username"]  ?>
                </div>

                <div class="hamb-container">
                    <i class="fa-solid fa-bars hamb-menu"></i>

                    <?php

                    if ($notifii) {
                    ?>
                        <i class="fa-solid fa-circle notifi-mark"></i>
                    <?php

                    }
                    ?>




                </div>

                <!-- <div class="header-dropdown-container">
                    <div class="header-dropdown-user-container">
                        <div class="header-dropdown-user-img-holder">
                            <img src="images/header/forum-user-img.avif" alt="">
                        </div>
                        <div class="header-dropdown-user-details">
                            <div class="header-dropdown-user-detail-name">
                                <?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_lname"] ?>
                            </div>
                            <div class="header-dropdown-user-detail-name">
                                <?php echo $_SESSION["user_email"]  ?>
                            </div>
                            <div onclick="signOut();" class="header-dropdow-signout red-mark">sign out</div>
                        </div>
                    </div>
                    <div class="header-dropdown-feature-container">
                        <li class="header-dropdown-account-details">account-details</li>
                        <li onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" class="header-dropdown-my-content">My content</li>
                        <li onclick="bookmrk();" class="header-dropdown-bookmarks">bookmarks</li>
                        <li class="header-dropdown-mails red-highlight">mails</li>
                        <li class="header-dropdown-password-and-security">password and security</li>
                        <li class="header-dropdown-followings">followings</li>
                        <li class="header-dropdown-privacy">privacy</li>

                        <?php
                        $Aresultset = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $_SESSION["user_email"] . "' ");

                        $Anrow = $Aresultset->num_rows;
                        if ($Anrow == "1") {
                        ?>
                            <li onclick="adminlog();" class="header-dropdown-privacy">Admin page</li>

                        <?php
                        }
                        ?>

                    </div>
                </div> -->


                <div class="header-dropdown-container">
                    <div class="header-dropdown-user-container">
                        <div class="header-dropdown-user-img-holder">
                            <!-- <img src="images/header/forum-user-img.avif" alt=""> -->
                            <?php
                            $ViproRs  = Database::search("SELECT * FROM `profile_pic` WHERE `email` = '" . $_SESSION['user_email']  . "'");
                            $Vpicrow = $ViproRs->num_rows;
                            if ($Vpicrow == "1") {
                                $VpicData = $ViproRs->fetch_assoc();
                            ?>
                                <img onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" src="./images/profile_pic/<?php echo $VpicData["image"] ?>" alt="user" class="view-user-pic">
                            <?php
                            } else {
                            ?>
                                <img onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" src="./images/profile_pic/user.svg" alt="user" class="view-user-pic">
                            <?php
                            }


                            ?>

                        </div>
                        <div class="header-dropdown-user-details">
                            <div onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" class="header-dropdown-user-detail-name">
                                <?php echo $_SESSION["user_fname"] . " " . $_SESSION["user_lname"] ?>
                            </div>
                            <!-- <div class="header-dropdown-user-detail-name">
                    FName@gmail.com
                </div> -->
                        </div>
                    </div>
                    <div class="header-dropdown-feature-container">
                        <div class="header-dropdown-feature-container-one">


                            <?php
                            if (isset($_SESSION['user_email'])) {
                                $Aresultset = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $_SESSION["user_email"] . "' ");

                                $Anrow = $Aresultset->num_rows;
                                if ($Anrow == "1") {
                            ?>
                                    <!-- highlight-red -->
                                    <i class="fa-solid fa-user-tie "></i>
                                    <li onclick="adminlog();" class="header-dropdown-my-content ">Admin</li>

                            <?php
                                }
                            }
                            ?>

                            <i class="fa-regular fa-file"></i>
                            <li onclick="userprofile('<?php echo $_SESSION['user_email'] ?>');" class="header-dropdown-my-content">My Profile</li>
                            <i class="fa-regular fa-bookmark"></i>
                            <li onclick="bookmrk();" class="header-dropdown-bookmarks">Bookmarks</li>
                            <?php

                            if ($notifii) {
                            ?>
                                <i class="fa-regular fa-envelope  fa-beat " style="--fa-beat-scale: 1.2; color: red;"></i>
                            <?php
                            } else {
                            ?>
                                <i class="fa-regular fa-envelope"></i>
                            <?php
                            }

                            ?>


                            <!-- <i class="fa  faa-shake animated faa-fast"></i> -->
                            <!-- <i class="fa-solid fa-circle notifi-mark"></i> -->
                            <li onclick="notification();" class="header-dropdown-mails ">Notification</li>
                        </div>
                        <div class="header-dropdown-feature-container-two">
                            <li onclick="privacy('<?php echo $_SESSION['user_email'] ?>')" class="header-dropdown-password-and-security">password and security</li>
                            <!-- <li class="header-dropdown-followings">followings</li> -->
                            <li onclick="privacy('<?php echo $_SESSION['user_email'] ?>')" class="header-dropdown-privacy">privacy</li>
                            <div onclick="signOut();" class="header-dropdow-signout red-mark">sign out</div>
                        </div>
                    </div>
                </div>


            <?php
            }
            ?>
            <div class="drop-cat">
                <i class="fa-solid fa-circle-xmark drop-cat-close"></i>
                <h4>select a category</h4>
                <div class="cat-container">

                    <?php

                    $resultset = Database::search("SELECT * FROM `category`");
                    $nrow = $resultset->num_rows;
                    if ($nrow > 0) {
                        for ($i = 0; $i < $nrow; $i++) {
                            $Cdata = $resultset->fetch_assoc();
                    ?>

                            <div onclick="createPost('<?php echo $Cdata['id'] ?>')" class="drop-category-item"><?php echo $Cdata["name"] ?></div>

                        <?php
                        }
                    } else {
                        ?>

                        <div class="">no category!</div>

                    <?php

                    }

                    ?>


                </div>
            </div>

        </div>







        <!-- Remember Me -->

        <?php

        $email = "";
        $password = "";

        if (isset($_COOKIE["email"])) {
            $email = $_COOKIE["email"];
        }

        if (isset($_COOKIE["password"])) {
            $password = $_COOKIE["password"];
        }

        ?>

        <!-- Remember Me -->


        <div class="form-container header-sign-form">
            <div class="close-tag form-close"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="form-lable">Member Logging</div>

            <div class="">
                <span style="color: red;" class="" id="errorView"></span>
            </div>

            <div class="form-mail-container input-container">
                <div class="input-lable mail-lable">Email</div>
                <input type="email" id="email" value="<?php echo $email ?>">
            </div>
            <div class="form-mail-container input-container">
                <div class="input-lable password-lable">Password</div>
                <input type="password" id="pw" value="<?php echo $password ?>">
            </div>

            <div class="click-box">
                <div class="rem-box">
                    <input type="checkbox" name="" id="rememberMe" value="1">
                    <label for="rememberMe">remember me</label>
                </div>
                <div class="fog">Forgot Password?</div>
            </div>
            <button onclick="login()" class="form-join-button">Sign in</button>
            <a onclick="pageTravel('sign-up.php')" class="register-click">Register here</a>
            <!-- <div class="form-footer">
                <a onclick="pageTravel('sign-up.php')" class="moderator-click">Moderator</a>
                <a onclick="pageTravel('admin/admin-Sign-in.php')" class="admin-click"><i class="fa-sharp fa-solid fa-star"></i>Admin</a>
            </div> -->

        </div>


        <!-- <div class="forget-form-container">
            <div class="close-tag forgot-form-close"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="form-lable">Reset Pasword</div>
            <div class="form-mail-container input-container">
                <div class="input-lable mail-lable">E-mail</div>
                <input type="email">
            </div>

            <button class="send-otp-button">Send OTP</button>

            <div class="reset-drawer">
                <div class="form-mail-container input-container">
                    <div class="input-lable otp-lable">OTP</div>
                    <input type="text">
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable ps-lable">new password</div>
                    <input type="password">
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable nps-lable">re-enter new password</div>
                    <input type="password">
                </div>

                <button class="change-pass-button">change password</button>
            </div>
        </div> -->

        <div class="forget-form-container">


            <div class="close-tag forgot-form-close"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="form-lable">Reset Pasword</div>
            <span style="color: red;" id="VerrorView"></span>
            <div class="form-mail-container input-container">
                <div class="input-lable mail-lable">E-mail</div>
                <input type="email" id="Vemail">
            </div>

            <button onclick="forgotpassword()" id="send-otp-button" class="send-otp-button">Send OTP</button>
            <div class="reset-drawer">
                <div class="form-mail-container input-container">
                    <div class="input-lable otp-lable">OTP</div>
                    <input type="text" id="vc" readonly>
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable ps-lable">new password</div>
                    <input type="password" id="np" readonly>
                </div>
                <div class="form-mail-container input-container">
                    <div class="input-lable nps-lable">re-enter new password</div>
                    <input type="password" id="rnp" readonly>
                </div>

                <button onclick="resetPassword()" id="change-pass-button" class="change-pass-button notallow" disabled>change password</button>

            </div>
        </div>


    </header>
    <script src="js/logging.js"></script>
    <script src="js/header.js"></script>
</body>

</html>