<?php
require_once("header.php");

$cid = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create post</title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <script src="https://cdn.tiny.cloud/1/o5uas24bnhkgfgwc026zn1mb52h4cgogq0swt5nowvcnpu8n/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/create-post-page.css">
</head>

<body>

    <?php

    $resultset = Database::search("SELECT * FROM `category` WHERE `id` = '" . $cid . "'");
    $nrow = $resultset->num_rows;
    if ($nrow > 0) {

        $Cdata = $resultset->fetch_assoc();
    }

    ?>

    <div class="create-post-container">
        <h3 class="cat-name">Category : <span class="cat-name-value"><?php echo $Cdata["name"] ?></span></h3>
        <div class="post-title">
            <span>Post Title&nbsp;:&nbsp;</span>
            <input type="text" class="input-title">
        </div>

        <!-- <div class="post-image">

            <input type="file" accept="image/*" name="media" id="img-file-1" style="display:none;" onchange="loadImgFile(event)">
            <label class="label" for="img-file-1">
                <i class="fa-solid fa-image"></i>
                <h4>Post Image</h4>
            </label>
        </div> -->
        <div class="post-media">
            <input type="file" accept="audio/*" name="media" id="file-aud" style="display:none;" onchange="loadFile(event)">
            <input type="file" accept="image/*" name="media" id="file-img" style="display:none;" onchange="loadFile(event)">
            <input type="file" accept="video/*" name="media" id="file-vid" style="display:none;" onchange="loadFile(event)">
            <div class="label-container">
                <label class="up-label" for="file-aud">
                    <i class="fa-solid fa-music"></i>
                </label>
                <label class="up-label" for="file-img">
                    <i class="fa-solid fa-image"></i>
                </label>
                <label class="up-label" for="file-vid">
                    <i class="fa-solid fa-video"></i>
                </label>
            </div>
            <h4>add media</h4>
        </div>



        <h3>Post Content</h3>

        <!-- <form action="create-post-page.php" method="POST" autocomplete="off">
            <textarea id="postContent" name="postContent">

          </textarea>
            <input class="submit-btn" type="submit" value="Submit">
        </form> -->

        <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->

        <?php
        require_once("text-edit.php");
        ?>

        <button onclick="uplodepost('<?php echo $cid ?>')" class="submit-btn">Upload</button>


    </div>


    <script>
        // tinymce.init({
        //     selector: 'textarea',
        //     // plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        //     toolbar: 'undo redo |  fontfamily fontsize | bold italic underline strikethrough | align lineheight | checklist numlist bullist indent outdent | emoticons charmap |',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        //     mergetags_list: [{
        //             value: 'First.Name',
        //             title: 'First Name'
        //         },
        //         {
        //             value: 'Email',
        //             title: 'Email'
        //         },
        //     ],
        // });
    </script>
    <!-- <script src="js/header.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/create-post-page.js"></script>

</body>

</html>