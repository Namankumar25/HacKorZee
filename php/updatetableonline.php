<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
$hackathon_name=$_POST['hackathon'];
$organizer=$_SESSION['usernamesignup'];
$idsql="SELECT `Hack_id`,`Hack_admin` FROM `hackathons_thread` WHERE `Hack_name`='$hackathon_name'";
$idresult=mysqli_query($conn,$idsql);
$idrow=mysqli_fetch_assoc($idresult);
$hack_id=$idrow['Hack_id'];
$hack_organizer=$idrow['Hack_admin'];

if($hack_organizer!=$organizer){
    header("location:startup.php");
}

else{
    $i=0;

    $fetchsql="SELECT `team_Name`,`student_Name`,`student_email`,`student_status` FROM `organizerdashboard` WHERE `Hackathon_id`=$hack_id";
    $fetchresult=mysqli_query($conn,$fetchsql);
    if($fetchresult){
    while($row=mysqli_fetch_assoc($fetchresult)){
    
        echo '
            <tr>
                <th scope="row">'.++$i.'</th>
                <td>'.$row['team_Name'].'</td>
                <td>'.$row['student_Name'].'</td>
                <td>'.$row['student_email'].'</td>
                <td>'.$row['student_status'].'</td>
            </tr>
            ';
    
            }
        }
        else{
        echo "some problem";
        }
    }
}
?>