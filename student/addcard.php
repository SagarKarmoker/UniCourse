<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Add Card details</title>
  </head>
  <body>
    <div class="mt-10 flex items-center justify-center">
      <form id="addCardForm" action="card.php" class="rounded-xl border p-4" method="POST">
        <h1 class="text-center text-xl font-bold">Add Your Payment Details</h1>
        <div class="mt-2">
          <label for="cardnum" class="font-semibold">Card Number</label>
          <input type="text" name="cardnum" id="cardnum" class="mt-2 w-full rounded-xl border p-2" placeholder="XXXX XXXX XXXX XXXX" />
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="mt-2">
            <label for="date" class="font-semibold">Expiry Date</label>
            <input type="text" name="date" id="date" class="mt-2 rounded-xl border p-2" placeholder="MM/YYYY" />
          </div>
          <div class="mt-2">
            <label for="cvv" class="font-semibold">CVV</label>
            <input type="password" name="cvv" id="cvv" class="mt-2 rounded-xl border p-2" placeholder="CVV" />
          </div>
        </div>
        <div class="mt-2">
          <label for="name" class="font-semibold">Card Holder Name</label>
          <input type="text" name="name" id="name" class="mt-2 w-full rounded-xl border p-2" placeholder="Full Name" />
        </div>
        <div class="flex justify-end mt-4">
          <button type="submit" class="border p-2 rounded-full bg-blue-600 font-bold text-white text-sm">Add Card</button>
        </div>
      </form>
    </div>

<script>
$(function() {
  $('#addCardForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'card.php',
      data: $(this).serialize(),
      success: function(response) {
        alert(response);
	window.location.href = "https://unicourse.helloworlddev.software/student/classroom.php";
      },
      error: function() {
        alert('Error adding card');
      }
    });
  });
});
</script>

  </body>
</html>
