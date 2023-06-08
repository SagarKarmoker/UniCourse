<?php
include 'dbconfig.php';

$sql = "SELECT * FROM courses_details";
$result = $conn->query($sql);
// $row = $result->fetch_assoc();
echo '<script src="https://cdn.tailwindcss.com"></script>';
echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 m-4">';
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        // echo $row['cid'];
        echo '<div class="bg-white shadow-lg rounded-lg overflow-hidden">';
        echo '<img class="w-full h-48 object-scale-down object-center"
                                src="data:image/png;base64,' . base64_encode($row['thumbnail']) . '" alt="Course Image">';
        echo '<div class="px-6 py-4">';
        echo '<h3 class="text-lg font-bold text-gray-800 mb-2"> '. $row['course_name'] . '</h3>';
        echo '<p class="text-gray-600">'. $row['description'] . '</p>';
        echo '</div>';
        echo '<div class="mt-4 flex justify-between px-6 py-4">';
        echo '<button class="bg-gray-500 text-white text-bold p-2 justify-center rounded-lg font-bold" onclick="redirectToPage(\'' . $row['cid'] . '\')">View Course Details</button>';
        // echo '<a href="#" class="bg-indigo-700 text-white text-bold p-2 justify-center mr-2 rounded-lg font-bold">Enroll Now</a>';
        echo '</div>';
        echo '</div>';
    }
    } else {
        echo "0 results";
    }
    echo '</div>';
?> 

<script>
function redirectToPage(cid) {
  // Create a new XMLHttpRequest object
  var xhttp = new XMLHttpRequest();

  // Define the function to handle the AJAX response
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Redirect the user to the specified page
      const url = "course.php?cid=" + cid;
      window.location.href = url;
    }
  };

  // Build the AJAX request
  const url = "course.php?cid=" + cid;
  xhttp.open("GET", url, true);

  // Send the AJAX request
  xhttp.send();
}


</script>