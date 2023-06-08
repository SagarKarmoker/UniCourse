<?php
session_start();
if (isset($_SESSION['username'])) {
  // echo 'Welcome, '.$_SESSION['adminuser'].'!';
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>My Courses | UniCourse</title>
  </head>

  <body>
    <!-- all enrolled courses -->
    <h1 class="font-bold text-xl pl-4">Your Enrolled Courses (Download Your Certificate)</h1>
    <div class="m-4 grid grid-cols-3 gap-4">
      <?php
      $c1 = 'yellow';
      $c2 = 'purple';
      $c3 = 'indigo';
      $c4 = 'red';
      $c5 = 'pink';
      $c6 = 'green';
      $c7 = 'violet';
      $c8 = 'blue';
      $colors = array($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8);

      $random_keys = array_rand($colors, 2);
      $random_color_1 = $colors[$random_keys[0]];
      $random_color_2 = $colors[$random_keys[1]];
      ?>

      <?php
      include 'dbconfig.php';
      $user = $_SESSION['username'];
      $query = "SELECT * from std_enrolled, courses_details where Uid = '$user' and std_enrolled.cid = courses_details.cid";
      $result = mysqli_query($conn, $query);

      // print_r($result);

      // Check if any records were found
      if (mysqli_num_rows($result) > 0) {
        // Start building the HTML table
        echo '<script src="https://cdn.tailwindcss.com"></script>';
        // Loop through each record and add it to the table
        while ($row = mysqli_fetch_assoc($result)) {
          // color generated
          $random_keys = array_rand($colors, 2);
          $random_color_1 = $colors[$random_keys[0]];
          $random_color_2 = $colors[$random_keys[1]];

          echo '<div class="card rounded-lg bg-gradient-to-br from-' . $random_color_1 . '-400 to-' . $random_color_2 . '-500 p-4 cursor-pointer" onclick="sendAjaxRequest(\'' . $row['cid'] . '\')">
          <h1 class="font-bold">' . $row['course_name'] . ' (' . $row['cid'] . ')' . '</h1>
          <p class="mt-4 font-semibold text-gray-700">' . $row['description'] . '</p>
          </div>';
        }
      } else {
        echo 'No courses enrolled yet. Enroll here:<a href="../courses/courses.php"><span class="font-bold">Enroll Now</span></a>';
      }
      ?>

      <!-- js code here -->
      <!-- send ajax request to get course page -->
      <script>
        function sendAjaxRequest(cid) {
          // Create a new XMLHttpRequest object
          var xhttp = new XMLHttpRequest();

          const url = "gen.php?cid=" + cid;
          // Define the function to handle the AJAX response
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              // Redirect the user to the specified page
              // $("#main_content").html(this.responseText);
              window.location.href = "gen.php?cid=" + cid;
            }
          };

          // Build the AJAX request
          xhttp.open("GET", url, true);

          // Send the AJAX request
          xhttp.send();
        }
      </script>
  </body>

  </html>
<?php
} else {
  header("Location: ../login.html");
  exit();
}
?>