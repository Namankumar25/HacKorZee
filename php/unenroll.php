<?php
include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if (isset($_GET['hackathon'])) {
    $hackathon_id=$_GET['hackathon'];
    $user_id_name=$_SESSION['usernamesignup'];
    $sql="DELETE FROM `attendhackathon` WHERE `attendhackathon`.`attend_Hack_id` = '$hackathon_id' AND `attendhackathon`.`attend_user_name` = '$user_id_name'";
    $result=mysqli_query($conn,$sql);
    if ($result) {
        header("location:welcomeuser.php?delete=true");
    }
    else{
        header("location:welcomeuser.php?delete=false");
        
    }
}

?>