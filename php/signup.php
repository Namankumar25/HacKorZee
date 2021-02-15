<?php
include "dbconnect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $name=$_POST['name'];
    $user_email=$_POST['useremail'];
    $signup_user_name=$_POST['signupusername'];
    
    $sign_up_password=$_POST['signuppassword'];
    $signup_confirm_password=$_POST['cpassword'];

    $passwordhash=password_hash($sign_up_password,PASSWORD_DEFAULT);
    if($sign_up_password==$signup_confirm_password){
    $insertsql="INSERT INTO `signupusers` (`sno.`, `name`, `user_email`, `user_name`, `user_password`, `time`) VALUES (NULL, '$name', '$user_email', '$signup_user_name', '$passwordhash', current_timestamp())";
    $result=mysqli_query($conn,$insertsql);
    if($result){
        session_start();

        $_SESSION['signedup']=true;
        $_SESSION['namesignup']=$name;
        $_SESSION['usernamesignup']=$signup_user_name;
        $_SESSION['passwordsignup']=$sign_up_password;
        header("location:welcomeuser.php");
    }
    else{
        header("location:index.php?user=false");
    }

}

}


?>