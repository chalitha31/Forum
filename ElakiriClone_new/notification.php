<?php

require_once("header.php");

echo "<script>


let hsrc = document.getElementById('serachMaindiv');

hsrc.style.display  = 'none';


</script>"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notification</title>
    <link rel="icon" href="images/header/Forum-logo.png">
</head>

<style>
    * {
        margin: 0%;
        padding: 0%;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }


    body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .notifi-main-container {
        margin-top: 120px;
        width: 90vw;
        height: 600px;
        background-color: rgba(255, 235, 205, 0);
        display: flex;
        flex-direction: column;
    }

    .container-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        padding: 0px 0px;
        border-bottom: 1px solid rgb(128, 128, 128);
        flex-wrap: wrap;
    }

    .container-title {
        font-size: 20px;
        font-weight: 500;
    }

    .notifi-container {
        padding: 30px 30px;
    }

    .notifi-day-cont {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-top: 1px solid rgba(214, 214, 214, 0);
        padding-top: 20px;
        padding-bottom: 40px;
    }

    .day-block {
        font-size: 12px;
        padding: 2px 8px;
        margin-bottom: 15px;
        border-radius: 3px;
        font-weight: 600;
        background-color: white;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.322);
        text-align: center;
    }

    .cont-collapse {
        position: absolute;
        right: 50px;
        /* transform: translateY(-100%); */
        cursor: pointer;
    }

    .cont-collapse i {
        pointer-events: none;
    }

    .day-notifi-box {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        position: relative;
        background-color: rgba(255, 235, 205, 0);
        transform-origin: 50% 0%;
        transition: 250ms;
    }


    .notifi-block-revive,
    .notifi-block-follow,
    .notifi-block-high,
    .notifi-block-mid,
    .notifi-block-light {
        /* border: 1px solid rgba(128, 128, 128, 0); */
        border-radius: 5px;
        width: 360px;
        padding: 5px 15px 0px 15px;
        background-image: radial-gradient(circle at 0% 50%, rgb(255, 179, 179), rgb(255, 255, 255));
        box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.185);
        display: flex;
        flex-direction: column;
    }


    /* Mid Notification */
    .notifi-block-mid {
        background-image: radial-gradient(circle at 0% 50%, rgb(255, 217, 146), rgb(255, 102, 55));
    }

    .notifi-block-mid .notifi-time {
        color: white;
    }

    .notifi-block-mid .notifi-block-title i {
        color: white;
    }


    /* High Notification */
    .notifi-block-high {
        background-image: radial-gradient(circle at 0% 50%, rgb(255, 28, 28), rgb(190, 26, 26));
        color: white;
    }

    .notifi-block-high .notifi-time {
        color: white;
    }

    .notifi-block-high .notifi-block-title i {
        color: white;
    }


    /* Followed Notification */
    .notifi-block-follow {
        background-image: radial-gradient(circle at 0% 50%, rgb(218, 237, 255), rgb(255, 255, 255));
        color: rgb(0, 48, 206);
    }

    .notifi-block-follow .notifi-block-content {
        color: rgb(0, 0, 0);
    }

    .notifi-block-follow .notifi-time {
        color: rgb(0, 0, 0);
    }

    .notifi-block-follow .notifi-block-title i {
        color: rgb(0, 60, 255);
    }


    /* Revive Notification */
    .notifi-block-revive {
        background-image: radial-gradient(circle at 0% 50%, rgb(225, 255, 218), rgb(255, 255, 255));
        color: rgb(24, 206, 0);
    }

    .notifi-block-revive .notifi-block-content {
        color: rgb(0, 0, 0);
    }

    .notifi-block-revive .notifi-time {
        color: rgb(0, 0, 0);
    }

    .notifi-block-revive .notifi-block-title i {
        color: rgb(51, 255, 0);
    }





    .notifi-block-title {
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        font-size: 15px;
    }

    .notifi-block-title i {
        color: rgb(255, 0, 0);
    }

    .notifi-block-content {
        font-size: 11px;
        /* padding-left: 5px; */
        display: flex;
    }

    .notifi-time {
        font-size: 10px;
        font-weight: 600;
        align-self: flex-end;
        color: rgb(133, 133, 133);
    }
</style>

