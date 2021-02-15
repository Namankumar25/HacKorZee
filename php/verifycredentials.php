<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$my_username=$_SESSION['usernamesignup'];
$Hackathon_id=$_GET['hackathon'];    
$enroll="check";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $securityCode=$_POST['security'];
    $sql="SELECT `security_code` FROM `hackathons_thread` WHERE `Hack_id`='$Hackathon_id' AND `Hack_admin`!='$my_username'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $codeHash=$row['security_code'];
    
    if(password_verify($securityCode,$codeHash)){
        header("location:attend.php?hackathon=".$Hackathon_id."");
    }
    
    else{
      $enroll="fail";
      header("location:hackathon_detail.php?hackathon=".$Hackathon_id."&&enroll=".$enroll."");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
    .cont {
        border: solid red 2px;
        height: 100%;
        border-radius: 34px;
    }
    </style>
</head>

<body style="background-color: black;color:white;">

    <div class="container my-5">
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">We Know that your time is precious Please give us 1 minute for security check</h4>
            <p>We find a security code is applied to this Hackathon</p>
            <p class="mb-0">
             <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">   
                    <div class="form">
                        <label>Security Code --> </label>
                        <input type="text" class="form" aria-describedby="emailHelp" name="security"
                            required style="height:46px;width:200px;border:solid red 4px">
                            <button class="btn btn-outline-success mb-2" type="submit">Go</button>
                    </div>
                </form>
            </p>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>