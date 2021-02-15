<?php
include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $name_of_hackathon=$_POST['hackathon'];
    $organizer=$_SESSION['usernamesignup'];
    $idsql="SELECT `Hack_id`,`Hack_admin` FROM `hackathons_thread` WHERE `Hack_name`='$name_of_hackathon'";
    $idresult=mysqli_query($conn,$idsql);
    $idrow=mysqli_fetch_assoc($idresult);
    $hack_id=$idrow['Hack_id'];
    $hack_organizer=$idrow['Hack_admin'];

    if($hack_organizer!=$organizer){
        header("location:startup.php");
    }
    else{
    $sql="SELECT `announcement`,`time`,`sender` FROM `announcements` WHERE `hackathon_id`='$hack_id' AND `hackathon_name`='$name_of_hackathon'";
    $result=mysqli_query($conn,$sql);

    $user_set;
    $set_sender;
    if ($result) {
        while($row=mysqli_fetch_assoc($result)){
            if($row['sender']=="organizer"){
                $user_set="Announcement";
                $set_sender="(You)";
            }
            else {
                $user_set="Query";
                $set_sender="Team";
            }
        
        echo '<div class="alert alert-primary" role="alert">
        <p style="font-size:15px">'.$set_sender.': <strong>'.$row['sender'].'</strong></p>
        <p style="font-size:18px"><strong>'.$user_set.' :- '.$row['announcement'].'<strong></p>
            <p class="text-right mt-4" style="font-size:12px"><strong>'.$row['time'].'</strong><p>
        </div>';
            }
        }
    }
}

?>