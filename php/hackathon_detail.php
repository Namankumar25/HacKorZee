<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$check_username=$_SESSION['usernamesignup'];
$Hackathon_id=$_GET['hackathon'];    

$asql="SELECT `hackathon_name` FROM `attendhackathon` WHERE `attend_user_name`='$check_username' AND `attend_Hack_id`='$Hackathon_id'";
$aresult=mysqli_query($conn,$asql);
$rows=mysqli_num_rows($aresult);

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
<?php
 if($rows>0){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            You are enrolled in this Hackathon !
        <strong></strong> 
    </div>';
        $disable="disabled";
    }
    else {
        $disable="";
    }
?>

<?php
    if(isset($_GET['enroll'])){
        $enroll=$_GET['enroll'];
        if($_GET['enroll']=="fail"){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          Warning :
        <strong>Security Code do not matched ! We think you are looking for another Hackathon, Go back</strong> 
      </div>';
        }
    }
    
?>


    <div class="container cont my-4">
        <?php
    if(isset($_GET['hackathon'])){
        $Hackathon_id=$_GET['hackathon'];    
        $sql="SELECT * FROM `hackathons_thread` WHERE `Hack_id`= '$Hackathon_id' AND `Hack_admin`!='$check_username'";
        $result=mysqli_query($conn,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
                echo '<h3 class="container mb-4 mt-2">Hackathon Name : '.$row['Hack_name'].'</h3>
                     <h4 class="container"><u>About Hackathon</u></h4>
                     <p class="container lead mb-5">'.$row['Hack_desc'].'</p>

                     <h4 class="container"><u>Organized by</u></h4>
                     <p class="container lead">'.$row['organized_by'].'</p>
                    <br>
                     <p class="container lead"><b>starting date</b> : '.$row['start_date'].'</p>
                     <p class="container lead"><b>ending date</b> : '.$row['end_date'].'</p>
                    <br>
                    
                    <h4 class="container"><u>Website/Additional information</u></h4>
                    <p class=" container lead"><a href="'.$row['Additional_link'].'" target="blank">'.$row['Additional_link'].'</a></p>
                    <p class="text-right container lead"><a href="verifycredentials.php?hackathon='.$row['Hack_id'].'" class="btn btn-outline-primary '.$disable.'">Enroll in Hackathon</a></p>
                    <p class="text-right container lead"><a href="welcomeuser.php" class="btn btn-outline-success">Go Back</a></p>
                    <p class="lead container text-right"> '.$row['time'].' </p>
                ';
            }
        }
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