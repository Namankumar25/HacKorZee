<?php
include "dbconnect.php";
session_start();

if ($_SESSION['signedup']!=true||!isset($_SESSION['passwordsignup'])||!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

else{
    $user_name_login=$_SESSION['usernamesignup'];
    $fetchsql="SELECT `user_email`,`name` FROM `signupusers` WHERE `user_name`='$user_name_login'";
    $fetchresult=mysqli_query($conn,$fetchsql);
  
    $row=mysqli_fetch_assoc($fetchresult);
    $stud_email=$row['user_email'];
    $stud_name=$row['name'];
    
    //updating student status
    $updatesql="UPDATE `organizerdashboard` SET `student_status` = 'offline' WHERE `organizerdashboard`.`student_email` = '$stud_email' AND `organizerdashboard`.`student_Name`='$stud_name'";
    $updateresult=mysqli_query($conn,$updatesql);

    session_unset();
    session_destroy();
    header('location:index.php');
}
exit();
?>