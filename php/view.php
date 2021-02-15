<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
    exit();
}

$organizer_username=$_SESSION['usernamesignup'];
$disableTrue="false";
$checkstage1="true";
$checkstage2="true";
$checkstage3="true";


if($_SERVER['REQUEST_METHOD']=="POST"){

    if(isset($_GET['hackathonN'])&&isset($_GET['H'])){
        $hid=$_GET['H'];
        $hname=$_GET['hackathonN'];
        }
        
        $studentName=$_POST['studentName'];
        $studentTeamName=$_POST['TeamName'];
        $studentEmail=$_POST['studentEmail'];


if(strlen($studentTeamName)==0){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    Warning !
    <strong>Team Name should not be Empty</strong> 
</div>';
$checkstage1="false";
}        

else {
$asql="SELECT `Hackathon_id` FROM `organizerdashboard` WHERE `student_email`='$studentEmail' AND `Hackathon_id`='$hid'";
$aresult=mysqli_query($conn,$asql);
$arow=mysqli_num_rows($aresult);

if($arow>0){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    Warning !
    <strong>Member Already present in the team</strong> 
</div>';
$checkstage2="false";
}


}




if($checkstage1=="true" && $checkstage2=="true"&& $checkstage3=="true"){

$osql="INSERT INTO `organizerdashboard` (`sno.`, `team_Name`, `student_Name`, `Hackathon_id`, `Hackathon_name`, `student_email`, `student_status`, `time`) VALUES (NULL, '$studentTeamName', '$studentName', '$hid', '$hname', '$studentEmail', 'offline', current_timestamp());";
$oresult=mysqli_query($conn,$osql);

if($oresult){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    Team Assigned !
    <strong></strong> 
    </div>';
    }
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
    .over {
        overflow-y: auto;
        height: 500px;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

</head>

<body style="height:100%; background: linear-gradient(to right, #c94d52, #560096);">
    <div class="container my-5">
        <h1 style="color:white;"><u>Enrolled Students</u></h1>
        <a class="btn btn-outline-primary mb-5" href="startup.php">Go Back</a>
        <table class="table table-dark" id="table_id" style="color:black">

            <thead>
                <tr style="color:white">
                    <th scope="col">Sno.</th>
                    <th scope="col">Enrollment id</th>
                    <th scope="col">Student name</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col">Assign a Team</th>
                </tr>
            </thead>
            <tbody>
                <?php     
if(isset($_GET['hackathonN'])&&isset($_GET['H'])){

// $hidsql="SELECT `Hack_id` FROM `hackathons_thread` WHERE `Hack_admin`='$organizer_username' AND `Hack`";
// $hidresult=mysqli_query($conn,$hidsql);
// $hidrow=mysqli_fetch_assoc($hidresult);
$hid=$_GET['H'];
$hname=$_GET['hackathonN'];

$sql="SELECT `Sno.`,`attend_user_name`,`attend_user_email`,`user_type`,`user_status`,`time` FROM `attendhackathon` WHERE `attend_Hack_id`='$hid' AND `hackathon_name`='$hname' AND `organizer`='$organizer_username'";
$result=mysqli_query($conn,$sql);

}

$i=0;

if($result){
while($row=mysqli_fetch_assoc($result)){

    $attendusername=$row['attend_user_name'];
    $usql="SELECT `name` FROM `signupusers` WHERE `user_name`='$attendusername'";
    $uresult=mysqli_query($conn,$usql);
    if ($uresult) {
        $urow=mysqli_fetch_assoc($uresult);
        $nameofstudent=$urow['name'];
    
    echo '
        <tr style="background-color:black;color:white">
            <th scope="row">'.++$i.'</th>
            <td>'.$row['Sno.'].'</td>
            <td>'.$nameofstudent.'</td>
            <td>'.$row['attend_user_email'].'</td>
            <td>'.$row['user_type'].'</td>
            <td>'.$row['user_status'].'</td>
            <td>'.$row['time'].'</td>
            <td>
            <button class="btn btn-outline-danger edit" style="margin-left:27px;">Assign</button></td>
        </tr>
        ';

        }
    }
}
else{
    echo "not";
}
?>
            </tbody>
        </table>

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
     
    <script src="assign.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    </script>

 <!-- assign a team to a student -->

    <div class="modal fade" id="assignmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <!-- background: linear-gradient(45deg, #2fe0d0, #1324a0); -->
        <!-- background: linear-gradient(45deg, #1a1212, #1324a0); -->
        <div class="modal-dialog">
            <div class="modal-content text-left" style="color:white;background: linear-gradient(45deg, #04756b, #0d196d);">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign a Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="form-group">
                            <label for="TeamName" class="text-left">Team Name</label>
                            <input type="text" class="form-control" id="TeamName" aria-describedby="emailHelp"
                                name="TeamName">
        
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Student Name</label>
                            <input type="text" class="form-control" name="studentName" id="Edittitle">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Student Email</label>
                            <input type="text" class="form-control" name="studentEmail" id="editEmail">
                        </div>

                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            
                            <button type="submit" class="btn btn-success">Assign</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</body>

</html>