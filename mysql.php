<?php
include 'dbconfig.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT course_code, course_name, date_enrolled, finish_date, status FROM stdEnrolled";
$result = $conn->query($sql);

// Display data in table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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