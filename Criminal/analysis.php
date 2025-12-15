<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Home</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../css/style_1.css'>
      <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
      <script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
      <style type="text/css">
         #contain{
            height: 600px;
            width: 600px;
            margin-left: 150px;
            margin-top: 20px;
         }
      </style>
   </head>
   <body>
      <button name="logout" style="margin-left: 1424px;"><img src="../images/logout.png" style="width:10px"><a href = "../auth/logout.php">Log out</a></button>
      <div class="container" style="height:780px;">
         <div class="finaldiv">
            <span class="head1"><img src="../images/police_logo.png" width="16.2%"></span>
            <span class="head_txt">Criminal Management System</span>
            <span class="head2"><img src="../images/police_logo.png" width="38%"></span>
            <br>
            <div class="navbar">
               <ul style="margin-left:20px">
                  <li><a href="home.php"><b>Criminal Information</b></a></li>
                  <li><a href="search.php"><b>Search Records</b></a></li>
                  <li><a href="criminalList.php"><b>List of Criminals</b></a></li>
                  <li><a href="../Officers/offList.php"><b>List of Officers</b></a></li>
            <li><a href="analysis.php" class="active"><b>Analytics</b></a></li>
               </ul>
               <div id="contain" style=""></div>
            <?php
                  include("../config/config.php");
                  $result="ABC";
                  $total="";
                  $temp="";
                  $Ragging=$Robbery=$Kidnapping=$Rape=$Murder=$Fraud="";
                  $q2="SELECT COUNT(*) as count FROM `info`";
                  $result=$db->query($q2);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $total=$row['count'];

                  $Ragging_query="SELECT COUNT(*) as count from info where crime='Ragging'";
                  $result=$db->query($Ragging_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Ragging=$total > 0 ? ($row['count']/$total*100) : 0;

                  $Robbery_query="SELECT COUNT(*) as count from info where crime='Robbery'";
                  $result=$db->query($Robbery_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Robbery=$total > 0 ? ($row['count']/$total*100) : 0;

                  $Kidnapping_query="SELECT COUNT(*) as count from info where crime='Kidnapping'";
                  $result=$db->query($Kidnapping_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Kidnapping=$total > 0 ? ($row['count']/$total*100) : 0;

                  $Rape_query="SELECT COUNT(*) as count from info where crime='Rape'";
                  $result=$db->query($Rape_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Rape=$total > 0 ? ($row['count']/$total*100) : 0;

                  $Murder_query="SELECT COUNT(*) as count from info where crime='Murder'";
                  $result=$db->query($Murder_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Murder=$total > 0 ? ($row['count']/$total*100) : 0;

                  $Fraud_query="SELECT COUNT(*) as count from info where crime='Fraud'";
                  $result=$db->query($Fraud_query);
                  $row = $result->fetchArray(SQLITE3_ASSOC);
                  $Fraud=$total > 0 ? ($row['count']/$total*100) : 0;
                  echo'
                  <script>
                  anychart.onDocumentReady(function() {
                     var data = [
                        {x: "Ragging", value:"'.$Ragging.'"},
                        {x: "Robbery", value: "'.$Robbery.'"},
                        {x: "Kidnapping", value:"'.$Kidnapping.'"},
                        {x: "Rape", value:"'.$Rape.'"},
                        {x: "Murder", value:"'.$Murder.'"},
                        {x: "Fraud", value:"'.$Fraud.'"},
                     ];
                    var chart = anychart.pie();
                    chart.title("Crime Rate");
                    chart.data(data);
                    chart.container("contain");
                    chart.draw();
                    });
                    </script>







                  ';







              ?>


               </div>

            </div>

            </div>
         </div>
   </body>
</html>
