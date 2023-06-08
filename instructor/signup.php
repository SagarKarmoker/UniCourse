<?php
include 'dbconfig.php';
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if (isset($name) && isset($email) && isset($profession) && isset($password) && isset($confirmPassword)) {
        if ($password !== $confirmPassword) {
            echo "Passwords do not match!";
            exit;
        } else {
            $auth = "select * from instructors where email='$email'";
            $result = $conn->query($auth);

            if ($result->num_rows > 0) {
                // email exists, show error message
                echo "Email already exists!";
            } else {
                $id = 'instr' . rand(1000, 9999);
                $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "insert into instructors (instructor_id, email, instructor_name, profession, pass) values ('$id', '$email', '$name', '$profession', '$hashed_pass')";
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
                    $headers = "From: admin@helloworlddev.software";

                    mail($to, $subject, $message, $headers);

                    // echo "A verification email has been sent to $email.";

                    header("Location: ../verify.html");
                    exit();
                } else {
                    // echo "Error: " . $sql . "<br>" . $conn->error;
                    header("Location: signup.php");
                    exit;
                }
            }
        }
    } else {
        header("Location: signup.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Instructor Sign Up</title>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8">

        <h1 class="text-4xl font-bold mb-8 text-center">Instructor Sign Up</h1>

        <form class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg" method="POST">

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="profession" class="block text-gray-700 font-bold mb-2">Profession and tell about yourself :</label>
                <textarea id="profession" name="profession" placeholder="Tell about yourself" class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" cols="30" rows="10"></textarea>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <label for="confirm-password" class="block text-gray-700 font-bold mb-2">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-bold rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                    Sign Up
                </button>
                <div class="mb-2 mt-4">
                    <a href="login.html">Have an account login here. <span class="text-blue-500 underline">Login</span></a>
                </div>
            </div>

        </form>

    </div>

</body>

</html>