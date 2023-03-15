<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // connect to the database
    $servername = "localhost:4306";
    $username = "root";
    $password = "";
    $dbname = "cse347_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($email, $password)) {
        $stored_hashed_password = "select Password from userdetails where email='$email'";
        $result = $conn->query($stored_hashed_password);

        if ($result->num_rows == 1 && password_verify($password, $result->fetch_assoc()['Password'])) {
            // password is correct, log in the user and redirect to the new page
            $_SESSION['loggedin'] = true;
            // adding login info to serverlog
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $slog = "insert into server_log (email, ip_address) values ('$email', '$ip_address')";
            $conn->query($slog);
            header("Location: index.html");
            exit();
        } else {
            // password is incorrect, show an error message
            // echo "Error: Incorrect email or password.";
            header("Location: login.html");
            exit();
        }
    } else {
        echo "Error: Please fill in all the required fields.";
    }

    // close the statement and connection
    $conn->close();
}
else{
    header("Location: login.html");
    exit();
}
?>


<!-- 
    // to verify
    $password = $_POST['password']; // get the password from the user input
    $stored_hashed_password = // retrieve the hashed password from the database

    if (password_verify($password, $stored_hashed_password)) {
    // password is correct, log in the user
    } else {
    // password is incorrect, show an error message
    }

 -->