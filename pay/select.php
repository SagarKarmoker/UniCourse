<?php 
include 'dbconfig.php';
$cid = 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.4/tailwind.min.css">
  <title>Select Payment Option</title>
</head>
<body class="bg-gray-100">
  <div class="max-w-lg mx-auto py-10">
    <h1 class="text-center text-3xl font-semibold mb-6">Select Payment Option</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="paymentOptions">
      <!-- Option 1 -->
      <div class="bg-white rounded-lg shadow-md flex items-center justify-between p-6" data-option="card">
        <div class="flex items-center">
          <img src="https://dummyimage.com/64x64/ccc/000" alt="Credit Card" class="mr-4">
          <div>
            <h2 class="font-semibold text-lg">Credit/Debit Card</h2>
            <p class="text-gray-600 mt-2">Pay with your Visa, Mastercard or American Express card.</p>
          </div>
        </div>

        <button class="payment-option bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full transition duration-300 ease-in-out">
          Select
        </button>
      </div>

      <!-- Option 2 -->
      <div class="bg-white rounded-lg shadow-md flex items-center justify-between p-6" data-option="unikash">
        <div class="flex items-center">
          <img src="https://dummyimage.com/64x64/ccc/000" alt="PayPal" class="mr-4">
          <div>
            <h2 class="font-semibold text-lg">UniKash</h2>
            <p class="text-gray-600 mt-2">Pay with your UniKash account.</p>
          </div>
        </div>

        <button class="payment-option bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full transition duration-300 ease-in-out">
          Select
        </button>
      </div>
      </div>
    </div>
  </div>

  <script>
    const paymentOptions = document.querySelectorAll('.payment-option');

paymentOptions.forEach(option => {
  option.addEventListener('click', () => {
    // Remove active class from all payment options
    paymentOptions.forEach(option => {
      option.classList.remove('active');
    });

    // Add active class to the selected payment option
    option.classList.add('active');

    // Log the selected payment option to the console
    const selectedOption = option.parentNode.getAttribute('data-option');
    // console.log(`Selected payment option: ${selectedOption}`);
    if(selectedOption == 'card'){
      // redirect to the page
      window.location.href = 'payment.php';
    }
    else{
      // redirect to another page
      window.location.href = 'unikash.php';
    }
  });
});

  </script>
</body>
</html>