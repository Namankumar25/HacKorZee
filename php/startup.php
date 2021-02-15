<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$organizer_username=$_SESSION['usernamesignup'];

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
    .over {
        overflow-y: auto;
        height: 500px;
    }
    </style>
</head>

<body style="background-color: black;color:white;">

<div class="container my-4">

<?php
echo '<h1 class="my-2" style="color:#ff8092;"><u><strong>Your Hackathons Channel</strong></u></h1>';
echo '<a href="welcomeuser.php" class="btn btn-outline-primary mb-2">Go Back</a>';

$sql="SELECT `Hack_name`,`organized_by`,`Hack_id`,`Hack_desc`,`start_date`,`end_date` FROM `hackathons_thread` WHERE `Hack_admin`='$organizer_username'";
$result=mysqli_query($conn,$sql);

if($result){
    while($row=mysqli_fetch_assoc($result)){
    $HackathonN=$row['Hack_name'];    
    $H=$row['Hack_id'];    
    echo ' <div class="alert" role="alert" style="color:white;background: linear-gradient(45deg, #c94d52, #560096)">

                <p>Hackathon name : '.$row['Hack_name'].'</p>
                <p>Description : '.$row['Hack_desc'].'</p>
                <p>Organized by : '.$row['organized_by'].'</p>
                <p>start at : '.$row['start_date'].'</p>
                <p>end at : '.$row['end_date'].'</p>
                                
                <a href="manage_dashboard.php?hackathonN='.$HackathonN.'&&H='.$H.'" class="btn btn-outline-success">/Manage</a>

                <a href="view.php?hackathonN='.$HackathonN.'&&H='.$H.'" class="btn btn-outline-success" style="float:right;">View Enrollment</a>
            </div>
        ';
    }
}
else{
    echo "some problem in server Try again later !";
}

?>

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