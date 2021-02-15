<?php 
include "dbconnect.php";
session_start();
if ($_SESSION['signedup']!=true&&!isset($_SESSION['passwordsignup'])&&!isset($_SESSION['usernamesignup'])) {
    header("location:index.php");
}
$organizer=$_SESSION['usernamesignup'];
include 'filesLogic.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Download files</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

    <title>Dashboard</title>
</head>

<body style="background: linear-gradient(to right, #4882e0, #ff5a5a);color: white;">
    <div class="container my-4">
    <h1>File submissions</h1>
        <table id="table_id" class="table table-dark my-2" style="color:black">
            <thead style="color:white">
                <th>ID</th>
                <th>Filename</th>
                <th>size (in mb)</th>
                <th>Team name</th>
                <th>Downloads</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
            if(isset($_GET['hackI'])){
                $hack_Id=$_GET['hackI'];
                $hack_sql="SELECT `Hack_admin`,`Hack_name` FROM `hackathons_thread` WHERE `Hack_id`='$hack_Id'";
                $hack_result=mysqli_query($conn,$hack_sql);
                $hack_row=mysqli_fetch_assoc($hack_result);
                $HACK_admin=$hack_row['Hack_admin'];
                $HACK_name=$hack_row['Hack_name'];
                if ($HACK_admin==$organizer) {
                    $fetchDownloads="SELECT * FROM `files` WHERE `Hackathon_id`='$hack_Id'";
                    $fetchresult=mysqli_query($conn,$fetchDownloads);
                    while ($fetchrow=mysqli_fetch_assoc($fetchresult)) {
                    echo '
                    <tr>
                            <td>'.$fetchrow['id'].'</td>
                            <td>'.$fetchrow['name'].'</td>
                            <td> '.floor($fetchrow['size'] / 1000).'KB</td>
                            <td>'.$fetchrow['Team_Name'].'</td>
                            <td>'.$fetchrow['downloads'].'</td>
                            <td><a href="downloads.php?file_id='.$fetchrow['id'].'&&hackI='.$fetchrow['Hackathon_id'].'">Download</a></td>
                    </tr>';
                    }
                }
            
            }
            ?>

            </tbody>
        </table>
    </div>
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
</body>

</html>