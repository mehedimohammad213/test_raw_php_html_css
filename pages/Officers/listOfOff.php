<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Criminal Management System - Officers</title>
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
            <li><a href="addOfficer.php"><b>Add Officer</b></a></li>
            <li><a href="searchOff.php" ><b>Search Records</b></a></li>
            <li><a href="weapon.php" class="active"><b>Weapons Assigned</b></a></li>
        </ul>
        <div class="table-wrapper">
        <table>
        <tr>
            <th>Officer ID</th>
            <th>Officer Name</th>
            <th>Weapon</th>
            <th>Role</th>
        </tr>

    </div>
    </div>
    </div>
    </div>
    </body>
    </html>
    <?php
        include("../../config/config.php");
        $q1 = "SELECT * FROM `officer`";
        $result = $db->query($q1);
        if($result){
            while($row=$result->fetchArray(SQLITE3_ASSOC)){
                echo'

        <tr>

                <td>'. $row['offID'].'</td>
                <td>'.$row['offName'].'</td>
                <td>'. $row['weapon'].'</td>
                <td>'.$row['role'].'</td>
        </tr>';
            }
        }
        else{
            echo"error";
        }
     ?>
