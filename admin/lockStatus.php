<?php
include 'dbconfig.php';

// write sql for checking lock status and return the output
// use $conn for connection

$id = $_GET['id']; 
$st = $_GET['st']; 

// $sql = "select lock_status from userdetails where Uid = '$id'";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();

if($st == 'lock'){
    $sql = "UPDATE userdetails SET lock_status = 'Locked' WHERE Uid = '$id'";
    $result = $conn->query($sql);
}
else if($st == 'unlock'){
    $sql = "UPDATE userdetails SET lock_status = 'Unlocked' WHERE Uid = '$id'";
    $result = $conn->query($sql);
}

// if($row['lock_status'] == 'locked'){
//    $output = 'Blocked';
// }
// else{
//     $output = 'Unblocked';
// }

// echo $output;

$conn->close();

?>