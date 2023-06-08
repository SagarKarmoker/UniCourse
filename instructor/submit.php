<?php
session_start();
include 'dbconfig.php';
$user = $_SESSION['instruct'];
$cid = $_POST["cid"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $assignmentNumber = $_POST["num"];
  $assignmentTitle = $_POST["title"];
  $assignmentDesc = $_POST["desc"];

  $ch = "select * from assign where cid = '$cid'";
  $getch = $conn->query($ch);
  
  if ($getch->num_rows > 0) {
    // Assignments already exist for this course, so append new assignment data to existing assignments
    $sql = "UPDATE assign SET assignments = CONCAT(assignments, ', {\"num\": \"$assignmentNumber\", \"title\": \"$assignmentTitle\", \"desc\": \"$assignmentDesc\"}') WHERE cid = '$cid'";
  } else {
    // No assignments exist yet for this course, so create a new row with the assignment data
    $sql = "INSERT INTO assign (cid, assignments) VALUES ('$cid', '[{\"num\": \"$assignmentNumber\", \"title\": \"$assignmentTitle\", \"desc\": \"$assignmentDesc\"}')";
  }

  $result = $conn->query($sql);
  
  // Send a JSON response back to the client
  header("Content-Type: application/json");
  $res = json_encode(["message" => "Assignment added successfully"]);
  // echo $res;
  echo 'alert("Assignment added successfully and your are redirecting to course page");';
  header("Location: dash.php");
  
  die(); // Terminate script to ensure no additional output is generated
}
?>
