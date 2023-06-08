<?php
session_start();
include 'dbconfig.php';
// var_dump($_POST);
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['privileges'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $privileges = $_POST['privileges'];

    // check admin already added or not
    $ch = "SELECT * FROM admindb WHERE email = '$email' OR adminID = '$username'";
    $ch_res = $conn->query($ch);
    if($ch_res->num_rows > 0){
        $response = ['success' => false, 'message' => 'Admin already added, please try another email or adminID'];
    } else {
        $sql = "INSERT INTO admindb (adminID, email, pass, privilege) VALUES ('$username', '$email', '$password', '$privileges')";
        $result = $conn->query($sql);

        if($result){
            $response = ['success' => true, 'message' => 'Admin Added and Please reload page.'];
        } else {
            $response = ['success' => false, 'message' => 'Error!'];
        }
    }

} else {
    $response = ['success' => false, 'message' => 'Not getting data!'];
}
header('Content-Type: application/json');
echo json_encode($response);
?>