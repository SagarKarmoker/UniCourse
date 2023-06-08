<?php
session_start();
include 'dbconfig.php';
$user = $_SESSION['username'];

if(isset($user) && isset($_GET['cid'])){
  $cid = $_GET['cid'];
  echo $user . ' '. $cid;
// if operation
  $sql = "select cid, course_name, price from courses_details where cid = '$cid'";
  $res = $conn->query($sql);
  $row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>UniCourse Payment | UniCourse</title>
  </head>
  <body class="">
    <div class="flex items-center justify-center bg-blue-500 py-4">
      <h1 class="text-3xl font-bold text-white">UniCourse Payment</h1>
    </div>

    <div class="grid grid-cols-4">
      <div class="col-span-3 h-screen">
        <h1 class="ml-4 mt-4 text-xl font-bold">Payment Method:</h1>
        <div class="mt-8 flex items-center justify-center">
          <i class="fab fa-cc-visa fa-2x mx-4"></i>
          <i class="fab fa-cc-mastercard fa-2x mx-4"></i>
          <i class="fab fa-cc-amex fa-2x mx-4"></i>
          <i class="fab fa-cc-discover fa-2x mx-4"></i>
        </div>
        <div class="p-2">
          <div class="mx-auto my-16 max-w-md rounded-lg border bg-white p-8 shadow-xl">
            <h1 class="mb-6 text-2xl font-bold">Enter Your Card Details</h1>
            <form action="process.php" method="POST">
              <!-- Card number input field -->
              <div class="mb-6">
                <label for="card-number" class="mb-2 block font-bold text-gray-700"> Card Number </label>
                <input id="card-number" type="text" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX" class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 focus:outline-none" required />
              </div>

              <!-- Expiration date and CVV input fields -->
              <div class="-mx-2 mb-6 flex flex-wrap">
                <div class="w-1/2 px-2">
                  <label for="expiry-date" class="mb-2 block font-bold text-gray-700"> Expiration Date </label>
                  <input id="expiry-date" type="text" name="expiryDate" placeholder="MM/YY" class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 focus:outline-none" required />
                </div>
                <div class="w-1/2 px-2">
                  <label for="cvv" class="mb-2 block font-bold text-gray-700"> CVV </label>
                  <input id="cvv" type="text" name="cvv" placeholder="XXX" class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 focus:outline-none" required />
                </div>
              </div>

              <!-- Name on card input field -->
              <div class="mb-6">
                <label for="card-name" class="mb-2 block font-bold text-gray-700"> Name on Card </label>
                <input id="card-name" type="text" name="cardName" placeholder="Full Name" class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 focus:outline-none" required />
              </div>

              <!-- Submit button -->
              <div class="flex justify-end">
                <button type="submit" class="focus:shadow-outline rounded-full bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none" id="paynow" onclick="processPayment()">Pay Now</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="bg-green-100 p-4 shadow-lg">
        <div class="mt-6 rounded-lg bg-white p-8">
          <h1 class="mb-4 text-xl font-bold">Order Summary</h1>
          <div class="grid grid-cols-2 gap-4">
            <div class="py-2">
              <p class="text-gray-500">Course:</p>
              <p class="font-semibold text-gray-700"><?php echo $row['course_name'] . ' ('. $row['cid'] . ')' ?></p>
            </div>
            <div class="flex justify-end py-2">
              <div class="text-right">
                <p class="text-gray-500">Price:</p>
                <p class="font-semibold text-gray-700">$<?php echo $row['price'] ?></p>
              </div>
            </div>
          </div>
          <hr class="my-4" />
          <div class="grid grid-cols-2 gap-4">
            <div class="py-2">
              <p class="text-gray-500">Discount:</p>
              <p class="font-semibold text-gray-700">$0.00</p>
            </div>
            <div class="flex justify-end py-2">
              <div class="text-right">
                <p class="text-gray-500">Total:</p>
                <p class="text-2xl font-bold">$<?php echo $row['price'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
  $(document).ready(function() {
  $('#paynow').click(function(e) {
    e.preventDefault();
    var cardNumber = $('#card-number').val();
    var expiryDate = $('#expiry-date').val();
    var cvv = $('#cvv').val();
    var cardName = $('#card-name').val();
    var cid = "<?php echo $cid; ?>";

    console.log(cid);

    // Send the form data using AJAX
    $.ajax({
      type: 'POST',
      url: 'process.php',
      data: {
        'cardNumber': cardNumber,
        'expiryDate': expiryDate,
        'cvv': cvv,
        'cardName': cardName,
        'cid': cid,
      },
      success: function(response) {
        // Handle the response from the server
        console.log(response);
        alert('Payment successful!');
        window.location.href = "/student/classroom.php";
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(xhr.responseText);
        alert('Payment failed');
      }
    });
  });
});

</script>


  </body>
</html>


<?php
}
else{
  header("Location: ../login.html");
  //header("Location: ../index.php");
  exit();
}
?>