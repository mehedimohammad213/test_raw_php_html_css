<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Criminal List</title>
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
            <li><a href="home.php"><b>Criminal Information</b></a></li>
            <li><a href="search.php"><b>Search Records</b></a></li>
            <li><a href="criminalList.php" class="active"><b>List of Criminals</b></a></li>
            <li><a href="../Officers/offList.php"><b>List of Officers</b></a></li>
            <li><a href="analysis.php"><b>Analytics</b></a></li>
         </ul>
         <div class="table-wrapper">
            <table>
            <thead>
            <tr>
               <th>Criminal Image</th>
               <th>Criminal ID</th>
               <th>Criminal Name</th>
               <th>Assigned Officer</th>
               <th>Crime Type</th>
               <th>Section</th>
               <th>DOB</th>
               <th>Arrest Date</th>
               <th>Crime Date</th>
               <th>Gender</th>
               <th>Address</th>
            </tr>
            </thead>
            <tbody>
<?php
   include("../../config/config.php");
   $q1 = "SELECT * FROM `info` ORDER BY `id` DESC";
   $result = $db->query($q1);
   if($result){
       $hasData = false;
       while($row=$result->fetchArray(SQLITE3_ASSOC)){
           $hasData = true;
           $imgPath = $row['img'];
           if(strpos($imgPath, '../') === 0) {
               $imgPath = substr($imgPath, 3);
           }
           echo'
   <tr>
           <td><img src="../../'.$imgPath.'" width="80" height="80" style="object-fit: cover;"></td>
           <td>'.$row['id'].'</td>
           <td>'.$row['name'].'</td>
           <td>'.$row['offname'].'</td>
           <td>'.$row['crime'].'</td>
           <td>'.$row['more'].'</td>
           <td>'.$row['dob'].'</td>
           <td>'.$row['arrDate'].'</td>
           <td>'.$row['crimeDate'].'</td>
           <td>'.$row['sex'].'</td>
           <td>'.$row['address'].'</td>
   </tr>';
       }
       if(!$hasData) {
           echo'<tr><td colspan="11">No criminals found</td></tr>';
       }
   }
   else{
       echo'<tr><td colspan="11">Error loading data</td></tr>';
   }
   ?>
            </tbody>
            </table>
         </div>
      </div>
   </body>
</html>
