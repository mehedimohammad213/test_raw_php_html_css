<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Criminal List</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../css/style_1.css'>
   </head>
   <body>
      <button name="logout" style="margin-left: 1424px;"><img src="../images/logout.png" style="width:10px"><a href = "../auth/logout.php">Log out</a></button>
      <div class="container" style="height:980px;">
      <div class="finaldiv">
      <span class="head1"><img src="../images/police_logo.png" width="16.2%"></span>
      <span class="head_txt">Criminal Management System</span>
      <span class="head2"><img src="../images/police_logo.png" width="38%"></span>
      <br>
      <div class="navbar">
         <ul style="margin-left:20px">
            <li><a href="home.php"><b>Criminal Information</b></a></li>
            <li><a href="search.php"><b>Search Records</b></a></li>
            <li><a href="criminalList.php" class="active"><b>List of Criminals</b></a></li>
            <li><a href="../Officers/offList.php"><b>List of Officers</b></a></li>
            <li><a href="analysis.php"><b>Analytics</b></a></li>
         </ul>
         <br>
         <br>
         <div style="overflow-x: auto;">
            <img src="../images/police_logo_1.png" style="position:absolute;top:140px;margin-top: 110px; background-size: 90%;margin-left:200px; height:469px">
            <table border="5" style="position:absolute; left:150px;top:200px; background-color: white; z-index: 1;">
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
   include("../config/config.php");
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
           <td><img src="../'.$imgPath.'" width="80" height="80" style="object-fit: cover;"></td>
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
