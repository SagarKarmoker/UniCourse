<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($email, $password)) {
        // $stored_hashed_password = "select Uid, Password from userdetails where Email='$email'";
        // $result = $conn->query($stored_hashed_password);

        $sql = "Select * from userdetails where Email = '$email'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        // var_dump($row);

        if ($result->num_rows == 1 && password_verify($password, $row['Password'])) {
            // password is correct, log in the user and redirect to the new page
            // $_SESSION['loggedin'] = true;
            session_start();
            $_SESSION['username'] = $row['Uid'];
            // adding login info to serverlog
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $slog = "insert into server_log (email, ip_address) values ('$email', '$ip_address')";
            $conn->query($slog);
            header("Location: /student/class.php");
            exit();
        } else {
            // password is incorrect, show an error message
            // echo "Error: Incorrect email or password.";
            header("Location: invalid.html");
            exit();
        }
    } else {
        echo "Error: Please fill in all the required fields.";
    }

    // close the statement and connection
    $conn->close();
}
else{
    echo "error: Please fill in all the required fields.";
    header("Location: login.html");
    exit();
}
?>