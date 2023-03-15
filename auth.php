<?php
// connect to the database
$servername = "localhost:4306";
$username = "root";
$password = "";
$dbname = "cse347_project";

$conn = new mysqli($servername, $username, $password, $dbname);

$email = $_POST['email'];

$sql = "select * from userdetails where email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // email exists, show error message
    echo "Email already exists!";
} else {
    // email doesn't exist, proceed with storing the user details
    // ...
}


// if(isset($fname, $lname, $email, $password, $profession, $address) and $password == $con_password){
//     $password = $_POST['password']; // get the password from the user input
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hash the password using the default algorithm
//     // store the hashed password in the database
// }
// else{
//     echo "error";
// }


// close the statement and connection
$conn->close();
?>
