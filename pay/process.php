<?php
session_start();
include 'dbconfig.php';
$num = $_POST['cardNumber'];
$date = $_POST['expiryDate'];
$cvv = $_POST['cvv'];
$name = $_POST['cardName'];
$cid = $_POST['cid'];
 
echo $num . ' ' . $date . ' ' . $cvv . ' ' .$name . ' ' . $cid ;

if(isset($_POST['cardNumber']) && isset($_POST['expiryDate']) && isset($_POST['cvv']) && isset($_POST['cardName'])) {

		$user = $_SESSION['username'];
		$cid = $_POST['cid'];

        $verify = "select * from bank_link natural join bank where uid = '$user'";
        $find = $conn->query($verify);
        $final = $find->fetch_assoc();

	var_dump($final);

        // form 
        $num = $_POST['cardNumber'];
        $date = $_POST['expiryDate'];
        $cvv = $_POST['cvv'];
        $name = $_POST['cardName'];

        // echo $num . $date . $cvv . $name;

        $getprice = "select instructor_id, price from courses_details where cid='$cid'";
        $result = $conn->query($getprice);
        $row = $result->fetch_assoc();

        if($find->num_rows > 0 && $final['balance'] > 0 ){
          if(($num == $final['cardnum']) && ($date == $final['date']) && ($cvv == $final['cvv']) && ($name == $final['name'])){
              $bank_user = $final['userid'];
          $price = $row['price'];
          $balance = $final['balance'];
          $balance = $balance - $price;
          $pay = "UPDATE bank SET balance = $balance WHERE userid = '$bank_user'";
          $done = $conn->query($pay);
        
          if ($done) {
          	//student enroll
          	$instrcutor = $row['instructor_id'];
          	$company = $price * 0.30;
          	$inst = $price - $company;
          	$txid = uniqid();
          	$tx = "insert into earning (cid, Uid, price, company, txid, inst_revenue) values ('$cid', '$user', '$price', '$company', '$txid', '$inst')";
          	$conn->query($tx);

          	$enroll = "INSERT INTO std_enrolled (cid, Uid, instructor_id, date_enrolled, status) VALUES ('$cid', '$user', '$instrcutor', NOW(), 'Running')";
            $conn->query($enroll);

            header("Location: /student/classroom.php");
            exit();
            // echo "done";
          } else {
            echo "alert('Payment failed. Please try again.');"; // show an alert message if query fails
          }
          }
          else{
            echo "alert('Wrong card information');";
          }
        }
        else{
          echo "alert('No user found or balance is zero');";
        }
      }

?>