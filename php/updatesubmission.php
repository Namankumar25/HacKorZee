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
    $dsql="SELECT `id` FROM `files` WHERE `Hackathon_id`=$hack_id";
    $dresult=mysqli_query($conn,$dsql);
    $drows=mysqli_num_rows($dresult);
    if($dresult){

     echo '
            <div class="card-header">Submission</div>            
            <div class="card-body bg-success">
                <h5 class="card-title" style="color:white;font-size:45px;">'.$drows.'</h5>
                <p class="card-text"><a class="btn btn-primary" href="downloads.php?hackI='.$hack_id.'">View Submissions</a></p>
            </div>
        ';
    }

  }
}

?>