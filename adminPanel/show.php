<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin Panel</title>
</head>

<body>
  <nav class="bg-gray-900 py-4">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <a href="#" class="text-white font-bold text-xl">UniCourse Admin</a>
          <div class="ml-4 flex items-center">
            <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Admins</a>
            <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Classrooms</a>
            <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Instructors</a>
            <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Upcoming</a>
          </div>
        </div>
        <div class="flex items-center">
          <button class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My Account</button>
          <button class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium ml-4">Logout</button>
        </div>
      </div>
    </div>
  </nav>
  <!-- Student Details -->
  <?php

use LDAP\Result;

  $servername = "localhost:4306";
  $username = "root";
  $password = "";
  $dbname = "cse347_project";
  // Establish a database connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Retrieve data from the "users" table
  $query = "SELECT * FROM userdetails";
  $result = mysqli_query($conn, $query);


  // Check if any records were found
  if (mysqli_num_rows($result) > 0) {
    // Start building the HTML table
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    echo '<table class="min-w-full divide-y divide-gray-200">';
    echo '<thead class="bg-gray-50">';
    echo '<tr>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ID</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">First Name</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Last Name</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Profession</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Address</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Date Of Reg.</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Role</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Enrolled Courses</th>';
    echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Status</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody class="bg-white divide-y divide-gray-200">';

    // Loop through each record and add it to the table
    while ($row = mysqli_fetch_assoc($result)) {
      // session_start();
      $_SESSION['data'] = $row['Uid'];

      echo '<tr>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Uid'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Fname'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Lname'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Email'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Profession'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Address'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['DoR'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap">' . $row['Role'] . '</td>';
      echo '<td class="px-6 py-4 whitespace-nowrap"><a href="#' . $row['Uid'] . '" onclick="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Courses</a></td>';

      echo '<td class="px-6 py-4 whitespace-nowrap"><a href="' . '" class="bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Block/Unblock</a></td>';
      echo '</tr>';
    }

    // Close the table
    echo '</tbody>';
    echo '</table>';
  } else {
    echo "No records found";
  }

  // Close the database connection
  // mysqli_close($conn);
  ?>

  <!-- Modal -->
  <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
      <div class="relative bg-white w-auto mx-auto rounded shadow-lg">
        <!-- Modal header -->
        <div class="px-6 py-4 bg-gray-200">
          <div class="text-lg font-bold text-gray-800">
            Enrolled Courses
          </div>
          <button class="absolute top-0 right-0 mt-2 mr-2" onclick="closeModal()">
            <svg class="h-6 w-6 text-gray-700 hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 5.293a1 1 0 0 1 1.414 0L10 8.586l3.293-3.293a1 1 0 1 1 1.414 1.414L11.414 10l3.293 3.293a1 1 0 1 1-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 0 1-1.414-1.414L8.586 10 5.293 6.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
        <!-- Modal content -->
        <div class="p-6">
          <table class="table-auto border border-gray-400">
            <thead>
              <tr>
                <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Code</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Name</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-800">Date of Enrolled</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-800">Finish Date</th>
                <th class="px-4 py-2 bg-gray-200 text-gray-800">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Connect to the database
              $servername = "localhost:4306";
              $username = "root";
              $password = "";
              $dbname = "cse347_project";
              // Establish a database connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              // session_start();
              $data = $_SESSION['data'];
              echo $data;

              // Retrieve data from the database
              $sql = "SELECT course_code, course_name, date_enrolled, finish_date, status FROM stdEnrolled where Uid = '$data'";
              $result = $conn->query($sql);

              // Display data in table rows
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo $row["course_code"];
                  echo "<tr>";
                  echo "<td class='border px-4 py-2'>" . $row["course_code"] . "</td>";
                  echo "<td class='border px-4 py-2'>" . $row["course_name"] . "</td>";
                  echo "<td class='border px-4 py-2'>" . $row["date_enrolled"] . "</td>";
                  echo "<td class='border px-4 py-2'>" . $row["finish_date"] . "</td>";
                  echo "<td class='border px-4 py-2'>" . $row["status"] . "</td>";
                  echo "</tr>";
                }
              } else {
                echo "0 results";
              }

              $conn->close();
              ?>
            </tbody>
          </table>
        </div>

        <!-- Modal footer -->
        <div class="px-6 py-4 bg-gray-200 flex justify-end">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- Modal script -->
<script>
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }
</script>

</html>