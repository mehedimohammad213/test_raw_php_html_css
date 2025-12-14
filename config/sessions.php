<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $ses_sql = $db->query("select uname from users where uname = '" . SQLite3::escapeString($user_check) . "'");

   $row = $ses_sql->fetchArray(SQLITE3_ASSOC);

   $login_session = $row['uname'];

   if(!isset($_SESSION['login_user'])){
      header("location: /auth/login1.php");
      die();
   }
?>