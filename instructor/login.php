<?php
include 'dbconfig.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    // echo $email . $password;
    // var_dump($_POST);

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $stored_hashed_password_query = "SELECT instructor_id, pass FROM instructors WHERE email='$email'";
        $result = $conn->query($stored_hashed_password_query);
    
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stored_hashed_password = $row['pass'];
            
            if (password_verify($password, $stored_hashed_password)) {
                $id = $row['instructor_id'];
                $_SESSION['instruct'] = $id;
                // echo "Matched " . $_SESSION['instruct'];
                header("Location: dash.php");
                exit();
            } else {
                echo '<script>alert("Wrong Password")</script>';
                header("Location: login.html");
                exit();
            }
        } else {
            echo '<script>alert("User Not Found.")</script>';
            header("Location: login.html");
            exit();
        }
    } else {
        echo "Error: Please fill in all the required fields.";
    }
}
else{
    // echo "Error";
    header("Location: login.html");
    exit();
}
?>