<body>

    <div class="notifi-main-container">

        <div class="container-header">
            <div class="container-title">Notification <i class="fa-regular fa-comment"></i></div>
        </div>

        <div class="notifi-container">



            <?php

            // $d = new DateTime();
            // $tz = new DateTimezone("Asia/Colombo");
            // $d->setTimezone($tz);
            // $ndate = $d->format("Y-m-d H:i:s");

            $notification = array();

            // Query for hotel bookings with order date in descending order
            $queryFollow = "SELECT * FROM `follow_notification`  ORDER BY `datetime` DESC";
            $purchase_rs = Database::search($queryFollow);
            if ($purchase_rs) {
                $follownotify = array();
                while ($row = mysqli_fetch_assoc($purchase_rs)) {
                    $row['notifi'] = 'follow_notification';
                    $follownotify[] = $row;
                }
                $notification['follow_notification'] = $follownotify;
            } else {
                echo "Error executing the hotel booking query: " . mysqli_error($connection);
            }

            // print_r($follownotify)




            $queryPost = "SELECT * FROM `post_notification` ORDER BY `datetime` DESC";
            $purchase_rs = Database::search($queryPost);
            if ($purchase_rs) {
                $postnotify = array();
                while ($row = mysqli_fetch_assoc($purchase_rs)) {
                    $row['notifi'] = 'post_notification';
                    $postnotify[] = $row;
                }
                $notification['post_notification'] = $postnotify;
            } else {
                echo "Error executing the hotel booking query: " . mysqli_error($connection);
            }


            $queryreport = "SELECT * FROM `report_notificaion` ORDER BY `datetime` DESC";
            $purchase_rs = Database::search($queryreport);
            if ($purchase_rs) {
                $reportnotify = array();
                while ($row = mysqli_fetch_assoc($purchase_rs)) {
                    $row['notifi'] = 'report_notificaion';
                    $reportnotify[] = $row;
                }
                $notification['report_notificaion'] = $reportnotify;
            } else {
                echo "Error executing the hotel booking query: " . mysqli_error($connection);
            }




            // echo  $Bookings['hotel_bookings'][1]['order_date'];
            // echo  $Bookings['photography_bookings'][1]['order_date'];
            // print_r($Bookings);


            // Merge and sort the bookings array by order_date
            $mergedBookings = array_merge($notification['follow_notification'], $notification['post_notification'], $notification['report_notificaion']);



            usort($mergedBookings, function ($a, $b) {
                return strtotime($b['datetime']) - strtotime($a['datetime']);
            });

            // print_r($notification)

            if (empty($mergedBookings)) {
            ?>
                <div class="col-12 bg-light text-center">
                    <span style="margin-top: 200px;margin-bottom:200px ;" class="fs-1 fw-bold text-black-50 d-block">
                        empty notification message!
                    </span>
                </div>
            <?php
            } else {

                $tody = "0";
                $yset = "0";
                $otherdat = "0";
            ?>
                <div class="notifi-day-cont">

                    <?php
                    foreach ($mergedBookings as $noti) {

                        // $datetimeString = '2023-08-15 22:55:04'; // Replace this with your datetime string

                        $now = new DateTime();
                        $yesterday = new DateTime('yesterday');
                        // $datetimeToCheck = new DateTime($datetimeString);


                        $Datetime = new DateTime($noti["datetime"]);

                        // $nowdate = new DateTime($ndate);

                        // $postdatearray = explode(" ", $noti["datetime"]);

                        // $postinterval = $Datetime->diff($nowdate);

                        // Get the hours and minutes
                        $hours = $Datetime->format('H'); // 22
                        $minutes = $Datetime->format('i'); // 55

                        $time = $hours . ' : ' . $minutes;



                    ?>

                        <div style="display: none;" class="cont-collapse">
                            <i class="fa-solid fa-chevron-down arrow-down"></i>
                            <i class="fa-solid fa-chevron-up arrow-up"></i>
                        </div>
                        <!-- <span class="day-block">Yesterday</span> -->
                        <!-- <span class="day-block">12 January</span> -->
                        <!-- <span class="day-block">12 May 2022</span> -->


                        <div class="day-notifi-box">

                            <?php

                            if ($noti['notifi'] == 'follow_notification') {

                                $AllfrindRS = Database::search("SELECT * FROM `follow` WHERE  `id` = '" . $noti['follow_id'] . "' AND   `email` = '" . $_SESSION["user_email"] . "' ");
                                $AllfriendData = $AllfrindRS->num_rows;
                                if ($AllfriendData > "0") {

                                    if ($Datetime->format('Y-m-d') === $now->format('Y-m-d')) {
                                        if ($tody == "0") {
                            ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Today</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $tody = "Today";
                                        }
                                    } elseif ($Datetime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
                                        if ($yset == "0") {

                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Yesterday</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $yset = "Yesterday";
                                        }
                                    } else {
                                        if ($otherdat != $Datetime->format('Y-m-d')) {
                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block"><?php echo $Datetime->format('Y-m-d'); ?></span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                    <?php
                                            $otherdat = $Datetime->format('Y-m-d');
                                        }
                                    }



                                    $Allviewdata = $AllfrindRS->fetch_assoc();

                                    $userRS = Database::search("SELECT * FROM `users` WHERE `email` = '" . $Allviewdata["followed_email"] . "'");
                                    $userdata = $userRS->fetch_assoc();

                                    Database::iud("UPDATE `follow_notification` SET `read` = '1' WHERE `follow_id` = '" . $Allviewdata["id"] . "' ");

                                    ?>

                                    <!-- FOLLOWED POST START -->
                                    <div onclick='profileview("<?php echo $Allviewdata["followed_email"] ?>");' style="margin-bottom: 13px;" class="notifi-block-follow">
                                        <div class="notifi-block-title"><span>You Got a Follower</span>
                                            <span>
                                                <i class="fa-solid fa-user-plus"></i>
                                            </span>
                                        </div>
                                        <div class="notifi-block-content">
                                            <span>Name&nbsp;:&nbsp;</span>
                                            <span><?php echo $userdata["fname"] . " " . $userdata["lname"] ?></span>
                                        </div>
                                        <span class="notifi-time"><?php echo  $time ?></span>
                                    </div>

                                    <?php
                                }
                            } elseif ($noti['notifi'] == 'post_notification') {
                                $postrs = Database::search("SELECT * FROM `post` WHERE  `id` = '" . $noti['post_id'] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                $postrow = $postrs->num_rows;
                                if ($postrow > "0") {

                                    if ($Datetime->format('Y-m-d') === $now->format('Y-m-d')) {
                                        if ($tody == "0") {
                                    ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Today</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $tody = "Today";
                                        }
                                    } elseif ($Datetime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
                                        if ($yset == "0") {

                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Yesterday</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $yset = "Yesterday";
                                        }
                                    } else {
                                        if ($otherdat != $Datetime->format('Y-m-d')) {
                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block"><?php echo $Datetime->format('Y-m-d'); ?></span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $otherdat = $Datetime->format('Y-m-d');
                                        }
                                    }



                                    $postdata = $postrs->fetch_assoc();
                                    if ($noti["relist"] == "1") {

                                        ?>

                                        <!-- REVIVE POST START -->
                                        <div onclick="viewpost('<?php echo $postdata['id'] ?>')" style="margin-bottom: 13px;" class="notifi-block-revive">
                                            <div class="notifi-block-title"><span>You Got Your Post Back</span>
                                                <span>
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </span>
                                            </div>
                                            <div class="notifi-block-content">
                                                <span>Post&nbsp;:&nbsp;</span>
                                                <span><?php echo  $postdata["post_title"] ?></span>
                                            </div>
                                            <span class="notifi-time"><?php echo  $time ?></span>
                                        </div>


                                    <?php

                                    } else {
                                    ?>

                                        <div style="margin-bottom: 13px;" class="notifi-block-high">
                                            <div class="notifi-block-title"><span>YOUR POST IS REMOVED</span>
                                                <span>
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                </span>
                                            </div>
                                            <div class="notifi-block-content">
                                                <span>Post&nbsp;:&nbsp;</span>
                                                <span><?php echo  $postdata["post_title"] ?></span>
                                            </div>
                                            <span class="notifi-time"><?php echo  $time ?></span>
                                        </div>


                                        <?php
                                    }
                                    Database::iud("UPDATE `post_notification` SET `read` = '1' WHERE `post_id` = '" . $postdata["id"] . "' ");
                                }
                            } elseif ($noti['notifi'] == 'report_notificaion') {

                                $reportrs = Database::search("SELECT * FROM `post` WHERE  `id` = '" . $noti['post_id'] . "' AND `user_email` = '" . $_SESSION["user_email"] . "' ");
                                $reportrow = $reportrs->num_rows;
                                if ($reportrow > "0") {

                                    if ($Datetime->format('Y-m-d') === $now->format('Y-m-d')) {
                                        if ($tody == "0") {
                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Today</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $tody = "Today";
                                        }
                                    } elseif ($Datetime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
                                        if ($yset == "0") {

                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block">Yesterday</span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $yset = "Yesterday";
                                        }
                                    } else {
                                        if ($otherdat != $Datetime->format('Y-m-d')) {
                                        ?>
                                            <span style="margin-bottom: 15px;" class="day-block"><?php echo $Datetime->format('Y-m-d'); ?></span>
                                            <!-- <div class="cont-collapse">
                                                <i class="fa-solid fa-chevron-down arrow-down"></i>
                                                <i class="fa-solid fa-chevron-up arrow-up"></i>
                                            </div> -->
                                        <?php
                                            $otherdat = $Datetime->format('Y-m-d');
                                        }
                                    }



                                    $reportdata = $reportrs->fetch_assoc();

                                    if ($noti["block"] == "1") {

                                        ?>

                                        <div onclick="viewpost('<?php echo $reportdata['id'] ?>')" style="margin-bottom: 13px;" class="notifi-block-mid">
                                            <div class="notifi-block-title"><span>Your Post is Temporary Blocked</span>
                                                <span>
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                </span>
                                            </div>
                                            <div class="notifi-block-content">
                                                <span>Post&nbsp;:&nbsp;</span>
                                                <span><?php echo  $reportdata["post_title"] ?></span>
                                            </div>
                                            <span class="notifi-time"><?php echo  $time ?></span>
                                        </div>

                                    <?php
                                    } else {
                                    ?>

                                        <div onclick="viewpost('<?php echo $reportdata['id'] ?>')" style="margin-bottom: 13px;" class="notifi-block-light">
                                            <div class="notifi-block-title"><span>Your Post is recieved a report</span>
                                                <span>
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                </span>
                                            </div>
                                            <div class="notifi-block-content">
                                                <span>Post&nbsp;:&nbsp;</span>
                                                <span><?php echo  $reportdata["post_title"] ?></span>
                                            </div>
                                            <span class="notifi-time"><?php echo  $time ?></span>
                                        </div>


                            <?php
                                    }
                                    Database::iud("UPDATE `report_notificaion` SET `read` = '1' WHERE `post_id` = '" . $reportdata["id"] . "' ");
                                }
                            }
                            ?>

                        </div>

                    <?php
                    }
                    ?>

                </div>

            <?php
            }
            ?>



        </div>

    </div>

    <script>
        function viewpost(id) {

            window.location.href = "view-post.php?pid=" + id;
        }

        function profileview(email) {
            //   alert(email);
            window.location = "user-profile.php?email=" + email;
        }

        let contCollapse = Array.from(document.querySelectorAll('.cont-collapse'));

        for (let item of contCollapse) {
            // item.nextElementSibling.style.display = 'none'
            // item.nextElementSibling.style.transform = 'scaleY(0)'
            item.querySelector('.arrow-down').style.display = 'none'
        }


        for (let item of contCollapse) {
            item.addEventListener('click', (event) => {
                let sibling = event.target.nextElementSibling;
                expanColl(sibling, item)
            })
        }

        function expanColl(targetElement, item) {

            if (targetElement.style.display == 'none') {

                targetElement.style.display = 'flex'
                setTimeout(() => {
                    item.querySelector('.arrow-up').style.display = 'inline-block'
                    item.querySelector('.arrow-down').style.display = 'none'
                    targetElement.style.transform = 'scaleY(1)'
                }, 200)
            } else {

                item.querySelector('.arrow-up').style.display = 'none'
                item.querySelector('.arrow-down').style.display = 'inline-block'
                targetElement.style.transform = 'scaleY(0)'
                targetElement.style.display = 'none'
                setTimeout(() => {}, 200)

            }
        }
    </script>
</body>

</html>