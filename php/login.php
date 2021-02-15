<?php

include "dbconnect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

  
  $user_name_login=$_POST['loginusername'];
  $user_password_login=$_POST['loginpassword'];
  
  $fetchsql="SELECT `user_password`,`user_email`,`name` FROM `signupusers` WHERE `user_name`='$user_name_login'";
  $fetchresult=mysqli_query($conn,$fetchsql);

  $row=mysqli_fetch_assoc($fetchresult);
  $stud_email=$row['user_email'];
  $stud_name=$row['name'];
  
  //updating student status
  $updatesql="UPDATE `organizerdashboard` SET `student_status` = 'online' WHERE `organizerdashboard`.`student_email` = '$stud_email' AND `organizerdashboard`.`student_Name`='$stud_name'";
  $updateresult=mysqli_query($conn,$updatesql);
  
  //checking for login info
        if(password_verify($user_password_login,$row['user_password'])){
          session_start();
          $_SESSION['signedup']=true;
          $_SESSION['namesignup']=$row['name'];
          $_SESSION['usernamesignup']=$user_name_login;
          $_SESSION['passwordsignup']=$user_password_login;
          header("location:welcomeuser.php");
        }
        else {
          header("location:index.php?login=false");
        }

}

?>

