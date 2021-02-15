<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$my_username=$_SESSION['usernamesignup'];
if (isset($_GET['hackathonI'])&&isset($_GET['hackathonN'])) {
    $hackathon_id=$_GET['hackathonI'];    
    $hackathon_name=$_GET['hackathonN'];    
}

$asql="SELECT `attend_user_email` FROM `attendhackathon` WHERE `attend_user_name`='$my_username' AND `attend_Hack_id`='$hackathon_id'";
$aresult=mysqli_query($conn,$asql);
$row=mysqli_fetch_assoc($aresult);
$user_email=$row['attend_user_email'];

if (isset($_GET['check'])) {
    if($_GET['check']=="true"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Your File is uploaded ! All the best for the Results !</strong> 
      </div>  
    ';
    }
    else {
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Something Went wrong Try again Later !</strong> 
          </div>
        ';
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
    * {
        margin: 0;
        padding: 0;
    }
    </style>

    <style>
    .find {
        overflow-y: auto;
        height: 600px;
    }

    </style>
</head>

<body style="background-color: black;color:white;">
    <div class="row container-fluid">

        <div class="container col-6">
        <a href="welcomeuser.php" class="btn btn-danger">Go back</a>
            <div class="jumbotron bg-dark m-4">
                <?php
        $osql="SELECT `team_Name`,`student_Name` FROM `organizerdashboard` WHERE `Hackathon_id`='$hackathon_id' AND `student_email`='$user_email' AND `Hackathon_name`='$hackathon_name'";
        $oresult=mysqli_query($conn,$osql);
        $orow=mysqli_fetch_assoc($oresult);
        
        $teamName=$orow['team_Name'];
        $studentName=$orow['student_Name'];
           
        $teams="SELECT `student_Name` FROM `organizerdashboard` WHERE `Hackathon_id`='$hackathon_id' AND `team_Name`='$teamName' AND `Hackathon_name`='$hackathon_name'";
        $teamsResult=mysqli_query($conn,$teams);

        echo '<h3>Hello, '.$studentName.'</h3>
            <h3>Team Name: '.$teamName.'</h3>
            <h4 class="my-2"><u>Members</u></h4>'
        ;

        while($teamRow=mysqli_fetch_assoc($teamsResult)){
        echo'
            <strong>'.$teamRow['student_Name'].'</strong><br>
        ';    
        }

        ?>
            </div>

            <h1 class="container">Submit Your Project</h1>
            <div class="container" style="border:solid #0000b5 3px"></div>

            <div class="container my-2" style="border:solid orangered 3px;height:310px;border-radius:34px;">
              <div class="container">
                <h4 class="mt-2">Supported formats of files</h4>
                <h6>1).pdf(Pdf Document)</h6>
                <h6>2).zip(Compressed folder)</h6>
                <h6>3).jpg(images)</h6>
                <h6 class="mt-3">How to Upload files ?</h6>
                <p>Make a folder of your all Files<br>compressed it by using Winrar <br>Upload it !</p>
                <p class="text-right"><a href="fileUpload.php?hackathonI=<?php echo $hackathon_id;?>&&hackathonN=<?php echo $teamName;?>"
                    class="btn btn-outline-primary" id="uploadBtn">Upload-></a>
                </p>
              </div>
            </div>

        </div>



        <!-- announcements -->
        <div class="container col-6">
            <div class="jumbotron bg-dark jumbotron-fluid m-4" style="color:white;height:678px">

                <h3 class="text-center" style="margin-top: -58px;">Announcements/Query</h3>

                <div class="container find mt-3 text-left" id="announcement">
                </div>

            </div>

            <form id="messageform" method="POST">
                <div class="form-row">
                    <div class="col-lg-10 ml-4">
                        <input type="text" class="form-control" placeholder="message.." name="message"
                            id="inputMessage">
                        <input type="hidden" name="hackathonName" value="<?php echo $hackathon_name?>"
                            id="hackathonName">
                        <input type="hidden" name="studentTeam" value=<?php echo $teamName;?> id="studentTeam">
                    </div>

                    <button type="submit" class="btn btn-outline-success" id="send">Send</button>

                </div>
            </form>

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
    <script src="announcement.js"></script>
    <script src="studentQuery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>

</html>