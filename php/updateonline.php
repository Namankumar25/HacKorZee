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
$totalmembersql="SELECT `student_status` FROM `organizerdashboard` WHERE `Hackathon_id`='$hack_id' AND `Hackathon_name`='$hackathon_name'";
$totalresult=mysqli_query($conn,$totalmembersql);
$totalrow=mysqli_num_rows($totalresult);

$onlinemembersql="SELECT `student_status` FROM `organizerdashboard` WHERE `Hackathon_id`='$hack_id' AND `Hackathon_name`='$hackathon_name' AND `student_status`='online'";
$onlineresult=mysqli_query($conn,$onlinemembersql);
$onlinerow=mysqli_num_rows($onlineresult);

if($onlineresult){
echo '
<div class="card-header">Members Online</div>
<div class="card-body bg-danger">
    <h5 class="card-title" style="color:white;font-size:45px;">'.$onlinerow.'/'.$totalrow.'</h5>
    <p class="card-text"></p>
</div>';
}
else{
    echo "some problem";
}
}
}
?>