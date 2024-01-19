<?php

session_start();
require "connection.php";

$val = $_GET["Cid"];

$userNrow;
$userData;
if ($val == "regdate") {
    $userRs  = Database::search("SELECT `users`.`blocked`,`users`.`email`, `users`.`fname`, `users`.`lname` FROM `users` LEFT JOIN `admin`  ON `users`.`email` = `admin`.`email` WHERE     `admin`.`email` IS NULL  ORDER BY `users`.`register_date` DESC; ");
    $userNrow = $userRs->num_rows;
} else if ($val == "unblocked") {
    $userRs  = Database::search("SELECT `users`.`blocked`,`users`.`email`, `users`.`fname`, `users`.`lname` FROM `users` LEFT JOIN `admin`  ON `users`.`email` = `admin`.`email` WHERE `users`.`blocked` = '0' AND `admin`.`email` IS NULL  ");
    $userNrow = $userRs->num_rows;
} else if ($val == "blocked") {
    $userRs  = Database::search("SELECT `users`.`blocked`,`users`.`email`, `users`.`fname`, `users`.`lname` FROM `users` LEFT JOIN `admin`  ON `users`.`email` = `admin`.`email` WHERE `users`.`blocked` = '1' AND `admin`.`email` IS NULL ");
    $userNrow = $userRs->num_rows;
}


// $userNrow = $userRs->num_rows;

for ($i = 1; $i <= $userNrow; $i++) {
    $userData = $userRs->fetch_assoc();


?>

    <div class="member-block">
        <div class="member-number"><?php echo $i ?>.</div>
        <div class="member-name">
            <div><?php echo $userData["fname"] . " " . $userData["lname"] ?></div>
            <div class="member-mail"><?php echo $userData["email"] ?></div>
        </div>
        <div class="member-state">
            <button onclick="viewprofile('<?php echo $userData['email'] ?>');" class="member-view-btn">VIEW</button>

            <?php
            if ($userData["blocked"] == "0") {
            ?>
                <button id="btn<?php echo $i ?>" onclick="blockuser('<?php echo $i ?>','<?php echo $userData['email'] ?>')" class="member-block-btn">BLOCK</button>
            <?php
            } else {
            ?>
                <button id="btn<?php echo $i ?>" onclick="blockuser('<?php echo $i ?>','<?php echo $userData['email'] ?>')" class="member-block-btn unbk-btn">UNBLOCK</button>
            <?php
            }
            ?>

        </div>
    </div>

    <!-- <button class="member-block-btn unbk-btn">UNBLOCK</button> -->

<?php
}

?>