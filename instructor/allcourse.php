<?php
include 'dbconfig.php';
session_start();
if (isset($_SESSION['instruct'])) {
  //echo 'Welcome, '.$_SESSION['instruct'].'!';
  $inst = $_SESSION['instruct'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Instructor Dashboard | UniCourse</title>
  </head>

  <body>
    <div class="">
      <div id="main_content">
        <!-- main page -->
        <div class="w-full">
          <main class="p-6">
            <p class="text-xl font-semibold mb-4">Welcome to your assignment dashboard!</p>
            <p class="mb-4">Here you can manage your courses, track your students' progress, and more. If you dont have any course just get started!</p>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600" id="getStarted">Get Started</button>
          </main>

          <main class="flex-1 p-4">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-xl font-bold">My Courses (Create Assignment)</h2>
              <button class="px-4 py-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" id="add">
                Create Course
              </button>
            </div>
            <div class="grid grid-cols-5 gap-4 sm:grid-cols-2 lg:grid-cols-3">
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


              // get id from cookie
              $sql = "SELECT * FROM courses_details where instructor_id = '$inst'";
              $result = $conn->query($sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $random_keys = array_rand($colors, 2);
                  $random_color_1 = $colors[$random_keys[0]];
                  $random_color_2 = $colors[$random_keys[1]];
                  echo '<div class="bg-gradient-to-br from-' . $random_color_1 . '-400 to-' . $random_color_2 . '-500 border shadow-sm rounded-md p-4">
                  <h3 class="font-bold text-lg mb-2">' . $row['course_name'] . '(' . $row['cid'] .  ')</h3>
                  <p class="text-gray-700">' . $row['description'] . '</p>
                  <div class="flex justify-between">
                  <a href="#" class="block mt-4 text-black hover:text-blue-700" onclick="viewAssign(\'' . $row['cid'] . '\')"><i class="fa-solid fa-paperclip"></i> View Assignment</a>
                  &nbsp;&nbsp;
                  <a href="#" class="block mt-4 text-black hover:text-blue-700" onclick="sendCIDRequest(\'' . $row['cid'] . '\')"><i class="fas fa-edit"></i> Create Assignment</a>
                  </div>
                  </div>';
                }
              } else {
                echo "0 results";
              }
              ?>
              <!-- Repeat the above course card element for each course -->
            </div>
          </main>
        </div>
      </div>
    </div>
    </div>
    </div>



    <!-- ajax code here -->
    <script>
      $(document).ready(function() {
        $("#getStarted").click(function(e) {
          e.preventDefault(); // Prevent the default behavior of the link
          $.ajax({
            url: "addcourse.html",
            success: function(result) {
              $("#main_content").html(result);
            }
          });
        });
      });

      $(document).ready(function() {
        $("#course_add").click(function(e) {
          e.preventDefault(); // Prevent the default behavior of the link
          $.ajax({
            url: "addcourse.html",
            success: function(result) {
              $("#main_content").html(result);
            }
          });
        });
      });

      $(document).ready(function() {
        $("#add").click(function(e) {
          e.preventDefault(); // Prevent the default behavior of the link
          $.ajax({
            url: "addcourse.html",
            success: function(result) {
              $("#main_content").html(result);
            }
          });
        });
      });


      function sendCIDRequest(cid) {
        // Get the course ID here
        var cid = cid;

        // Send the AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // Handle the response here
            // console.log(this.responseText);
            $("#main_content").html(this.responseText);
          }
        };
        xhttp.open("POST", "assign.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("cid=" + cid);
      }

      function viewAssign(cid) {
        // Send the AJAX request
        fetch("work.php", {
            method: "POST",
            headers: {
              "Content-type": "application/x-www-form-urlencoded"
            },
            body: "cid=" + cid,
          })
          .then((response) => response.text())
          .then((data) => {
            $("#main_content").html(data);
          })
          .catch((error) => console.error(error));
      }
    </script>
  </body>

  </html>
<?php
} else {
  header("Location: login.html");
  exit();
}
?>