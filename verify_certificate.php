<?php
include 'dbconfig.php';
// retrieve the certificate number and date of award from the POST data
$certificateNumber = $_POST['certificateNumber'];
$dateOfAward = $_POST['dateOfAward'];

// perform certificate verification here
$sql = "select * from certificate, userdetails, courses_details where cert_id='$certificateNumber' and certificate.uid = userdetails.Uid and certificate.cid = courses_details.cid";
$result = $conn->query($sql);

// return verification result as HTML
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo '<p class="text-green-600 text-xl">Certificate is valid! Certificate issued to <span class="font-bold">' . $row['Fname'] . ' ' . $row['Lname'] . '</span> for completing course <span class="font-bold">'. $row['course_name'] .'</span></p>';
} else {
  echo '<p class="text-red-600">Certificate is invalid.</p>';
}
?>
