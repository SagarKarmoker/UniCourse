<?php
include 'dbconfig.php';

session_start();
if(isset($_SESSION['instruct'])){
    //echo 'Welcome, '.$_SESSION['instruct'].'!';
$inst_id = $_SESSION['instruct'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="dash.js"></script>
    <title>Students</title>
</head>

<body>
    <div class="flex justify-center item-center bg-slate-500">
        <h1 class="mt-2 text-2xl font-bold text-white uppercase">All Enrolled Students</h1>
    </div>
    <div class="bg-slate-500 h-screen" id="upTable">
        <?php
        // Retrieve data from the "users" table
        $query = "SELECT DISTINCT Uid, Fname, Lname, Email, Profession, date_enrolled, Role, lock_status FROM userdetails natural join std_enrolled where instructor_id = '$inst_id'";
        $result = mysqli_query($conn, $query);

        // print_r($result);

        // Check if any records were found
        if (mysqli_num_rows($result) > 0) {
            // Start building the HTML table
            echo '<script src="https://cdn.tailwindcss.com"></script>';
            echo '<div class= "flex w-auto mx-5">';
            echo '<table class="w-full table-auto bg-white shadow-md rounded my-6 overflow-hidden">';
            echo '<thead class="bg-gray-50">';
            echo '<tr>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ID</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">First Name</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Last Name</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Profession</th>';
//            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Address</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Date Of Enrolled</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Role</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Enrolled Courses</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Status</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';

            // Loop through each record and add it to the table
            while ($row = mysqli_fetch_assoc($result)) {
                $st = $row['lock_status'];
                echo '<tr>';
                echo '<td class="px-6 py-4">' . $row['Uid'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['Fname'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['Lname'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['Email'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['Profession'] . '</td>';
//                echo '<td class="px-6 py-4">' . $row['Address'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['date_enrolled'] . '</td>';
                echo '<td class="px-6 py-4">' . $row['Role'] . '</td>';
                echo '<td class="px-6 py-4 "><a href="#" onclick="openModal(\'' . $row['Uid'] . ',' . $inst_id . '\')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Courses</a></td>';
                if ($st == "Locked") {
                    echo '<td class="px-6 py-4"><a href="#" onclick="unlock(\'' . $row['Uid'] . '\')" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id ="status">Unblock</a></td>';
                } else {
                    echo '<td class="px-6 py-4"><a href="#" onclick="lock(\'' . $row['Uid'] . '\')" class="bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id ="status">Block</a></td>';
                }
                echo '</tr>';
            }

            // Close the table
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
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
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Cid</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Code</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Name</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Date of Enrolled</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Finish Date</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800">Status</th>
                                </tr>
                            </thead>
                            <tbody id="modal-content"></tbody>
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
    </div>

    <!-- script -->
    <script>
        const coursesListItem = document.querySelector(".course");
        const coursesSubMenu = document.querySelector(".course_sub");

        coursesListItem.addEventListener("click", () => {
            coursesSubMenu.classList.toggle("hidden");
        });

        const stdListItem = document.getElementById("std");
        const stdSubMenu = document.getElementById("std_sub");

        stdListItem.addEventListener("click", () => {
            stdSubMenu.classList.toggle("hidden");
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