<?php
include 'dbconfig.php';
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$data = $_GET['data'];
$sql = "SELECT courses_details.cid, course_name, date_enrolled, finish_date, status FROM std_enrolled, courses_details where Uid = '$data' and std_enrolled.cid = courses_details.cid";
$result = $conn->query($sql);

// Display data in table rows
if ($result->num_rows > 0) {
    // Loop through data and build HTML output
    $output = '<table>';
    while ($row = $result->fetch_assoc()) {
      $output .= '<tr>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['cid'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['course_name'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['date_enrolled'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['finish_date'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['status'] . '</td>';
      $output .= '</tr>';
    }
    $output .= '</table>';
  } else {
    $output = '<p class="px-4 py-2 text-center">' . 'No results found' . '</p>';
  }
echo $output;

$conn->close();
?>
