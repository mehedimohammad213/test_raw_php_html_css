<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
</head>
<body>
    <div id="box1">
        <span id="sp1"><img src="images/logo.jpg"  width="15%"></span>
        <br>
        <br>
        <form method="post">
            <div class="btn_div">
                <button class="btn" name="btn1" style="width: 250px;height:60px;margin-left: -75px;">
                    Login to Criminal Management System
                </button>
            </div>
            <div class="btn_div">
                <button class="btn" name="btn2" style="width: 250px;height:60px;margin-left: -75px;">
                    Login to Police Officer Management System
                </button>
            </div>
            <div class="btn_div">
                <button class="btn" name="btn3" style="width: 250px;height:60px;margin-left: -75px;">
                    Login to General Diary
                </button>
            </div>
        </form>
    </div>
</body>
</html>
<?php

if (isset($_POST['btn1'])) {
    header("location: /auth/login1.php");
    exit;
} elseif (isset($_POST['btn2'])) {
    header("location: /auth/login2.php");
    exit;
} elseif (isset($_POST['btn3'])) {
    header("location: /auth/login_gd.php");
    exit;
}
?>