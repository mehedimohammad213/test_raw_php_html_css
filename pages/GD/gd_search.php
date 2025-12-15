<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Search General Diary</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../../css/style_1.css'>
      <style>
         .gd-search-wrapper{
            margin-top: 140px;
         }
         .gd-search-form{
            display: flex;
            flex-wrap: wrap;
            gap: 8px 16px;
            background: rgba(255,255,255,0.95);
            padding: 12px;
            border-radius: 6px;
         }
         .gd-search-form label{
            font-size: 14px;
            font-weight: 600;
            display:block;
         }
         .gd-search-form input,
         .gd-search-form select{
            padding: 4px 6px;
            font-size: 14px;
         }
         .gd-search-row{
            display:flex;
            flex-direction:column;
         }
         .gd-search-results{
            margin-top: 16px;
            overflow-x:auto;
         }
         table.gd-table{
            width: 100%;
            border-collapse: collapse;
            background:#fff;
         }
         table.gd-table th,
         table.gd-table td{
            padding: 6px 8px;
            border: 1px solid #000;
            font-size: 14px;
            text-align:left;
         }
         table.gd-table th{
            background:#f5f5f5;
         }
         @media (max-width:768px){
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
            .gd-search-form{
               flex-direction:column;
            }
            .gd-search-row{
               width:100%;
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
                  <li><a href="gd_list.php"><b>GD List</b></a></li>
                  <li><a href="gd_search.php" class="active"><b>Search GD</b></a></li>
               </ul>
            </div>
            <div class="gd-search-wrapper">
               <?php
                  include("../../config/config.php");

                  $entry_no = trim($_POST['entry_no'] ?? "");
                  $officer_id = trim($_POST['officer_id'] ?? "");
                  $from_date = trim($_POST['from_date'] ?? "");
                  $to_date = trim($_POST['to_date'] ?? "");
                  $type = trim($_POST['type'] ?? "");
                  $keyword = trim($_POST['keyword'] ?? "");

                  $officers = [];
                  $offRes = $db->query("SELECT offID, offName FROM officer ORDER BY offName ASC");
                  if($offRes){
                      while($row = $offRes->fetchArray(SQLITE3_ASSOC)){
                          $officers[] = $row;
                      }
                  }
               ?>
               <form method="post" class="gd-search-form">
                  <div class="gd-search-row">
                     <label for="entry_no">GD No</label>
                     <input type="text" id="entry_no" name="entry_no" value="<?php echo htmlspecialchars($entry_no); ?>">
                  </div>
                  <div class="gd-search-row">
                     <label for="officer_id">Officer</label>
                     <select name="officer_id" id="officer_id">
                        <option value="">-- Any --</option>
                        <?php
                           foreach($officers as $off){
                               $sel = $officer_id === (string)$off['offID'] ? 'selected' : '';
                               echo '<option value="'.htmlspecialchars($off['offID']).'" '.$sel.'>'.
                                    htmlspecialchars($off['offName']).' (ID: '.htmlspecialchars($off['offID']).')</option>';
                           }
                        ?>
                     </select>
                  </div>
                  <div class="gd-search-row">
                     <label for="from_date">From Date</label>
                     <input type="date" id="from_date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>">
                  </div>
                  <div class="gd-search-row">
                     <label for="to_date">To Date</label>
                     <input type="date" id="to_date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>">
                  </div>
                  <div class="gd-search-row">
                     <label for="type">Type</label>
                     <select name="type" id="type">
                        <option value="">-- Any --</option>
                        <?php
                           $types = ['Complaint','Information','Patrol Note','Misc'];
                           foreach($types as $t){
                               $sel = $type === $t ? 'selected' : '';
                               echo '<option value="'.htmlspecialchars($t).'" '.$sel.'>'.htmlspecialchars($t).'</option>';
                           }
                        ?>
                     </select>
                  </div>
                  <div class="gd-search-row" style="flex:1;">
                     <label for="keyword">Keyword (subject/details)</label>
                     <input type="text" id="keyword" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                  </div>
                  <div class="gd-search-row" style="align-self:flex-end;">
                     <button type="submit" class="submitBtn">Search</button>
                  </div>
               </form>
               <div class="gd-search-results">
                  <table class="gd-table">
                     <thead>
                        <tr>
                           <th>GD No</th>
                           <th>Date & Time</th>
                           <th>Officer</th>
                           <th>Station</th>
                           <th>Type</th>
                           <th>Subject</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           if($_SERVER['REQUEST_METHOD'] === 'POST'){
                               $conditions = [];

                               if($entry_no !== ""){
                                   $entry_no_esc = SQLite3::escapeString($entry_no);
                                   $conditions[] = "g.entry_no LIKE '%$entry_no_esc%'";
                               }
                               if($officer_id !== ""){
                                   $officer_id_esc = SQLite3::escapeString($officer_id);
                                   $conditions[] = "g.officer_id = '$officer_id_esc'";
                               }
                               if($from_date !== ""){
                                   $from_date_esc = SQLite3::escapeString($from_date);
                                   $conditions[] = "substr(g.entry_datetime,1,10) >= '$from_date_esc'";
                               }
                               if($to_date !== ""){
                                   $to_date_esc = SQLite3::escapeString($to_date);
                                   $conditions[] = "substr(g.entry_datetime,1,10) <= '$to_date_esc'";
                               }
                               if($type !== ""){
                                   $type_esc = SQLite3::escapeString($type);
                                   $conditions[] = "g.type = '$type_esc'";
                               }
                               if($keyword !== ""){
                                   $keyword_esc = SQLite3::escapeString($keyword);
                                   $conditions[] = "(g.subject LIKE '%$keyword_esc%' OR g.details LIKE '%$keyword_esc%')";
                               }

                               $where = "";
                               if(!empty($conditions)){
                                   $where = "WHERE " . implode(" AND ", $conditions);
                               }

                               $q = "SELECT g.id, g.entry_no, g.entry_datetime, g.station, g.type, g.subject,
                                            o.offName
                                     FROM gd_entries g
                                     LEFT JOIN officer o ON g.officer_id = o.offID
                                     $where
                                     ORDER BY g.entry_datetime DESC, g.id DESC";
                               $result = $db->query($q);

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
                                           <td><a href="gd_print.php?id='.urlencode($row['id']).'" target="_blank">Print</a></td>
                                       </tr>';
                                   }
                                   if(!$hasData){
                                       echo '<tr><td colspan="7">No entries found</td></tr>';
                                   }
                               } else {
                                   echo '<tr><td colspan="7">Error running search</td></tr>';
                               }
                           } else {
                               echo '<tr><td colspan="7">Use the filters above and click Search.</td></tr>';
                           }
                        ?>
                     </tbody>
                  </table>
                  <div style="margin-top:12px;">
                     <a href="gd_create.php"><button class="submitBtn">New Entry</button></a>
                     <a href="gd_list.php"><button class="submitBtn">View All</button></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
