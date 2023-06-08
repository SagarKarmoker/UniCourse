<?php
include 'dbconfig.php';

// check if the connection was successful
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// define the SQL query to fetch transactions from the database
$sql = "SELECT brought_on, price, txid, inst_revenue FROM earning";

// execute the query and store the results in a variable
$result = mysqli_query($conn, $sql);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // create an empty array to store the transactions
  $transactions = array();

  // loop through each row and add it to the transactions array
  while ($row = mysqli_fetch_assoc($result)) {
    $transactions[] = $row;
  }
} else {
  echo "No transactions found.";
}

// close the database connection
mysqli_close($conn);

// return the transactions as a JSON response
header('Content-Type: application/json');
echo json_encode($transactions);
?>
