<?php
include 'dbconfig.php';
session_start();
if(isset($_SESSION['instruct'])){
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
  <div class="flex">
    <!-- sidebar left -->
    <div class="h-screen sticky top-0 bg-gray-100">
      <div class="w-full h-screen bg-gray-800 text-gray-100 flex flex-col">
        <div class="flex items-center justify-center h-16 px-4 mt-4">
          <span class="text-white text-xl font-semibold cursor-pointer"><a href="dash.php">Instructor Dashboard</a></span>
        </div>
        <nav class="flex-grow px-4 py-8">
          <a href="dash.php" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg"><i class="fa fa-home"></i> Dashboard</a>
          <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg" id="course_add"><i class="fa fa-book"></i> Create Course</a>
          <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg" id="assign"><i class="fa-solid fa-pen-fancy"></i> Create Assignment</a>
          <!-- <a href="../student/classroom.html" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg" id="classroom"><i class="fa-solid fa-chalkboard-user"></i> Classroom</a> -->
          <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg" id="view_std"><i class="fa-solid fa-graduation-cap"></i> View Students</a>
          <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg" id="earn"><i class="fa-solid fa-sack-dollar"></i> Earning</a>
        </nav>
      </div>
    </div>
    <!-- right side -->
    <div class="w-full">
      <!-- navbar -->
      <div class="flex sticky top-0 justify-between bg-slate-600">
        <header class="px-4 py-4 bg-white shadow border-b w-full">
          <h1 class="text-lg font-bold">Course Instructor Dashboard</h1>
          <div class="flex justify-end">
            <form action="logout.php" method="post">
              <button type="submit" ><i class="fa fa-sign-out"></i> Sign Out</button>
            </form>
          </div>
        </header>
      </div>

      <!--  -->
      <div id="main_content">
        <!-- main page -->
        <div class="">
          <main class="p-6">
            <p class="text-xl font-semibold mb-4">Welcome to your dashboard!</p>
            <p class="mb-4">Here you can manage your courses, track your students' progress, and more.</p>
            <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600" id="getStarted">Get Started</button>
          </main>

          <main class="flex-1 p-4">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-xl font-bold">My Courses</h2>
              <button class="px-4 py-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" id="add">
                Create Course
              </button>
            </div>
            <ul class="grid grid-cols-4 gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <?php
              // get id from cookie
              $sql = "SELECT * FROM courses_details where instructor_id = '$inst'";
              $result = $conn->query($sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<li class="bg-white border shadow-sm rounded-md p-4">
                  <h3 class="font-bold text-lg mb-2">' . $row['course_name'] . '(' . $row['cid'] .  ')</h3>
                  <p class="text-gray-700">' . $row['description'] . '</p>
                  <a href="#" class="block mt-4 text-blue-500 hover:text-blue-700">
                  <i class="fas fa-edit"></i> Edit
                  </a>
                  </li>';
                }
              } else {
                echo "0 results";
              }
              ?>
              <!-- Repeat the above course card element for each course -->
            </ul>
          </main>
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


    $(document).ready(function() {
      $("#classroom").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "../student/classroom.html", // all created assginments
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    $(document).ready(function() {
      $("#view_std").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "allstd.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    $(document).ready(function() {
      $("#earn").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "earning.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    $(document).ready(function() {
      $("#assign").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "allcourse.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });
  </script>
</body>

</html>

<?php
} else {
    header("Location: login.html");
    exit();
}
?>