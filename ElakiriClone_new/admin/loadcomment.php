<?php
session_start();
require "connection.php";

$pid = $_GET["pid"];

$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$ndate = $d->format("Y-m-d H:i:s");

$commentrs = Database::search("SELECT * FROM `comments` WHERE `post_id` = '" . $pid . "' ORDER BY `date_time` DESC");
$cnrow = $commentrs->num_rows;
?>



<?php

if ($cnrow > 0) {

    for ($k = 0; $k < $cnrow; $k++) {
        $commntdata = $commentrs->fetch_assoc();

        $commuserrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $commntdata["user_email"] . "'");
        $comrow = $commuserrs->num_rows;

        if ($comrow == 1) {
            $comntuser = $commuserrs->fetch_assoc();
        }
?>
        <div class="commented-unit">
            <div class="commented-channel-pic-holder">
                <img class="commented-channel-pic" src="../images/coments/user.svg" alt="channel-pic" />
            </div>
            <div class="commented-discription">

                <?php



                $date1 = new DateTime($commntdata["date_time"]);
                $date2 = new DateTime($ndate);

                // $nowdateArray = explode(" ", $ndate);

                // echo $commntdata["date_time"];
                $commentdatearray = explode(" ", $commntdata["date_time"]);

                $interval = $date1->diff($date2);

                // echo "y";
                // echo $interval->y;
                // echo "m";
                // echo $interval->m;
                // echo "d";
                // echo $interval->days;
                // echo "h";
                // echo $interval->h;
                // echo "i";
                // echo $interval->i;
                // echo "s";
                // echo $interval->s;



                ?>

                <div class="comment-name-unit">
                    <p class="commented-person"><?php echo $comntuser["username"] ?></p>
                    <p id="commntTime" class="commented-time"><?php if ($interval->y > 0) {
                                                                    echo $commentdatearray[0];
                                                                } elseif ($interval->m > 0) {
                                                                    echo $commentdatearray[0];
                                                                } elseif ($interval->days > 0) {
                                                                    echo $interval->days . " " . "days ago";
                                                                } elseif ($interval->h > 0) {
                                                                    echo $interval->h . " " . "hours ago";
                                                                } elseif ($interval->i > 0) {
                                                                    echo $interval->i . " " . "minutes ago";
                                                                    // } 
                                                                    // elseif ($interval->s > 0) {
                                                                    //     echo $interval->s . " " . "seconds ago";
                                                                } else {
                                                                    echo "just now";
                                                                } ?></p>
                </div>

                <p class="commented-text">
                    <?php echo $commntdata["comment"] ?>
                </p>
                <div class="commenter-options">
                    <!-- <i class="fa-solid fa-arrow-up"></i>
            <div>33</div> -->

                    <!-- <div class="like-con">
                <i class="likedefault fa-solid fa-thumbs-up <?php if ($Tuserlikedata["react_id"] == "1") {
                                                                echo "like";
                                                            } ?>"></i>
                <div class="like-count"><?php echo $Tlikenrow ?></div>
            </div>
            <div class="dis-con">
                <i class="likedefault fa-solid fa-thumbs-down <?php if ($Tuserlikedata["react_id"] == "2") {
                                                                    echo "like";
                                                                } ?>"></i>
                <div class="dislike-count"><?php echo $Tdislikenrow ?></div>
            </div> -->

                    <!-- <div class="like-dis-con">
                <div class="like-con">
                    <i class="fa-solid fa-thumbs-up"></i>
                    <div class="like-count">10</div>
                </div>
                <div class="dis-con">
                    <i class="fa-solid fa-thumbs-down"></i>
                    <div class="dislike-count">5</div>
                </div>
            </div> -->

                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>

    <div class="">no comment</div>
<?php
}
?>