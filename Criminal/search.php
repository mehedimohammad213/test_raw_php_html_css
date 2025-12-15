<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Home</title>
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
                  <li><a href="search.php" class="active"><b>Search Records</b></a></li>
                  <li><a href="criminalList.php"><b>List of Criminals</b></a></li>
                  <li><a href="../Officers/offList.php"><b>List of Officers</b></a></li>
            <li><a href="analysis.php"><b>Analytics</b></a></li>
               </ul>
            </div>
            <div class="searchGroup" >
               <form method="post" action="">
                  <input type="text" class="searchBar" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search Criminal's By Name" name="search" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                  <button type="submit" class="searchBtn"><img src="../images/search.png" width="50%"></button>
                  <img src="../images/police_logo_1.png" style="position:absolute;top:140px;margin-top: -90px; background-size: 90%;margin-left: -50px; height:469px">
               </form>
               <?php
                  include("../config/config.php");
                  session_start();

                  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search']) && !empty(trim($_POST['search'])))
                  {
                      $data=trim($_POST['search']);
                      $escaped_data = SQLite3::escapeString($data);
                      $_SESSION['data']=$escaped_data;

                      // Use LIKE for partial match and case-insensitive search
                      $q1="SELECT * FROM info WHERE name LIKE '%$escaped_data%' OR id LIKE '%$escaped_data%' COLLATE NOCASE";
                      $result=$db->query($q1);

                      if($result)
                      {
                          $rows = [];
                          while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                              $rows[] = $row;
                          }

                          if (count($rows) <= 0) {
                              echo "<script>alert('Record Not Found')</script>";
                          } else {
                              echo '<div style="overflow-x: auto; margin-top: 20px;">
                              <table border="5" style="position:relative;left:-180px;top: 65px; background-color: white; z-index: 1;">
                              <thead>
                          <tr>
                              <th>Criminal Image</th>
                              <th>Criminal ID</th>
                              <th>Criminal Name</th>
                              <th>Assigned Officer</th>
                              <th>Crime Type</th>
                              <th>Section</th>
                              <th>Criminals DOB</th>
                              <th>Arrest Date</th>
                              <th>Date of Crime</th>
                              <th>Gender</th>
                              <th>Address</th>
                          </tr>
                          </thead>
                          <tbody>';

                          foreach ($rows as $row) {
                              $imgPath = $row['img'];
                              if(strpos($imgPath, '../') === 0) {
                                  $imgPath = substr($imgPath, 3);
                              }
                              echo '
                  <tr>
                      <td><img src="../'.$imgPath.'" width="100" height="100" style="object-fit: cover;" onerror="this.src=\'../images/download.jpg\'"></td>
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

                          echo '</tbody></table>
                          <center><a href="printable.php" target="_blank" style="position: absolute;top: 500px;left: 400px;"><button name="print" class="submitBtn">Print</button></a></center>
                          </div>';
                          }
                      }
                      else{
                          echo "<script>alert('Error: " . $db->lastErrorMsg() . "')</script>";
                      }
                  }











                  ?>
            </div>
         </div>
      </div>
      </div>

   </body>
</html>