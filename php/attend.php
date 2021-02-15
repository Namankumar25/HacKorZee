<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$user_name_attend=$_SESSION['usernamesignup'];

$sql="SELECT `user_email`,`sno.` FROM `signupusers` WHERE `user_name`='$user_name_attend'";
$result=mysqli_query($conn,$sql);

if($result){
$row=mysqli_fetch_assoc($result);
$attend_useremail=$row['user_email'];
$attend_userid=$row['sno.'];
echo "all set";
}
else{
    echo "problem in server";
}

if(isset($_GET['hackathon'])){
$hackathonId=$_GET['hackathon'];    
$sqlfetch="SELECT `Hack_name`,`Hack_admin` FROM `hackathons_thread` WHERE `Hack_id`='$hackathonId'";
$resultfetch=mysqli_query($conn,$sqlfetch);
$rowfetch=mysqli_fetch_assoc($resultfetch);

$Hackthon_name=$rowfetch['Hack_name'];
$Hackthon_organizer=$rowfetch['Hack_admin'];


//inserting into database
$sqlinsert="INSERT INTO `attendhackathon` (`Sno.`, `attend_Hack_id`, `hackathon_name`, `organizer`, `attend_user_name`, `attend_user_email`, `user_type`, `attend_user_id`, `user_status`, `time`) VALUES (NULL, '$hackathonId', '$Hackthon_name', '$Hackthon_organizer', '$user_name_attend', '$attend_useremail', 'attendee', '$attend_userid', 'offline', current_timestamp());";
$insertresult=mysqli_query($conn,$sqlinsert);
if($insertresult){
    header('location:hackathon_detail.php?hackathon='.$hackathonId.'');
}

}

?>