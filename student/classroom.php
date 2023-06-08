<?php
session_start();
if(isset($_SESSION['username'])){
  // echo 'Welcome, '.$_SESSION['username'].'!';
?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <title>Student Dashboard | UniCourse</title>

</head>

<body>

  <!-- navbar -->

  <nav class="inline-flex grid bg-slate-100 sticky top-0">

    <ul class="flex inline-flex justify-center gap-10 p-4 font-semibold">

      <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="stream"> <a href="../index.php">Home</a></li>
      <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="courses">Courses</li>

      <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="stream"> <a href="classroom.php">Classroom</a></li>

      <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="work">Course work</li>

      <!-- <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="module">Module</li> -->

      <li class="hover:rounded-full hover:bg-white hover:p-2 cursor-pointer" id="cert">Certificate</li>

      <div class="flex justify-end item-end">
        <form action="logout.php" method="post">
          <button type="submit"><i class="fa fa-sign-out"></i> Sign Out</button>
        </form>
      </div>

    </ul>
  </nav>

  

  <!-- onclick sidebar -->

  <?php 
    include 'dbconfig.php';
    $user_id = $_SESSION['username'];
    $sql = "select * from userdetails where Uid = '$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row['Fname'] . ' ' . $row['Lname'];
  ?>



  <!-- main section -->

  <div>

    <div class="mt-4 mb-6">

      <div class="ml-[25%] mr-[25%]">
        <div id="main_content">
          <main class="py-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-4 flex justify-center item-center">Welcome <?php echo $name . '(' . $user_id . ')'; ?> to UniCourse student dashboard!</h2>
          <p class="text-gray-700 leading-loose font-semibold">
          Welcome to UniCourse, where we believe that education is the key to unlocking a bright future. As you begin your studies, keep in mind this quote from Abigail Adams: "Learning is not attained by chance, it must be sought for with ardor and diligence." We encourage you to approach your education with curiosity, passion, and determination. Remember that success is not final and failure is not fatal – what matters is the courage to continue learning and growing. We're excited to support you on your journey!
          </p>
          <a href="#" class="inline-block mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg" id="getstart">Get Started</a>
      </main>
        </div>
      </div>

    </div>

  </div>
  
  <script>
    $(document).ready(function() {
      $("#getstart").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "mycourse.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    $(document).ready(function() {
      $("#courses").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "mycourse.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    $(document).ready(function() {
      $("#work").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "work.php",
          success: function(result) {
            $("#main_content").html(result);
          }
        });
      });
    });

    // $(document).ready(function() {
    //   $("#module").click(function(e) {
    //     e.preventDefault(); // Prevent the default behavior of the link
    //     $.ajax({
    //       url: "modules.php",
    //       success: function(result) {
    //         $("#main_content").html(result);
    //       }
    //     });
    //   });
    // });

    $(document).ready(function() {
  // Attach a click event handler to the #module element
  $("#module").click(function(e) {
    e.preventDefault(); // Prevent the default behavior of the link

    // Get the CID value from the data-cid attribute of the clicked element
    const cid = $(this).data("cid");

    // Call the sendAjaxRequest function with the CID value
    sendAjaxRequest(cid);
  });
});

    $(document).ready(function() {
      $("#cert").click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        $.ajax({
          url: "allcert.php",
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
  header("Location: ../login.html");
  exit();
}
?>