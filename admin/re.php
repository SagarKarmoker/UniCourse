<?php
include 'dbconfig.php';

// Retrieve data from the "users" table
$query = "SELECT * FROM userdetails";
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
    echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Address</th>';
    echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Date Of Reg.</th>';
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
        echo '<td class="px-6 py-4">' . $row['Address'] . '</td>';
        echo '<td class="px-6 py-4">' . $row['DoR'] . '</td>';
        echo '<td class="px-6 py-4">' . $row['Role'] . '</td>';
        echo '<td class="px-6 py-4 "><a href="#" onclick="openModal(\'' . $row['Uid'] . '\')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Courses</a></td>';
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
mysqli_close($conn);
?>