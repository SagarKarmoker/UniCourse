<?php
session_start();
include 'dbconfig.php';
$user = $_SESSION['username'];
$cid = $_POST['cid'];
echo $user . ' '. $cid;

if(isset($user) && isset($cid)){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>UniCourse Mobile Payment | UniCourse</title>
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
          <i class="fas fa-mobile-alt fa-2x mx-4"></i>
        </div>
        <div class="p-2">
          <div class="container mx-auto mt-16">
            <div class="justify-center md:-mx-4 md:flex">
              <div class="mb-8 w-full px-4 md:mb-0 md:w-1/2">
                <form action="#" method="POST" class="border mb-4 rounded-lg bg-white px-8 pb-8 pt-6 shadow">
                  <h2 class="mb-6 text-xl font-bold">UniKash Mobile Payment Information</h2>
                  <div class="mb-4">
                    <label class="mb-2 block font-bold text-gray-700" for="mobileNumber"> Mobile Number </label>
                    <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="mobileNumber" type="tel" placeholder="Enter mobile number" required />
                  </div>
                  <div class="mb-4">
                    <label class="mb-2 block font-bold text-gray-700" for="amount"> Amount </label>
                    <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="amount" type="number" min="1" placeholder="Enter amount" required />
                  </div>
                  <div class="mb-4">
                    <label class="mb-2 block font-bold text-gray-700" for="pin"> Pin: </label>
                    <input class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" id="pin" type="password" min="1" placeholder="Enter pin" required />
                  </div>
                  <div class="flex items-center justify-between">
                    <button type="submit" class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none">Pay Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-green-100 p-4 shadow-lg">
        <div class="mt-6 rounded-lg bg-white p-8">
          <h1 class="mb-4 text-xl font-bold">Order Summary</h1>
          <div class="grid grid-cols-2 gap-4">
            <div class="py-2">
              <p class="text-gray-500">Course:</p>
              <p class="font-semibold text-gray-700">CS101</p>
            </div>
            <div class="flex justify-end py-2">
              <div class="text-right">
                <p class="text-gray-500">Price:</p>
                <p class="font-semibold text-gray-700">$14.99</p>
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
                <p class="text-2xl font-bold">$14.99</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
}
else{
  header("Location: ../login.html");
  exit();
}
?>