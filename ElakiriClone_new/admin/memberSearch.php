<?php
require "connection.php";

$data = $_GET["data"];

$result =  Database::search("SELECT `users`.`blocked`,`users`.`email`, `users`.`fname`, `users`.`lname` FROM `users` LEFT JOIN `admin`  ON `users`.`email` = `admin`.`email` WHERE   (`users`.`fname` LIKE '%" . $data . "%' OR  `users`.`lname` LIKE '%" . $data . "%')  AND `admin`.`email` IS NULL");
$rowd = $result->num_rows;
// echo $rowd;
if ($rowd > 0) {
    for ($i = 1; $i <= $rowd; $i++) {
        $rsdata = $result->fetch_assoc();

?>

        <div class="member-block">
            <div class="member-number"><?php echo $i ?>.</div>
            <div class="member-name"><?php echo $rsdata["fname"] . " " . $rsdata["lname"] ?></div>
            <div class="member-state">
                <button onclick="viewprofile('<?php echo $userData['email'] ?>');" class="member-view-btn">VIEW</button>

                <?php
                if ($rsdata["blocked"] == "0") {
                ?>
                    <button id="btn<?php echo $i ?>" onclick="blockuser('<?php echo $i ?>','<?php echo $rsdata['email'] ?>')" class="member-block-btn">BLOCK</button>
                <?php
                } else {
                ?>
                    <button id="btn<?php echo $i ?>" onclick="blockuser('<?php echo $i ?>','<?php echo $rsdata['email'] ?>')" class="member-block-btn unbk-btn">UNBLOCK</button>
                <?php
                }
                ?>

            </div>
        </div>

        <!-- <button class="member-block-btn unbk-btn">UNBLOCK</button> -->

    <?php
    }
} else {
    ?>
    <p style="text-align: center; margin-top: 130px; font-size: 80px; color: gray;">empty result</p>
<?php
}
