<?php
session_start();
include 'dbconfig.php';
if (isset($_SESSION['adminuser'])) {
    // if logged in
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Include Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Add Admin with Privileges</title>
    </head>

    <body>
        <div class="grid grid-cols-2 gap-2">
            <div class="container mx-auto mt-10 text-white ml-12">
                <h1 class="text-3xl font-bold mb-5">Add Admin with Privileges</h1>
                <form class="w-full max-w-lg" method="POST" action="#">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-xs font-bold mb-2 text-white" for="username">
                                Username
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded-xl py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="username" type="text" name="username" placeholder="Enter username">
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-xs font-bold mb-2 text-white" for="email">
                                Email
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded-xl py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="email" type="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-xs font-bold mb-2 text-white" for="password">
                                Password
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded-xl py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="password" type="password" name="password" placeholder="Enter a password">
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-xs font-bold mb-2 text-white" for="privileges">
                                Privileges
                            </label>
                            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded-xl py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="privileges" name="privileges">
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                            </select>
                        </div>
                        <div class="w-full px-3">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                                Add Admin
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="alladmin ">
                <div class="flex justify-center item-center">
                    <h1 class="mt-2 text-2xl font-bold text-white uppercase">All admins</h1>
                </div>
                <div class="bg-slate-500" id="upTable">
                    <?php
                    // Retrieve data from the "users" table
                    $query = "SELECT * FROM admindb";
                    $result = mysqli_query($conn, $query);

                    // print_r($result);

                    // Check if any records were found
                    if (mysqli_num_rows($result) > 0) {
                        // Start building the HTML table
                        echo '<script src="https://cdn.tailwindcss.com"></script>';
                        echo '<div class= "flex w-auto mx-5">';
                        echo '<table class="w-full table-auto bg-white shadow-md rounded my-6 overflow-hidden">';
                        echo '<thead class="bg-gray-50">';
                        echo '<tr>';
                        echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Admin ID</th>';
                        echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>';
                        echo '<th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Privilege</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody class="bg-white divide-y divide-gray-200">';

                        // Loop through each record and add it to the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="px-6 py-4 text-center">' . $row['adminID'] . '</td>';
                            echo '<td class="px-6 py-4 text-center">' . $row['email'] . '</td>';
                            echo '<td class="px-6 py-4 text-center">' . $row['privilege'] . '</td>';
                            echo '</tr>';
                        }

                        // Close the table
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    } else {
                        echo "No records found";
                    }
                    // Close the database connection
                    // mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>

        <!-- js code here -->
        <script>
            $(document).ready(function() {
                $('form').submit(function(event) {
                    event.preventDefault(); // prevent default form submit behavior
                    var formData = $(this).serialize(); // serialize form data
                    $.ajax({
                        type: 'POST',
                        url: 'add_admin.php',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // handle successful response
                            console.log(response);
                            alert(response.message);
                            $('form')[0].reset();
                        },
                        error: function(xhr, status, error) {
                            // handle error response
                            console.log(error);
                            alert(error.message);
                        }
                    });
                });
            });
        </script>



    </body>

    </html>
<?php
} else {
    header("Location: admin.html");
    exit();
}
?>