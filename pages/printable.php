


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Print Criminal Record</title>
</head>
<body>
<?php
                  include("../config/config.php");
                  session_start();

                  if(isset($_SESSION['data'])) {
                      $data = SQLite3::escapeString($_SESSION['data']);
                      $q1="SELECT * FROM info WHERE name LIKE '%$data%' OR id LIKE '%$data%' COLLATE NOCASE";
                      $result=$db->query($q1);
                      if($result)
                      {
                          $rows = [];
                          while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                              $rows[] = $row;
                          }

                          if (count($rows) > 0) {
                              echo '<center><table border="5" style="margin-top: 20px;">
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
                          <td><img src="../'.$imgPath.'" width="100" onerror="this.src=\'../images/download.jpg\'"></td>
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
                              echo '</tbody></table></center>';
                          }
                      }
                  }
                  ?>
                  <script type="text/javascript">window.print();</script>
</body>
</html>
