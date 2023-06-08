<?php
session_start();
if(isset($_SESSION['username'])){
  // echo 'Welcome, '.$_SESSION['username'].'!';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator</title>
    <!-- Include the Tailwind CSS stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" integrity="sha512-hvG+9yygpKtTcOMf71sJ+MbCZDj06fdYzgsFbUtVHxu656OoBEnXOrMk6eK1lZQ1wW+btx7o5P/vafoRp7Uyqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-bold mb-5">Certificate Generator</h1>
        <!-- Certificate form -->
        <form class="border p-5 rounded-lg shadow-md" onsubmit="return validateForm()">
            <!-- Certificate title input -->
            <div class="mb-5">
                <label for="title" class="block font-medium mb-2">Certificate Title</label>
                <input type="text" id="title" name="title" class="block w-full border-gray-300 rounded-lg px-4 py-2" placeholder="Course Name Here" disabled>
            </div>
            <!-- Recipient name input -->
            <div class="mb-5">
                <label for="recipient" class="block font-medium mb-2">Recipient Name</label>
                <input type="text" id="recipient" name="recipient" class="block w-full border-gray-300 rounded-lg px-4 py-2 bg-gray-50" placeholder="Enter your official Name" required>
            </div>
            <!-- Issuer name input -->
            <div class="mb-5">
                <label for="issuer" class="block font-medium mb-2">Issuer Name</label>
                <input type="text" id="issuer" name="issuer" class="block w-full border-gray-300 rounded-lg px-4 py-2" disabled placeholder="Unicourse">
            </div>
            <!-- Certificate date input -->
            <div class="mb-5">
                <label for="date" class="block font-medium mb-2">Certificate Date</label>
                <input type="date" id="date" name="date" class="block w-full border-gray-300 rounded-lg px-4 py-2 bg-gray-50" required>
            </div>
            <!-- Submit button -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg px-4 py-2">Get Certificate</button>
        </form>
    </div>

    <script>
        // Get the current date
        const currentDate = new Date().toISOString().substr(0, 10);

        // Set the value of the date input element to the current date
        document.getElementById("date").value = currentDate;

        // Validate form function
        function validateForm() {
            const titleField = document.getElementById("title");
            const recipientField = document.getElementById("recipient");
            const dateField = document.getElementById("date");

            // Check if the title field is empty
            if (titleField.value.trim() == "") {
                alert("Please enter a certificate title.");
                return false;
            }

            // Check if the recipient field is empty
            if (recipientField.value.trim() == "") {
                alert("Please enter your name.");
                return false;
            }

            // Check if the date field is in the future
            if (dateField.value > currentDate) {
                alert("The date cannot be in the future.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
<?php
} else {
  header("Location: ../login.html");
  exit();
}
?>