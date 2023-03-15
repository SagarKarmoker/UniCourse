<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost:4306";
    $username = "root";
    $password = "";
    $dbname = "cse347_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = $_POST['user'];
    $password = $_POST['password'];

    if (isset($email, $password)) {
        $stored_hashed_password = "select pass from admindb where email='$email' OR adminID = '$email'";
        $result = $conn->query($stored_hashed_password);

        // if ($result->num_rows == 1 && password_verify($password, $result->fetch_assoc()['pass'])) {
        if ($result->num_rows == 1 && $password == $result->fetch_assoc()['pass']) {
            // Redirect to the protected page
            // generate the code
            $veri_code = rand(100000, 999999);
            $hashed_veri_code = password_hash($veri_code, PASSWORD_DEFAULT);

            $user = "select adminID, email from admindb where email='$email' OR adminID = '$email'";
            $ch_result = $conn->query($user);
            $id = $ch_result->fetch_assoc()['adminID'];
            $ip_address = $_SERVER['REMOTE_ADDR'];

            $veri_sql = "insert into verifyadmin (adminID, smscode, verified, loggedip) values ('$id', '$hashed_veri_code', '0', '$ip_address')"; //Unverified
            $conn->query($veri_sql);

            // send verify mail
            $to = $ch_result->fetch_assoc()['email'];
            $subject = 'Verify Your Admin Email Address';
            $message = "Here is your one time verification code to verify your email address:\n\n";
            $message .= "Your email: $to \n\n
                        Code: $veri_code";
            $headers = "From: verify@unicourse.com";

            mail($to, $subject, $message, $headers);

            header("Location: ../adminPanel/code.php?id=" . urlencode($id));
            exit();
        } else {
            // Redirect to the login page with an error message
            header("Location: ../adminPanel/admin.html");
            exit();
        }
    } else {
        // Redirect to the login page with an error message
        header("Location: ../adminPanel/admin.html");
        exit();
    }
} else {
    // Redirect to the login page if accessed directly
    header("Location: index.html");
    exit();
}

$conn->close();
?>
