<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $servername = "localhost:4306";
  $username = "root";
  $password = "";
  $dbname = "cse347_project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  $id = $_GET['id'];
  $veri_code = $_POST['code'];

  echo $id;

  if (isset($id)) {
    $query = "SELECT smscode, attemptNo FROM verifyadmin WHERE adminID = ? and attemptNo = ( SELECT MAX(attemptNo) as cur FROM verifyadmin WHERE adminID = ? )";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_veri_code = $row['smscode'];
        $now = $row['attemptNo'];

        // Compare the verification code from the URL parameter to the hashed verification code from the database
        // password_verify($veri_code, $hashed_veri_code
        if ($veri_code == $hashed_veri_code) {  // worked replace with previous line
            // Update the user's account status to "verified"
            $up = "UPDATE verifyadmin SET verified = 1 WHERE adminID = ? and attemptNo = '$now'";
            $stmt2 = $conn->prepare($up);
            $stmt2->bind_param("s", $id);
            $stmt2->execute();
            $stmt2->close();

            header("Location: ../verified.html");
            exit();
        } else {
            header("Location: ../invalid.html");
            exit();
        }
    } else {
        header("Location: ../invalid.html");
        exit();
    }
    $stmt->close();
} else {
    // Redirect to the login page if accessed directly
    header("Location: ../index.html");
    exit();
}
$conn->close();

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Code Verification</title>
    <!-- Load Tailwind CSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen justify-center items-center">
      <div class="w-full max-w-lg">
        <div class="bg-white shadow-md rounded px-8 py-8">
          <h1 class="text-2xl font-bold text-center mb-4">Verify Your Code</h1>
          <form class="mt-6" method="POST">
            <div class="mb-6">
              <label for="code" class="font-semibold block mb-2">Enter your code</label>
              <input
                type="text"
                name="code"
                id="code"
                class="border-2 border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your code here"
              />
            </div>
            <div class="mb-6">
                <input class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300" type="submit" value="Verify Code"> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
