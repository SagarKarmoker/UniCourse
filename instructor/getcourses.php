<?php
include 'dbconfig.php';
session_start();
if(isset($_SESSION['instruct'])){
    //echo 'Welcome, '.$_SESSION['instruct'].'!';

$inst = $_SESSION['instruct'];
$insid = $inst;

$sql = "SELECT cid, from courses_details where instructor_id = '$insid'";
$result = $conn->query($sql);
$row = $result->fetch_all();

print_r ($row);
} else {
    header("Location: login.html");
    exit();
}
?>