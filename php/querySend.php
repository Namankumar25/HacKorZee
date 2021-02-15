<?php
include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $my_username=$_SESSION['usernamesignup'];

    $announcement=$_POST['message'];
    $name_of_hackathon=$_POST['hackathonName'];
    $studentTeamName=$_POST['studentTeam'];

    $idsql="SELECT `Hack_id` FROM `hackathons_thread` WHERE `Hack_name`='$name_of_hackathon' AND `Hack_admin`!='$my_username'";
    $idresult=mysqli_query($conn,$idsql);
    if ($idresult) {

        $idrow=mysqli_fetch_assoc($idresult);
        $hack_id=$idrow['Hack_id'];
    
        $sql="INSERT INTO `announcements` (`sno.`, `hackathon_id`, `hackathon_name`, `announcement`, `sender`, `time`) VALUES (NULL, '$hack_id', '$name_of_hackathon', '$announcement', '$studentTeamName', current_timestamp())";
        $result=mysqli_query($conn,$sql);
     
    }
    else {
        header("location:welcomeuser.php");
    }
}

?>