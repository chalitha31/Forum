<?php
// session_start();
// require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/sidebar.css">
</head>

<body>

    <div class="direction-icon-holder">
        <i class="fa-solid fa-chevron-down"></i>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="category-icon-container icon-box">

        <?php

        $resultset = Database::search("SELECT * FROM `category`");
        $nrow = $resultset->num_rows;
        if ($nrow > 0) {
            for ($i = 0; $i < $nrow; $i++) {
                $Cdata = $resultset->fetch_assoc();
        ?>

                <!-- <div onclick="createPost('<?php echo $Cdata['id'] ?>')" class="drop-category-item"><?php echo $Cdata["name"] ?></div> -->

                <div class="cat-con" onclick="categoryview('<?php echo $Cdata['id'] ?>')">
                    <i class="<?php echo $Cdata["icon"] ?>"></i>
                    <span class="cat-label"><?php echo $Cdata["name"] ?></span>
                </div>

            <?php
            }
        } else {
            ?>

            <div class="">no category!</div>

        <?php

        }

        ?>


        <!-- <div class="cat-con">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="cat-label">label 1asdas asdawd asdawd</span>
        </div>
        <div class="cat-con">
            <i class="fa-solid fa-icons"></i>
            <span class="cat-label">label 2klalsd</span>
        </div>
        <div class="cat-con">
            <i class="fa-solid fa-map-location"></i>
            <span class="cat-label">label asdasdas</span>
        </div>
        <div class="cat-con">
            <i class="fa-sharp fa-solid fa-helicopter"></i>
            <span class="cat-label">label 4</span>
        </div>
        <div class="cat-con">
            <i class="fa-solid fa-radiation"></i>
            <span class="cat-label">label 5</span>
        </div>
        <div class="cat-con">
            <i class="fa-sharp fa-solid fa-republican"></i>
            <span class="cat-label">label 6</span>
        </div> -->
        <!-- <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 7</span>
        </div>
        <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 1</span>
        </div>
        <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 1</span>
        </div>
        <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 1</span>
        </div>
        <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 1</span>
        </div>
        <div class="cat-con">
            <i class="fa-brands fa-discord"></i>
            <span class="cat-label">label 1</span>
        </div> -->
    </div>

    <script src="js/sidebar.js"></script>
</body>

</html>