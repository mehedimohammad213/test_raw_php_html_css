<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Home</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../../css/style_1.css'>
   </head>
   <body class="app-shell">
      <div class="top-bar">
         <button name="logout" class="logout-btn">
            <img src="../../images/logout.png" alt="Logout icon">
            <a href="../../auth/logout.php">Log out</a>
         </button>
      </div>
      <div class="container">
      <div class="finaldiv">
      <div class="header-row">
         <span class="head1"><img src="../../images/police_logo.png" alt="Police logo left"></span>
         <span class="head_txt">Criminal Management System</span>
         <span class="head2"><img src="../../images/police_logo.png" alt="Police logo right"></span>
      </div>
      <div class="navbar">
         <ul>
            <li><a href="../Criminal/home.php"><b>Criminal Information</b></a></li>
            <li><a href="../Criminal/search.php" ><b>Search Records</b></a></li>
            <li><a href="../Criminal/criminalList.php"><b>List of Criminals</b></a></li>
            <li><a href="offList.php" class="active"><b>List of Officers</b></a></li>
            <li><a href="../Criminal/analysis.php"><b>Analytics</b></a></li>
         </ul>
         <div class="table-wrapper">
            <table>
            <thead>
            <tr>
               <th>Officer Name</th>
               <th>Officer ID</th>
               <th>ID</th>
               <th>Contact</th>
               <th>Gender</th>
               <th>Weapon</th>
               <th>Role</th>
            </tr>
            </thead>
            <tbody>
<?php
   include("../../config/config.php");
   $q1 = "SELECT * FROM `officer`";
   $result = $db->query($q1);
   if($result){
       while($row=$result->fetchArray(SQLITE3_ASSOC)){
           echo'
   <tr>
           <td>'.$row['offName'].'</td>
           <td>'. $row['offID'].'</td>
           <td>'. $row['ID'].'</td>
           <td>'.$row['contact'].'</td>
           <td>'. $row['gender'].'</td>
           <td>'. $row['weapon'].'</td>
           <td>'.$row['role'].'</td>
   </tr>';
       }
   }
   else{
       echo'<tr><td colspan="7">No officers found</td></tr>';
   }
   ?>
            </tbody>
            </table>
         </div>
      </div>
   </body>
</html>