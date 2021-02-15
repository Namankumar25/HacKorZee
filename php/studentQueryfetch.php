<?php
include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $name_of_hackathon=$_POST['hackathon'];
    $student_team_Name=$_POST['studentteam'];
    $organizer=$_SESSION['usernamesignup'];
    $idsql="SELECT `Hack_id`,`Hack_admin` FROM `hackathons_thread` WHERE `Hack_name`='$name_of_hackathon'";
    $idresult=mysqli_query($conn,$idsql);
    $idrow=mysqli_fetch_assoc($idresult);
    $hack_id=$idrow['Hack_id'];
    $hack_organizer=$idrow['Hack_admin'];
    
    $sql="SELECT `announcement`,`time`,`sender` FROM `announcements` WHERE (`hackathon_id`='$hack_id' AND `sender`='$student_team_Name') || (`hackathon_id`='$hack_id' AND `sender`='organizer')";
    $result=mysqli_query($conn,$sql);

    $user_set;
 

    if ($result) {
        while($row=mysqli_fetch_assoc($result)){
            if($row['sender']=="organizer"){
                $user_set="Announcement";
            }
            else {
                $user_set="Query";
            }
        
        echo '<div class="alert alert-primary" role="alert">
        <p style="font-size:15px"><strong>'.$row['sender'].'</strong></p>
        <p style="font-size:18px"><strong>'.$user_set.' :- '.$row['announcement'].'</strong></p>
            <p class="text-right mt-4" style="font-size:12px"><strong>'.$row['time'].'</strong><p>
        </div>';
            }
        }

}

?>