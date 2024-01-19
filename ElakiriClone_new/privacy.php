<?php
require "header.php";

$uemail = $_GET["email"];
// echo $uemail;


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/privacy.css">
    <title>Privacy</title>
    <link rel="icon" href="images/header/Forum-logo.png">
</head>

<body>


    <div class="page-privacy-body">
        <div class="page-privacy-heading">Password and Security</div>
        <div class="privacy-cont">
            <p class="privacy-para">
                Ensuring the security and privacy of user accounts is paramount for any online platform. The Password
                and Security Page plays a vital role in empowering users to take control of their account's security and
                adopt best practices for protecting their personal information. By offering robust security features,
                clear guidance, and educational resources, websites can instill confidence in their users and
                demonstrate their commitment to safeguarding user data. This, in turn, fosters trust and credibility,
                essential factors for the long-term success of any online service.
                <br />
            </p>

            <div class="page-privacy-heading">Change Password</div>
            <div class="privacy-inpt-cont">
                <input id="em" type="email" placeholder="User Email">
                <input id="oldpsw" type="password" placeholder="current  Password">
                <br />
                <button id="veryfybutton" onclick="verifypassword('<?php echo $_SESSION['user_email'] ?>')" class="verify-btn">Verify</button>
            </div>
            <div class="privacy-inpt-cont">
                <input id="psw" type="password" placeholder="new  Password" readonly>
                <input id="newpsw" type="password" placeholder="re-enter  Password" readonly>
                <br />
                <button id="pwchangebutton" onclick="changepassword('<?php echo $_SESSION['user_email'] ?>')" class="confirm-btn" disabled>Confirm</button>
            </div>
        </div>

        <div class="page-privacy-heading">Privacy</div>
        <div class="privacy-cont">
            <p class="privacy-para p-para">
                The Privacy Section is a critical segment of a website that is dedicated to informing users about how
                their personal information is collected, used, and protected by the website and its associated services.
                It serves as a transparent and comprehensive resource that outlines the website's privacy practices,
                ensuring that users have a clear understanding of how their data is handled.
                <br />
                The privacy of our visitors at WPKube is very important to us. We want you to understand the type of
                information we collect when you visit our site and how we use this information.
                <br />
                User privacy should be a primary concern for most businesses. After all, it's the users who provide
                you with income and traffic. As such, many (if not all) companies create a privacy policy to outline
                how they protect user data.
                <br />

                Fortunately, there are plenty of tools available to create and implement a privacy policy. What's
                more, there's even a quick way to create a privacy policy within WordPress.
                <br />

                In this post, we'll discus what a privacy policy is, along with why it's important. You'll also find out
                how to decide whether you need a policy, along with some of the key laws and elements to
                consider. Finally, we'll give you three ways to create a privacy policy in WordPress!
            </p>
        </div>
    </div>


    <script src="js/privacy.js"></script>
</body>

</html>