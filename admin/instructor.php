<?php
session_start();
include 'dbconfig.php';
if(isset($_SESSION['adminuser'])){
    // echo 'Welcome, '.$_SESSION['adminuser'].'!';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="instructor.js"></script>
    <title>Students</title>
</head>

<body>
    <div class="flex justify-center item-center">
        <h1 class="mt-2 text-2xl font-bold text-white uppercase">All Course Instructors</h1>
    </div>
    <div class="bg-slate-500">
        <?php
        $query = "SELECT *, count(course_code) as tot from instructors, courses_details WHERE courses_details.instructor_id = instructors.instructor_id";
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
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Instructor id</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Instructor name</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">joined date</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Courses</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">View Courses</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Total Student</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Status</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Lock/Unlock</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';


            // Loop through each record and add it to the table
            while ($row = mysqli_fetch_assoc($result)) {
                // $st = $row['lock_status'];
                $i_id = $row['instructor_id'];
                $tot_std = "select count(*) as tot_std from std_enrolled where instructor_id = '$i_id'";
                $res = $conn->query($tot_std);
                $row_std = $res->fetch_assoc();
                // echo $row_std['tot_std'];

                echo '<tr>';
                echo '<td class="px-6 py-4 text-center">' . $row['instructor_id'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row['instructor_name'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row['joined_date'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row['tot'] . '</td>';
                echo '<td class="px-6 py-4 "><a href="#" onclick="openModal(\'' . $row['instructor_id'] . '\')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Courses</a></td>';
                echo '<td class="px-6 py-4 text-center">' . $row_std['tot_std'] . '</td>';
                // if ($st == "Locked") {
                //     echo '<td class="px-6 py-4"><a href="#" onclick="unlock(\'' . $row['Uid'] . '\')" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id ="status">Unblock</a></td>';
                // } else {
                //     echo '<td class="px-6 py-4"><a href="#" onclick="lock(\'' . $row['Uid'] . '\')" class="bg-green-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id ="status">Block</a></td>';
                // }
                // echo '</tr>';
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
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative bg-white w-auto mx-auto rounded shadow-lg">
                <!-- Modal header -->
                <div class="px-6 py-4 bg-gray-200">
                    <div class="text-lg font-bold text-gray-800">
                        Your Courses
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
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">CID</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Name</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Code</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Module</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Price</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Course Level</th>
                                <th class="px-4 py-2 bg-gray-200 text-gray-800">Created</th>
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

    <!-- Instructor without course -->
    <div>
        <div class="flex justify-center item-center">
        <h1 class="mt-2 text-2xl font-bold text-white uppercase">All Instructors (Without Course)</h1>
    </div>
    <div class="bg-slate-500">
        <?php
        $query1 = "SELECT * from instructors";
        $result1 = mysqli_query($conn, $query1);

        // print_r($result);

        // Check if any records were found
        if (mysqli_num_rows($result1) > 0) {
            // Start building the HTML table
            echo '<script src="https://cdn.tailwindcss.com"></script>';
            echo '<div class= "flex w-auto mx-5">';
            echo '<table class="w-full table-auto bg-white shadow-md rounded my-6 overflow-hidden">';
            echo '<thead class="bg-gray-50">';
            echo '<tr>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Instructor id</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Instructor name</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Profession</th>';
            echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">joined date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';


            // Loop through each record and add it to the table
            while ($row1 = mysqli_fetch_assoc($result1)) {
                echo '<tr>';
                echo '<td class="px-6 py-4 text-center">' . $row1['instructor_id'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row1['instructor_name'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row1['email'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row1['profession'] . '</td>';
                echo '<td class="px-6 py-4 text-center">' . $row1['joined_date'] . '</td>';
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
        mysqli_close($conn);
        ?>
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
    header("Location: admin.html");
    exit();
}
?>