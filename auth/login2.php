<?php
   include("../config/config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = SQLite3::escapeString($_POST['uname']);
      $mypassword = SQLite3::escapeString($_POST['pass']);

      $sql = "SELECT * FROM users WHERE uname = '$myusername' and pass = '$mypassword'";
      $result = $db->query($sql);
      $row = $result->fetchArray(SQLITE3_ASSOC);

      $count = 0;
      if ($row) {
         $count = 1;
         $result->reset();
      }


      if($count == 1) {
         $_SESSION['login_user'] = $myusername;

         header("location: /Officers/addOfficer.php");
      }else {
         echo "<script>alert('".'Invalid Username or Password'."')</script>";
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
</head>
<body>
    <div id="box1">
        <span id="sp1"><img src="../images/logo.jpg"  width="15%"></span>
        <br>
        <br>
        <form method="post">
            Username
            <br>
            <input type="text" class="inp" name="uname">
            <br>
            <br>
            Password
            <br>
            <input type="password" class="inp" name="pass">
            <div class="btn_div"><button  class="btn">Login</button></div>
        </form>
    </div>
</body>
</html>
