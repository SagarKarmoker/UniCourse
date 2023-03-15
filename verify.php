<?php
// Connect to the database
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "cse347_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Retrieve the user's email address and verification code from the URL parameters
$email = $_GET['email'];
$veri_code = $_GET['code'];

// Retrieve the hashed verification code from the database for this email address
$query = "SELECT code FROM reg_verify WHERE email = ?";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$hashed_veri_code = $row['code'];

// Compare the verification code from the URL parameter to the hashed verification code from the database
if (password_verify($veri_code, $hashed_veri_code)) {
    // Update the user's account status to "verified"
    $query = "UPDATE reg_verify SET status = 'Verified' WHERE email = ?";
    mysqli_query($conn, $query);

    header("Location: verified.html");
    exit();
} else {
    header("Location: invalid.html");
    exit();
}

$conn->close();
?>
