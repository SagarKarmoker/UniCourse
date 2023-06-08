<?php
header('Content-Type: application/json');
include 'dbconfig.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$cid = 'course' . rand(10000,99999);
// Retrieve the form data
$course_name = $_POST['course_name'];
$course_code = $_POST['course_code'];
$description = $_POST['description'];
$whatlearn1 = $_POST['whatlearn1'];
$whatlearn2 = $_POST['whatlearn2'];
$whatlearn3 = $_POST['whatlearn3'];
$whatlearn4 = $_POST['whatlearn4'];
$whatlearn5 = $_POST['whatlearn5'];
$img1 = $_FILES['thumbnail']['tmp_name'];
$thumbnail = addslashes(file_get_contents($img1));
$about = $_POST['about'];
$tags1 = $_POST['tags1'];
$tags2 = $_POST['tags2'];
$tags3 = $_POST['tags3'];
$tags4 = $_POST['tags4'];
$tags5 = $_POST['tags5'];
$instructor_name = $_POST['instructor_name']; // Assuming you've already started a session
$instructor_id = $_POST['instructor_id']; // Assuming you've already started a session
$img2 = $_FILES['instructor_img']['tmp_name'];
$instructor_img = addslashes(file_get_contents($img2));
$price = $_POST['price'];
$duration = $_POST['duration'];
$module = $_POST['module'];
$course_level = $_POST['course_level'];

    //if (isset($cid, $course_name, $course_code, $description, $whatlearn, $thumbnail, $about, $tags, $instructor_name, $instructor_id, $instructor_img, $price, $duration, $module, $course_level)) {
	if (isset($_POST['action']) && $_POST['action'] == 'add_course'){
        $sql = "INSERT INTO courses_details (cid, course_name, course_code, description, whatlearn, thumbnail, about, tags, instructor_name, instructor_id, instructor_img, price, duration, module, course_level) 
        VALUES ('$cid', '$course_name','$course_code', '$description', '" . json_encode(array(
            'whatlearn1' => $whatlearn1,
            'whatlearn2' => $whatlearn2,
            'whatlearn3' => $whatlearn3,
            'whatlearn4' => $whatlearn4,
            'whatlearn5' => $whatlearn5
        )) . "','$thumbnail', '$about', '" . json_encode(array(
            'tags1' => $tags1,
            'tags2' => $tags2,
            'tags3' => $tags3,
            'tags4' => $tags4,
            'tags5' => $tags5
        )) . "', 'UniCourse Dev', 'inst111', '$instructor_img', '$price', '$duration', '$module', '$course_level')";
            // update instructor id and name 
        $result = $conn->query($sql);

        if ($result === TRUE && $conn->affected_rows > 0) {
            echo json_encode(array('success' => true, 'message' => $cid));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to insert course data into the database.'));
        }
        
        // close the database connection
        $conn->close();
    }
else {
    // return a JSON response indicating invalid request
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}
}
?>