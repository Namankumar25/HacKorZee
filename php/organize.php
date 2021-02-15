<?php

session_start();

if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
    exit();
}

$alertinsert=false;
$alertnotinsert=false;


include "dbconnect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
   $hackathon_admin=$_SESSION['usernamesignup']; 
  $Hackathon_name=$_POST['hackathonName'];
  $Hackathon_desc=$_POST['hackathonDesc'];
  $start_date=$_POST['startDate'];
  $end_date=$_POST['endDate'];
  $organized_By=$_POST['organizedBy'];
  $Add_info=$_POST['Addinfo'];
  $security_Code=$_POST['securityCode'];

  $code_hash=password_hash($security_Code,PASSWORD_DEFAULT);

  $sql="INSERT INTO `hackathons_thread` (`Hack_id`, `Hack_name`, `Hack_desc`, `start_date`, `end_date`, `time`, `organized_by`, `Hack_admin`, `Additional_link`, `security_code`) VALUES (NULL, '$Hackathon_name', '$Hackathon_desc', '$start_date', '$end_date', current_timestamp(), '$organized_By', '$hackathon_admin', '$Add_info', '$code_hash')";
  $result=mysqli_query($conn,$sql);


  if($result){
    $alertinsert=true;
  }
  else{
    $alertnotinsert=true;
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

</head>

<body style="background-color: black;color:white;">

    <?php
if($alertinsert){
 
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>

    </button>
    Your Hackathon is created do not forget to manage it !
    <strong></strong> 
  </div>
  ';
}

if($alertnotinsert){
 echo '<div class="alert alert-danger alert fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  Hackathon name Exists ! Try a different one
  <strong></strong> 
</div>
';
}

?>
    <div class="container my-4">
        <div class="jumbotron bg-dark" style="color:white;">
            <h1 class="display">Create your Hackathon</h1>
            <a class="btn btn-outline-danger" href="welcomeuser.php" role="button">Back</a>
            <hr class="my-2" style="background-color:white;">
            <form action="organize.php" method="POST">

                <div class="form-group">
                    <label for="" class="text-left">Hackathon Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="hackathonName" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-left">Hackathon Description</label>
                    <textarea type="text" class="form-control" id="hackathonDesc" aria-describedby="emailHelp"
                        name="hackathonDesc" required>
                </textarea>
                </div>

                <div class="form-group">
                    <label for="" class="text-left">Start Date</label>
                    <input type="date" class="form-control" id="startDate" aria-describedby="emailHelp"
                        name="startDate" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-left">End date</label>
                    <input type="date" class="form-control" id="endDate" aria-describedby="emailHelp" name="endDate"
                        required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Organized by</label>
                    <input type="text" class="form-control" id="organizedBy" name="organizedBy" required>

                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Addtional link</label>
                    <input type="text" class="form-control" id="Addinfo" name="Addinfo" optional>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Security Code</label>
                    <input class="form-control" id="SecurityCode" name="securityCode" value="" required>
                </div>
                <h5 class="form-text" style="color:white;">Copy this code for future Reference (Recommended)</h5>
                <h5 class="form-text" style="color:white;">Other wise No one will be able to participate in your Hackathon</h5>
                <small id="emailHelp" class="form-text text-muted">Question: Why this Security Code ?</small>
                <small id="emailHelp" class="form-text text-muted">Ans : Only those students who have this Security code are able to participate in your Hackathon</small>


                <div class="form-group">
                    <a type="buttton" class="btn btn-outline-success mt-3" id="generate">Generate Another Code</a>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Create</button>
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
    <script src="code.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>