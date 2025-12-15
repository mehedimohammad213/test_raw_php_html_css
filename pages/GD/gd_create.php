<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - General Diary Entry</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../../css/style_1.css'>
      <style>
         .gd-form-wrapper{
            max-width: 900px;
            margin: 140px auto 40px auto;
            padding: 16px;
            background: rgba(255,255,255,0.95);
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
         }
         .gd-grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 24px;
         }
         .gd-grid-full{
            grid-column: 1 / -1;
         }
         .gd-grid label{
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
         }
         .gd-grid input,
         .gd-grid select,
         .gd-grid textarea{
            width: 100%;
            padding: 6px 8px;
            box-sizing: border-box;
         }
         @media (max-width: 768px){
            .container{
               margin: 16px;
               width: auto;
               height: auto;
            }
            .head_txt{
               font-size: 28px;
               left: 50%;
               transform: translateX(-50%);
               text-align: center;
            }
            .navbar{
               width: auto;
               margin: 100px 8px 0 8px;
               overflow-x: auto;
               white-space: nowrap;
            }
            .navbar ul{
               display: inline-flex;
            }
            .gd-form-wrapper{
               margin: 140px 8px 24px 8px;
            }
            .gd-grid{
               grid-template-columns: 1fr;
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
                  <li><a href="gd_create.php" class="active"><b>New GD Entry</b></a></li>
                  <li><a href="gd_list.php"><b>GD List</b></a></li>
                  <li><a href="gd_search.php"><b>Search GD</b></a></li>
               </ul>
            </div>
            <div class="gd-form-wrapper">
               <?php
                  include("../../config/config.php");

                  $entry_no = $entry_datetime = $officer_id = $station = $type = $subject = $details = $related_criminal_id = "";
                  $errors = [];
                  $success = "";

                  if($_SERVER['REQUEST_METHOD'] === 'POST'){
                      $entry_no = trim($_POST['entry_no'] ?? "");
                      $entry_datetime = trim($_POST['entry_datetime'] ?? "");
                      $officer_id = trim($_POST['officer_id'] ?? "");
                      $station = trim($_POST['station'] ?? "");
                      $type = trim($_POST['type'] ?? "");
                      $subject = trim($_POST['subject'] ?? "");
                      $details = trim($_POST['details'] ?? "");
                      $related_criminal_id = trim($_POST['related_criminal_id'] ?? "");

                      if($entry_no === ""){ $errors[] = "Entry number is required."; }
                      if($entry_datetime === ""){ $errors[] = "Entry date & time is required."; }
                      if($officer_id === ""){ $errors[] = "Officer is required."; }
                      if($station === ""){ $errors[] = "Station is required."; }
                      if($type === ""){ $errors[] = "Type is required."; }
                      if($subject === ""){ $errors[] = "Subject is required."; }
                      if($details === ""){ $errors[] = "Details are required."; }

                      if(empty($errors)){
                          $entry_no_esc = SQLite3::escapeString($entry_no);
                          $entry_datetime_esc = SQLite3::escapeString($entry_datetime);
                          $officer_id_esc = SQLite3::escapeString($officer_id);
                          $station_esc = SQLite3::escapeString($station);
                          $type_esc = SQLite3::escapeString($type);
                          $subject_esc = SQLite3::escapeString($subject);
                          $details_esc = SQLite3::escapeString($details);
                          $related_criminal_id_esc = $related_criminal_id !== "" ? SQLite3::escapeString($related_criminal_id) : null;

                          $related_value = $related_criminal_id_esc !== null ? "'$related_criminal_id_esc'" : "NULL";

                          $q = "INSERT INTO `gd_entries`
                                (`entry_no`, `entry_datetime`, `officer_id`, `station`, `type`, `subject`, `details`, `related_criminal_id`)
                                VALUES
                                ('$entry_no_esc', '$entry_datetime_esc', '$officer_id_esc', '$station_esc', '$type_esc', '$subject_esc', '$details_esc', $related_value)";

                          if($db->exec($q)){
                              $success = "General Diary entry created successfully.";
                              $entry_no = $entry_datetime = $officer_id = $station = $type = $subject = $details = $related_criminal_id = "";
                          } else {
                              $errors[] = $db->lastErrorMsg();
                          }
                      }
                  }

                  if(!empty($errors)){
                      echo '<div style="color:red;margin-bottom:10px;"><ul>';
                      foreach($errors as $e){
                          echo '<li>'.htmlspecialchars($e).'</li>';
                      }
                      echo '</ul></div>';
                  }
                  if($success !== ""){
                      echo '<div style="color:green;margin-bottom:10px;">'.htmlspecialchars($success).'</div>';
                  }

                  $officers = [];
                  $offRes = $db->query("SELECT offID, offName FROM officer ORDER BY offName ASC");
                  if($offRes){
                      while($row = $offRes->fetchArray(SQLITE3_ASSOC)){
                          $officers[] = $row;
                      }
                  }
               ?>
               <form method="post">
                  <div class="gd-grid">
                     <div>
                        <label for="entry_no">GD Entry No</label>
                        <input type="text" name="entry_no" id="entry_no" value="<?php echo htmlspecialchars($entry_no); ?>" required>
                     </div>
                     <div>
                        <label for="entry_datetime">Entry Date & Time</label>
                        <input type="datetime-local" name="entry_datetime" id="entry_datetime" value="<?php echo htmlspecialchars($entry_datetime); ?>" required>
                     </div>
                     <div>
                        <label for="officer_id">Officer</label>
                        <select name="officer_id" id="officer_id" required>
                           <option value="">-- Select Officer --</option>
                           <?php
                              foreach($officers as $off){
                                  $selected = $officer_id === (string)$off['offID'] ? 'selected' : '';
                                  echo '<option value="'.htmlspecialchars($off['offID']).'" '.$selected.'>'.
                                       htmlspecialchars($off['offName']).' (ID: '.htmlspecialchars($off['offID']).')</option>';
                              }
                           ?>
                        </select>
                     </div>
                     <div>
                        <label for="station">Station</label>
                        <input type="text" name="station" id="station" value="<?php echo htmlspecialchars($station); ?>" required>
                     </div>
                     <div>
                        <label for="type">Type</label>
                        <select name="type" id="type" required>
                           <option value="">-- Select Type --</option>
                           <?php
                              $types = ['Complaint','Information','Patrol Note','Misc'];
                              foreach($types as $t){
                                  $sel = $type === $t ? 'selected' : '';
                                  echo '<option value="'.htmlspecialchars($t).'" '.$sel.'>'.htmlspecialchars($t).'</option>';
                              }
                           ?>
                        </select>
                     </div>
                     <div>
                        <label for="related_criminal_id">Related Criminal ID (optional)</label>
                        <input type="number" name="related_criminal_id" id="related_criminal_id" value="<?php echo htmlspecialchars($related_criminal_id); ?>">
                     </div>
                     <div class="gd-grid-full">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($subject); ?>" required>
                     </div>
                     <div class="gd-grid-full">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" rows="6" required><?php echo htmlspecialchars($details); ?></textarea>
                     </div>
                  </div>
                  <button type="submit" class="submitBtn"><b>Save</b></button>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>
