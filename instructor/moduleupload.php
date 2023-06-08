<?php
require 'bunny-stream.php';
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modNum = $_POST['modNum'];

    $modName = 'module_name';
    $modCode = 'module_code';
    // $uid = '';
    $cid = $_POST['cid'];
    $ch = "select * from modules_details where cid='$cid'";
    $res = $conn->query($ch);
    
    if($res->num_rows > 0){
        $response = ['status' => 'success', 'message' => 'Module already exists'];
    }
    else{
    // Create an empty array to hold the module data
    $data = [];

    // Create 2 variable pairs dynamically using a for loop
    for ($i = 0; $i <= $modNum; $i++) {
        // Append the current loop index to the base names
        $modName .= $i;
        $modCode .= $i;
        $modDesc .= $i;

        // Create the variables dynamically
        $$modName = $_POST['module_name' . $i];
        $$modCode = $_POST['module_code' . $i];
        $$modDesc = $_POST['module_desc' . $i];

        //bunny start
        $bstream = new BunnyCDNStream("118150", "f0c47b98-d2ab-4b37-a09b0c94e3e9-816c-4196");
        $title = $$modName;
        $response = $bstream->createVideo($title, $collectionId = null);
        $jsonString = json_encode($response);
        $videoData = json_decode($jsonString, true);
        $videoId = $videoData['guid'];
        $videoFile = $_FILES['module'.$i.'_file']['tmp_name'];

        // Upload the video file using BunnyCDN API
        echo json_encode($bstream -> uploadVideoWithVideoId($videoId, $videoFile));
        //bunny end

        // Create an associative array for the current pair
        $pair = [
             "module_name{$i}" => $$modName,
    	     "module_code{$i}" => $$modCode,
             "module_desc{$i}" => $$modDesc,
    	     "guid{$i}" => $videoId
        ];

        // Add the pair array to the data array
        array_push($data, $pair);

        // Reset the base names for the next iteration
        $modName = 'module_name';
        $modCode = 'module_code';
        $modDesc = 'module_desc';
    }

    // Convert the data array to a JSON string
    $jsonData = json_encode($data);

    // $mid = uniqid();

    // Insert the JSON string into the "module_data" column of the "modules" table
    $query = "INSERT INTO modules_details (cid, module_data) VALUES ('$cid','$jsonData')";

    // Execute the query
    if ($conn->query($query) === true) {
        // If the query was successful, send a JSON response indicating success
        $response = ['status' => 'success', 'message' => 'Module uploaded successfully'];
    } else {
        // If the query failed, send a JSON response indicating failure and the error message
        $response = ['status' => 'error', 'message' => $conn->error];
    }

    // Send the JSON response with the appropriate content type header
    header('Content-Type: application/json');
}
echo json_encode($response);
}
else{
    header("Location: instructor/dash.php");
}
?>