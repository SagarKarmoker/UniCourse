<?php
include 'dbconfig.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // generating uid
    $std = 'std@';
    $id = rand(10000000, 99999999);
    // echo $std.$id;
    $uid = $std . $id;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $profession = $_POST['profession'];
    $address = $_POST['address'];
    // $dor = CURRENT_TIMESTAMP();
    $role = "student";

    if (isset($fname, $lname, $email, $password, $profession, $address) and $password == $con_password) {
        $auth = "select * from userdetails where email='$email'";
        $result = $conn->query($auth);

        if ($result->num_rows > 0) {
            // email exists, show error message
            echo "Email already exists!";
        } else {
            // email doesn't exist, proceed with storing the user details
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hash the password using the default algorithm
            // store the hashed password in the database
            $sql = "insert into userdetails (Uid, Fname, Lname, Email, Password, Profession, Address, Role, lock_status) values ('$uid','$fname','$lname', '$email', '$hashed_password', '$profession', '$address', '$role', 'Unlocked')";
            if ($conn->query($sql)) {
                // echo "User registered successfully!";
                $_SESSION['loggedin'] = true;

                // generate the code
                $veri_code = rand(100000, 999999);
                $hashed_veri_code = password_hash($veri_code, PASSWORD_DEFAULT);

                $veri_sql = "insert into reg_verify (email, code, status) values ('$email', '$hashed_veri_code', '$veri_code')"; //Unverified
                $conn->query($veri_sql);

                // send verify mail
                $to = $email;
                $subject = 'Verify Your Email Address';
                $message = "Please click the following link to verify your email address:\n\n";
                $message .= "https://unicourse.helloworlddev.software/verify.php?email=$email&code=$veri_code";
                $headers = "From: admin@unicourse.helloworlddev.software";

                mail($to, $subject, $message, $headers);

                // echo "A verification email has been sent to $email.";

                header("Location: verify.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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
?>
