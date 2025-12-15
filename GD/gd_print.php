<?php
   include("../config/config.php");

   $id = isset($_GET['id']) ? trim($_GET['id']) : "";
   if($id === ""){
       echo "Invalid GD entry.";
       exit;
   }

   $id_esc = SQLite3::escapeString($id);
   $q = "SELECT g.*, o.offName
         FROM gd_entries g
         LEFT JOIN officer o ON g.officer_id = o.offID
         WHERE g.id = '$id_esc'
         LIMIT 1";
   $result = $db->querySingle($q, true);
   if(!$result){
       echo "GD entry not found.";
       exit;
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>General Diary Entry - Print</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <style>
         body{
            font-family: Arial, Helvetica, sans-serif;
            margin:16px;
         }
         .gd-print-wrapper{
            max-width: 800px;
            margin:0 auto;
            border:1px solid #000;
            padding:16px;
            background:#fff;
         }
         .gd-print-header{
            text-align:center;
            margin-bottom:16px;
         }
         .gd-print-row{
            display:flex;
            flex-wrap:wrap;
            margin-bottom:4px;
         }
         .gd-print-label{
            width:160px;
            font-weight:bold;
         }
         .gd-print-value{
            flex:1;
         }
         .gd-print-details{
            margin-top:12px;
            white-space:pre-wrap;
         }
         @media print{
            button{
               display:none;
            }
         }
      </style>
   </head>
   <body>
      <button onclick="window.print();" style="margin-bottom:12px;">Print</button>
      <div class="gd-print-wrapper">
         <div class="gd-print-header">
            <h2>General Diary Entry</h2>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">GD No:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['entry_no']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Date & Time:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['entry_datetime']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Officer:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['offName']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Station:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['station']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Type:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['type']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Subject:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['subject']); ?></div>
         </div>
         <div class="gd-print-row">
            <div class="gd-print-label">Related Criminal ID:</div>
            <div class="gd-print-value"><?php echo htmlspecialchars($result['related_criminal_id']); ?></div>
         </div>
         <div class="gd-print-details">
            <strong>Details:</strong><br>
            <?php echo nl2br(htmlspecialchars($result['details'])); ?>
         </div>
      </div>
   </body>
</html>
