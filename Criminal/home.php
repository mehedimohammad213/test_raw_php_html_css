<!DOCTYPE html>
<html>
   <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <title>Criminal Management System - Home</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' type='text/css' media='screen' href='../css/style_1.css'>
      <script type="text/javascript">
         function submitBtn()
         {
             if (document.forms["crimeInfo"]["ID"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if (document.forms["crimeInfo"]["name"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if (document.forms["crimeInfo"]["crime"].value=="" || document.forms["crimeInfo"]["crime"].value=="--Select Crime--")
             {
                 alert('Please select a crime type');
                 return false;
             }
             else if(document.forms["crimeInfo"]["dob"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if(document.forms["crimeInfo"]["more"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if(document.forms["crimeInfo"]["arrDate"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if(document.forms["crimeInfo"]["crimeDate"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             else if(document.forms["crimeInfo"]["sex"].value=="")
             {
                 alert('Please select gender');
                 return false;
             }
             else if(document.forms["crimeInfo"]["address"].value=="")
             {
                 alert('Please fill out all the fields');
                 return false;
             }
             return true;
         }
      </script>
   </head>
   <body>
      <button name="logout" style="margin-left: 1424px;"><img src="../images/logout.png" style="width:10px"><a href = "../auth/logout.php">Log out</a></button>
      <div class="container" style="height:980px;">
      <div class="finaldiv">
         <span class="head1"><img src="../images/police_logo.png" width="16.2%"></span>
         <span class="head_txt">Criminal Management System</span>
         <span class="head2"><img src="../images/police_logo.png" width="38%"></span>
         <br>
         <div class="navbar" style="background-color:yellow;">
            <ul style="margin-left:20px">
               <li><a href="home.php" class="active"><b>Criminal Information</b></a></li>
               <li><a href="search.php"><b>Search Records</b></a></li>
               <li><a href="criminalList.php"><b>List of Criminals</b></a></li>
               <li><a href="../Officers/offList.php"><b>List of Officers</b></a></li>
               <li><a href="analysis.php"><b>Analytics</b></a></li>
            </ul>
         </div>
         <form id="crimeInfo" method="post" style="position:absolute;top:140px;background-image: url('../images/police_logo_1.png'); background-repeat:no-repeat;margin-top: 50px; background-size: 90%; width: 50%;height:469px" enctype="multipart/form-data">
            <table >
               <tr>
                  <td>Criminals Image</td>
                  <td>&nbsp;&nbsp;&nbsp;<input type="file" name="my_img"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Criminal ID</td>
                  <td><input type="text" required name="ID"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Criminal Name</td>
                  <td><input type="text" required name="name"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Assigned Officer</td>
                  <td><input type="text" required name="offName"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               <tr>
                  <td>Crime Type</td>
                  <td>
                     <select required name="crime">
                        <option>--Select Crime--</option>
                        <option value="Ragging">Ragging</option>
                        <option value="Robbery">Robbery</option>
                        <option value="Kidnapping">Kidnapping</option>
                        <option value="Rape">Rape</option>
                        <option value="Murder">Murder</option>
                        <option value="Fruad">Fruad</option>
                     </select>
                  </td>


               </tr>
               <td>
                  <br>
               </td>
               <tr>
                  <td>
                     Section
                  </td>
                  <td>
                     <input name="more" required></input>
                  </td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Criminals DOB</td>
                  <td><input type="date" required name="dob"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Arrest Date</td>
                  <td><input type="date" required name="arrDate"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Date of Crime</td>
                  <td><input type="date" required name="crimeDate"></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Gender</td>
                  <td><input type="radio" name="sex" value="M" required>Male
                     <input type="radio" name="sex" value="F">Female
                     <input type="radio" name="sex" value="O">Others
                  </td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
               <tr>
                  <td>Address </td>
                  <td>&nbsp;<textarea rows="2" required name="address"></textarea></td>
               </tr>
               <tr>
                  <td>
                     <br>
                  </td>
               </tr>
            </table>
            <button type="submit" class="submitBtn" onclick="return submitBtn()" value="upload" name="submit"><b>Submit</b></button>
         </form>
      </div>
   </body>
</html>
<?php
   include("../config/config.php");
   $id=$name=$offName=$crime=$dob=$arrDate=$crimeDate=$sex=$address=$pic=$folder=$fname=$more="";
   if(isset($_POST['submit'])){
       $fname = "";
       $folder = "../images/download.jpg"; // Default image

       if(isset($_FILES['my_img']) && $_FILES['my_img']['error'] == 0 && $_FILES['my_img']['size'] > 0){
           $fname=$_FILES['my_img']['name'];
           $tmpname=$_FILES['my_img']['tmp_name'];
           $folder="images/".$fname;
           $upload_path = __DIR__ . "/../images/".$fname;
           if(move_uploaded_file($tmpname, $upload_path)){
               // File uploaded successfully
           } else {
               $folder = "images/download.jpg"; // Use default if upload fails
           }
       } else {
           $folder = "images/download.jpg"; // Use default if no file uploaded
       }

       $id=SQLite3::escapeString($_POST['ID']);
       $name=SQLite3::escapeString($_POST['name']);
       $offName=SQLite3::escapeString($_POST['offName']);
       $crime=SQLite3::escapeString($_POST['crime']);
       $dob=SQLite3::escapeString($_POST['dob']);
       $arrDate=SQLite3::escapeString($_POST['arrDate']);
       $crimeDate=SQLite3::escapeString($_POST['crimeDate']);
       $sex=SQLite3::escapeString($_POST['sex']);
       $address=SQLite3::escapeString($_POST['address']);
       $more=SQLite3::escapeString($_POST['more']);

       $q1="INSERT INTO `info`(`id`, `name`, `offname`, `crime`, `dob`, `arrDate`, `crimeDate`, `sex`, `address`,`img`,`more`) VALUES ('$id','$name','$offName','$crime','$dob','$arrDate','$crimeDate','$sex','$address','$folder','$more')";

       if($db->exec($q1))
       {
          echo "<script>alert('Criminal information added successfully!'); window.location.href='home.php';</script>";
       }
       else{
          echo "<script>alert('Error: " . $db->lastErrorMsg() . "');</script>";
       }
   }



   ?>