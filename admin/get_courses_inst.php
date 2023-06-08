<?php
include 'dbconfig.php';
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$data = $_GET['data'];
$sql = "SELECT cid, course_name, course_code, module, price, course_level, created FROM courses_details where instructor_id = '$data'";
$result = $conn->query($sql);

// Display data in table rows
if ($result->num_rows > 0) {
    // Loop through data and build HTML output
    $output = '<table>';
    while ($row = $result->fetch_assoc()) {
      $output .= '<tr>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['cid'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['course_name'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['course_code'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['module'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['price'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['course_level'] . '</td>';
      $output .= '<td class="px-4 py-2 text-center">' . $row['created'] . '</td>';
      $output .= '</tr>';
    }
    $output .= '</table>';
  } else {
    $output = '<p class="px-4 py-2 text-center">' . 'No results found' . '</p>';
  }
echo $output;

$conn->close();
?>
