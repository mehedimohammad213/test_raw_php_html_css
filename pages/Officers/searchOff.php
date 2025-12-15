<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Criminal Management System - Search Officer</title>
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
            <li><a href="searchOff.php" class="active"><b>Search Officer</b></a></li>
            <li><a href="weapon.php"><b>Weapons Assigned</b></a></li>
        </ul>
    </div>
        <span class="searchGroup">
            <form method="post">
            <input type="text" class="searchBar" placeholder="Search officers by name" name="search">
            <button class="searchBtn" type="submit"><img src="../../images/search.png" alt="Search"></button>
        </form>
        <?php
        include("../../config/config.php");
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data=SQLite3::escapeString($_POST['search']);
            $q1="SELECT offName, offID,ID,contact,gender,weapon,role FROM officer WHERE offName LIKE '%$data%' COLLATE NOCASE";
            $result=$db->query($q1);
            if($result)
            {
                $rows = [];
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    $rows[] = $row;
                }

                if (count($rows) <= 0) {
                    echo "<script>alert('Record Not Found')</script>";
                    die('');
                }

                echo '
        <div class="table-wrapper">
        <table>
        <tr>
            <th>Officer Name</th>
            <th>Officer ID</th>
            <th>Assigned case ID</th>
            <th>Contact</th>
            <th>Gender</th>
            <th>Weapon</th>
            <th>Role</th>
        </tr>';

                foreach ($rows as $row) {
        echo'
        <tr>
            <td>'.$row['offName'].'</td>
            <td>'.$row['offID'].'</td>
             <td>'.$row['ID'].'</td>
             <td>'.$row['contact'].'</td>
              <td>'.$row['gender'].'</td>
               <td>'.$row['weapon'].'</td>
                <td>'.$row['role'].'</td>
        </tr>';
                }
            }
        }
    ?>
    </table></div>
        </span>
    </div>
    </div>
    </body>
    </html>
