<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'hackerz');

if(isset($_GET['hackathonI'])){
    $hackathon_id=$_GET['hackathonI'];
    $hackteamName=$_GET['hackathonN'];
    $asql="SELECT `hackathon_name`,`attend_Hack_id` FROM `attendhackathon` WHERE `attend_Hack_id`='$hackathon_id'";
    $aresult=mysqli_query($conn,$asql);
    $row=mysqli_fetch_assoc($aresult);
    $name_of_hackathon=$row['hackathon_name'];
    $Hack_id=$row['attend_Hack_id'];
}

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { 
    $filename = $_FILES['myfile']['name'];

    $destination = 'uploads/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx','png','rar'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000000) { 
        echo "File too large!";
    } else {
        
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `files` (`id`, `name`, `size`, `downloads`, `Hackathon_id`, `Team_Name`) VALUES (NULL, '$filename', '$size', '0', '$hackathon_id', '$hackteamName');";
            if (mysqli_query($conn, $sql)) {
            header("location:startHackathon.php?hackathonI=".$hackathon_id."&&hackathonN=".$name_of_hackathon."&&check=true");
            }
        } else {
            header("location:startHackathon.php?hackathonI=".$hackathon_id."&&hackathonN=".$name_of_hackathon."&&check=false");
        }
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}