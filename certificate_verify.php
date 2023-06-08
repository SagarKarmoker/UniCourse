<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Certificate Verification</title>
</head>

<body class="bg-gray-100">
    <?php include 'nav.php' ?>
    <div class="flex justify-center items-center h-screen">
        <div class="p-8 bg-white rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Certificate Verification</h1>
            <form class="space-y-6">
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-x-4 sm:items-center">
                    <label for="certificate-number"
                        class="w-full sm:w-auto text-lg font-medium text-gray-700">Certificate Number:</label>
                    <input type="text" id="certificate-number" name="certificate-number"
                        class="border-gray-300 border w-full sm:w-auto px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
                        placeholder="6441a3f5e666a" />
                </div>
                <!--<div class="flex flex-col sm:flex-row space-y-4 sm:space-x-4 sm:items-center w-full">
                    <label for="date-of-award" class="w-full sm:w-auto text-lg font-medium text-gray-700">Date of
                        Award:</label>
                    <input type="date" id="date-of-award" name="date-of-award"
                        class="border-gray-300 border w-full sm:w-auto px-4 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" />
                </div>-->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300 ease-in-out">Verify</button>
            </form>
            <div class="mt-8" id="verification-result">
                <!-- Certificate verification result will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('form').submit(function (e) {
                e.preventDefault(); // prevent the form from submitting normally

                var certificateNumber = $('#certificate-number').val();
                var dateOfAward = $('#date-of-award').val();

                // send an AJAX request to the server to verify the certificate
                $.ajax({
                    type: "POST",
                    url: "verify_certificate.php",
                    data: { certificateNumber: certificateNumber, dateOfAward: dateOfAward },
                    success: function (data) {
                        $('#verification-result').html(data);
                    }
                });
            });
        });

    </script>
</body>

</html>