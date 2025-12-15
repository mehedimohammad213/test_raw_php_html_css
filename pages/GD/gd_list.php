<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - General Diary List</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../../css/style_1.css'>
      <style>
         .gd-table-wrapper{
            margin-top: 140px;
            overflow-x: auto;
         }
         table.gd-table{
            width: 100%;
            border-collapse: collapse;
            background: #fff;
         }
         table.gd-table th,
         table.gd-table td{
            padding: 6px 8px;
            border: 1px solid #000;
            font-size: 14px;
            text-align: left;
         }
         table.gd-table th{
            background: #f5f5f5;
         }
         @media (max-width: 768px){
            .container{
               margin:16px;
               width:auto;
               height:auto;
            }
            .navbar{
               width:auto;
               margin:100px 8px 0 8px;
               overflow-x:auto;
               white-space:nowrap;
            }
            .navbar ul{
               display:inline-flex;
            }
            .gd-table-wrapper{
               margin-top: 140px;
            }
         }
      </style>
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
            <li><a href="gd_create.php"><b>New GD Entry</b></a></li>
            <li><a href="gd_list.php" class="active"><b>GD List</b></a></li>
            <li><a href="gd_search.php"><b>Search GD</b></a></li>
         </ul>
      </div>
      <div class="gd-table-wrapper">
         <?php
            include("../../config/config.php");

            $q = "SELECT g.id, g.entry_no, g.entry_datetime, g.station, g.type, g.subject,
                         o.offName, g.related_criminal_id
                  FROM gd_entries g
                  LEFT JOIN officer o ON g.officer_id = o.offID
                  ORDER BY g.entry_datetime DESC, g.id DESC";
            $result = $db->query($q);
         ?>
         <table class="gd-table">
            <thead>
               <tr>
                  <th>GD No</th>
                  <th>Date & Time</th>
                  <th>Officer</th>
                  <th>Station</th>
                  <th>Type</th>
                  <th>Subject</th>
                  <th>Related Criminal ID</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  if($result){
                      $hasData = false;
                      while($row = $result->fetchArray(SQLITE3_ASSOC)){
                          $hasData = true;
                          echo '<tr>
                              <td>'.htmlspecialchars($row['entry_no']).'</td>
                              <td>'.htmlspecialchars($row['entry_datetime']).'</td>
                              <td>'.htmlspecialchars($row['offName']).'</td>
                              <td>'.htmlspecialchars($row['station']).'</td>
                              <td>'.htmlspecialchars($row['type']).'</td>
                              <td>'.htmlspecialchars($row['subject']).'</td>
                              <td>'.htmlspecialchars($row['related_criminal_id']).'</td>
                              <td><a href="gd_print.php?id='.urlencode($row['id']).'" target="_blank">Print</a></td>
                          </tr>';
                      }
                      if(!$hasData){
                          echo '<tr><td colspan="8">No GD entries found</td></tr>';
                      }
                  } else {
                      echo '<tr><td colspan="8">Error loading data</td></tr>';
                  }
               ?>
            </tbody>
         </table>
         <div style="margin-top:12px;">
            <a href="gd_create.php"><button class="submitBtn">New Entry</button></a>
            <a href="gd_search.php"><button class="submitBtn">Search</button></a>
         </div>
      </div>
      </div>
      </div>
   </body>
</html>
