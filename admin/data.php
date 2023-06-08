<?php
// Connect to database and retrieve data

include 'dbconfig.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the cid parameter from GET request
$cid = $_GET['cid'];

$sql = "SELECT module FROM courses_details WHERE cid = '$cid'";
$result = $conn->query($sql);

// Return data as JSON
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);

$conn->close();
?>