<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // connect to the database
    $servername = "localhost";
    $username = "id20422756_sagar";
    $password = "E1L@KQ5jY[6@C22#";
    $dbname = "id20422756_project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = $_POST['email'];

    if (isset($email)) {
        $auth = "select * from reg_verify where email='$email'";
        $result = $conn->query($auth);

        if ($result->num_rows > 0 and $result->fetch_assoc()['status'] == 'Unverified') {
            // generate the code
            $veri_code = rand(100000, 999999);
            $hashed_veri_code = password_hash($veri_code, PASSWORD_DEFAULT);

            $veri_sql = "update reg_verify set code='$hashed_veri_code' where email = '$email'";
            $conn->query($veri_sql);

            // send verify mail
            $to = $email;
            $subject = 'Verify Your Email Address';
            $message = "Please click the following link to verify your email address:\n\n";
            $message .= "https://unicoursedev.000webhostapp.com/verify.php?email=$email&code=$veri_code";
            $headers = "From: sagar@unicourse.com";

            mail($to, $subject, $message, $headers);

            // echo "A verification email has been sent to $email.";

            header("Location: verify.html");
            exit();
        } else {
            // email not found
            header("Location: signup.html");
            exit();
        }
    } else {
        echo "Error: Please fill in all the required fields.";
    }

    // close the statement and connection
    $conn->close();
}
else{
    header("Location: signup.html");
    exit();
}
$conn->close();
?>