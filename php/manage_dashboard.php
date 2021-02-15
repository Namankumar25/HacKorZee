<?php

include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}

if(isset($_GET['hackathonN'])&&isset($_GET['H']))
{
  $hackathon_name=$_GET['hackathonN'];  
  $hackathon_id=$_GET['H'];  
}

$organizer_username=$_SESSION['usernamesignup'];
$sql="SELECT `Hack_admin`,`Hack_name` FROM `hackathons_thread` WHERE `Hack_id`='$hackathon_id' AND `Hack_name`='$hackathon_name'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

if($result && $row['Hack_admin']==$organizer_username){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    Hello Organizer !
    <strong>This is your monitoring Workspace of Hackathon </strong> 
    </div>';
}
else{
    echo "You are accessing anothers property go back";
    header("location:startup.php");
}




?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <title>Dashboard</title>
    <style>
    .find {
        overflow-y: auto;
        height: 350px;
    }
    </style>

</head>

<body>
<h4 class="text-left m-2"><a href="startup.php" class="btn btn-danger">Go Back</a></h4>
    <div class="container my-3">
        <h1 class="text-center">Welcome Organizer : <?php echo $organizer_username;?></h1>
        <h4 class="text-center"><?php echo $hackathon_name;?></h4>
        <h4 class="text-center"><button type="button" class="btn btn-outline-success" id="Refresh">Refresh</button></h4>
        
    </div>

    <div class="container my-4">
        <div class="row">
        
        <?php
        $dsql="SELECT `id` FROM `files` WHERE `Hackathon_id`=$hackathon_id";
        $dresult=mysqli_query($conn,$dsql);
        $drows=mysqli_num_rows($dresult);
        if($dresult){

         echo '<div class="card col-6" style="background-color: white;" id="submission">
                <div class="card-header">Submission</div>            
                <div class="card-body bg-success">
                    <h5 class="card-title" style="color:white;font-size:45px;">'.$drows.'</h5>
                    <p class="card-text"><a class="btn btn-primary" href="downloads.php?hackI='.$hackathon_id.'">View Submissions</a></p>
                </div>
            </div>';
        }
        
        ?>    
    
            <?php

            $totalmembersql="SELECT `student_status` FROM `organizerdashboard` WHERE `Hackathon_id`=$hackathon_id AND `Hackathon_name`='$hackathon_name'";
            $totalresult=mysqli_query($conn,$totalmembersql);
            $totalrow=mysqli_num_rows($totalresult);
            
            $onlinemembersql="SELECT `student_status` FROM `organizerdashboard` WHERE `Hackathon_id`=$hackathon_id AND `Hackathon_name`='$hackathon_name' AND `student_status`='online'";
            $onlineresult=mysqli_query($conn,$onlinemembersql);
            $onlinerow=mysqli_num_rows($onlineresult);
            
            if($onlineresult){
            echo '
            <div class="card col-6" style="background-color: white;" id="update">
                <div class="card-header">Members Online</div>
                <div class="card-body bg-danger">
                    <h5 class="card-title" style="color:white;font-size:45px;">'.$onlinerow.'/'.$totalrow.'</h5>
                    <p class="card-text"></p>
                </div>
            </div>';
            }
            else{
                echo "some problem";
            }
    ?>

        </div>


    </div>


    <!-- organizer Announcements -->
    <div class="container mt-2">
        <h1>Announcement for Teams</h1>

        <div class="container">
            <div class="jumbotron bg-dark jumbotron-fluid" style="color:white;">

                <div class="container find" id="recievemessages">


                </div>

            </div>

        </div>
        
        <div class="container">
            <form id="messageform" method="POST">
                <div class="form-row">
                    <div class="col-lg">
                        <input type="text" class="form-control" placeholder="message.." style="margin:auto;"
                            name="message" id="inputmessage">
                        <input type="hidden" name="hackathonName" value="<?php echo $hackathon_name?>" id="hackathonName">
                     

                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-outline-success" id="send">Send</button>
                    </div>
                </div>
            </form>
        </div>

    </div>





    <!-- Teams progress     -->
    <div class="container my-4">
        <h1>Teams</h1>

        <table class="table table-dark" id="table_id" style="color:black">

            <thead>
                <tr style="color:white">
                    <th scope="col">Sno.</th>
                    <th scope="col">Team Name</th>
                    <th scope="col">Student name</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody  id="tableData">
<?php     


$i=0;

$fetchsql="SELECT `team_Name`,`student_Name`,`student_email`,`student_status` FROM `organizerdashboard` WHERE `Hackathon_id`=$hackathon_id";
$fetchresult=mysqli_query($conn,$fetchsql);
if($fetchresult){


while($row=mysqli_fetch_assoc($fetchresult)){
    echo '
        <tr>
            <th scope="row">'.++$i.'</th>
            <td>'.$row['team_Name'].'</td>
            <td>'.$row['student_Name'].'</td>
            <td>'.$row['student_email'].'</td>
            <td>'.$row['student_status'].'</td>
        </tr>
        ';
        }
    }

?>
         
        
        </tbody>
    </table>

    
    
    
</div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
    
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js">
    </script>

    
    <script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    </script>

    <script src="sendmessage.js"></script>
    <script src="recievemessage.js"></script>
    <script src="updateall.js"></script>
 

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>