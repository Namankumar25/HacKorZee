<?php

include "dbconnect.php";

session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$attend_username=$_SESSION['usernamesignup'];
$disable;

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
<?php
if (isset($_GET['delete'])) {
    if ($_GET['delete']) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            You are now unenrolled from the Hackathon !
          <strong></strong> 
        </div>
        ';
    }
    else {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            Something went wrong ! Try again Later !
          <strong></strong> 
        </div>
        ';
    }
}
?>
    <div class="container my-4 text-center">
        <div class="jumbotron bg-dark" style="color:white;">
            <h1 class="display">Welcome, <?php echo $_SESSION['usernamesignup'];?></h1>
            <p class="lead">Thanks ! <?php echo $_SESSION['usernamesignup'];?> for connecting with Us , Experience a new
                platfrom of hackathon</p>
            <hr class="my-4" style="background-color:white;">

            <a class="btn btn-outline-primary" href="organize.php" role="button">Organize a hackathon</a>
            <a class="btn btn-outline-warning" href="logout.php" role="button">Log Out</a>
            <a class="btn btn-outline-success" href="startup.php" role="button">My Organized Hackathons</a>
        </div>
    </div>


    <h1 class="container">Upcoming Hackathons</h1>


    <div class="container my-4 over">

        <div class="row">
<?php
$sql="SELECT * FROM `hackathons_thread`";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
 
if($row['Hack_admin']!=$attend_username){
  echo '<div class="col-md-3 my-2 mx-2">
                <div class="card bg-success"
                    style="background:linear-gradient(black,#330933); width: 18rem;color:white;">
                    <img src="https://source.unsplash.com/500x300/?code,random" class="card-img-top" alt="...">
                    <div class="card-body" style="color:white;">
                        <h5 class="card-title">'.$row['Hack_name'].'</h5>
                        <p class="card-text">'.substr($row['Hack_desc'],0,30).'......</p>
                        <p class="card-text"><a href="'.$row['Additional_link'].'" target="blank">'.$row['Additional_link'].'</a></p>
                        <p class="card-text">Organized by : '.substr($row['organized_by'],0,10).'..</p>
                        <small id="emailHelp" class="form-text text-muted">starting date : '.$row['start_date'].'</small>
                        <small id="emailHelp" class="form-text text-muted">ending date : '.$row['end_date'].'</small>
                        <small id="emailHelp" class="form-text text-muted" style="float:right;">Post :- '.$row['time'].'
                            date</small><br>
                        <small><a href="hackathon_detail.php?hackathon='.$row['Hack_id'].'" class="btn btn-outline-primary"
                                style="float:right;">See Details</a></small>
                    </div>
                </div>
            </div>';

}
else {
    continue;
}


}           
?>

        </div>
    </div>

    <h1 class="container">My Hackathons</h1>
    <div class="container over">
        <div class="row">
        <?php

$asql="SELECT `hackathon_name`,`attend_Hack_id` FROM `attendhackathon` WHERE `attend_user_name`='$attend_username'";
$aresult=mysqli_query($conn,$asql);

while($row=mysqli_fetch_assoc($aresult)){

$hackathonid=$row['attend_Hack_id'];
   $hsql="SELECT `end_date`,`start_date`,`organized_by` FROM `hackathons_thread` WHERE `Hack_id`='$hackathonid'"; 
   $hresult=mysqli_query($conn,$hsql);
    $hrow=mysqli_fetch_assoc($hresult);
    $today=date("Y-m-d");
    if($today==$hrow['start_date']){
        $disable="";
    }
    else {
        $disable="disabled";
        $showAlert="true";
    }
 echo '<div class="col-md-3 my-2 mx-2">
 <div class="card bg-success" style="background:linear-gradient(black,#330933); width: 18rem;color:white;">
     <img src="https://source.unsplash.com/500x300/?code,javascript" class="card-img-top" alt="...">
     <div class="card-body" style="color:white;">
         <h5 class="card-title">'.$row['hackathon_name'].'</h5>
         <h5 class="card-title">'.$hrow['organized_by'].'</h5>
         <small id="emailHelp" class="form-text text-muted">starting date :'.$hrow['start_date'].'</small>
         <small id="emailHelp" class="form-text text-muted">ending date : '.$hrow['end_date'].'</small>
         <br>
           <small><a href="startHackathon.php?hackathonI='.$hackathonid.'&&hackathonN='.$row['hackathon_name'].'" class="btn btn-outline-success '.$disable.'"
                 style="float:right;">Start</a></small>
            
           <small><a href="unenroll.php?hackathon='.$hackathonid.'" type="button" class="btn btn-outline-danger"
                 style="float:left;">UnEnroll</a></small>
     </div>
 </div>
</div>
';

}           
?>

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