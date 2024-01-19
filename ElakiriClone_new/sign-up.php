<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="images/header/Forum-logo.png">
    <link rel="stylesheet" href="css/sign-up.css">
    <!-- <link rel="stylesheet" href="css/header.css"> -->
</head>

<body>
    <header>
        <a onclick="pageTravel('home.php')"><img src="images/header/Forum-logo.png" alt="LOGO" class="header-logo"></a>
    </header>
    <!-- <img src="images/sign-up-backgroung.jpg" alt="" class="sign-up-backdrop"> -->
    <div class="sign-up-form-container">
        <div class="form-heading">
            <h2>Register</h2>
            <h5></h5>
        </div>
        <span style="color: red;" id="errorView"></span>
        <input type="text" placeholder="First Name" id="fname">
        <input type="text" placeholder="Last Name" id="lname">
        <input type="text" placeholder="User Name" id="username">
        <input type="email" placeholder="E-Mail" id="email">
        <input type="password" placeholder="Password" id="pw">
        <input type="password" placeholder="Confirm Password" id="Rpw">

        <!-- <div class="type-category">
            <div class="user-div">
                <input type="radio" name="table" id="loguser" value='1' checked>
                <label for="loguser">User</label>
            </div>

            <div class="seller-div">
                <input type="radio" name="table" id="logseller" value='2'>
                <label for="logseller">Seller</label>
            </div>
        </div> -->

        <button class="register-button" onclick="signUp();">Register</button>
    </div>
    <script src="js/logging.js"></script>
    <script src="js/header.js"></script>
</body>

</html>