<?php
include 'dbconfig.php';
session_start();
if(isset($_SESSION['instruct'])){
    //echo 'Welcome, '.$_SESSION['instruct'].'!';
    $inst = $_SESSION['instruct'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Selling Earnings Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="bg-gray-400 h-screen">
        <div class="container mx-auto py-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white mb-6">Course Selling Earnings Dashboard</h1>
                <button class="bg-blue-500 hover:bg-green-600 font-bold py-3 px-6 rounded-full animate-bounce duration-500">
                    Get Paid <i class="fa-solid fa-sack-dollar"></i>
                </button>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Total Revenue</h2>
                    <p class="text-3xl font-bold">
		   	<?php
               // get id from cookie
              $id = $inst;
			  $balance = "select * from instructor_earning where instructor_id = '$id'";
			  $res_ac = $conn->query($balance);
              $row_ac = $res_ac->fetch_assoc();

              echo '$'. $row_ac['balance'];
			?>
		    </p>
                    <!-- <p class="text-green-500 mt-2"><span class="text-sm">(+</span>$2,000<span class="text-sm">)</span> from last week</p> -->
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Average Order Value</h2>
                    <p class="text-3xl font-bold">$
                    <?php
                       $id = $inst;
                       $cnt = "select count(*) as sold from earning, courses_details where earning.cid = courses_details.cid and instructor_id = '$id'";
                       $res_cnt = $conn->query($cnt);
                       $row_cnt = $res_cnt->fetch_assoc();
                       $instBalance = $row_ac['balance'];
                       $total_sold = $row_cnt['sold'];
                       echo $instBalance/$total_sold;
			        ?>
                    </p>
                    <!-- <p class="text-red-500 mt-2"><span class="text-sm">(-</span>$5<span class="text-sm">)</span> from last month</p> -->
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Number of Courses Sold</h2>
                    <p class="text-3xl font-bold">
                    <?php
                    echo $row_cnt['sold'];
			        ?>
                    </p>
                    <!-- <p class="text-green-500 mt-2"><span class="text-sm">(+</span>25<span class="text-sm">)</span> from last week</p> -->
                </div>

            </div>
            <div class="mt-8 rounded-lg">
                <h2 class="text-xl font-bold text-white mb-4">Sales by Course Category</h2>
                <table class="w-full table-auto bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Course ID</th>
                            <th class="px-4 py-2">Course Name</th>
                            <th class="px-4 py-2">Student ID</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">30% of Total (UniCourse)</th>
                            <th class="px-4 py-2">Tx ID</th>
                            <th class="px-4 py-2">Revenue (70% of Course Price)</th>
                            <th class="px-4 py-2">Brought On </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * from earning, courses_details where earning.cid = courses_details.cid and instructor_id = '$id' order by id ASC";
                        $result = mysqli_query($conn, $query);

                        // print_r($result);

                        // Check if any records were found
                        if (mysqli_num_rows($result) > 0) {
                            // Start building the HTML table
                            echo '<script src="https://cdn.tailwindcss.com"></script>';
                            // Loop through each record and add it to the table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['id'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['cid'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['course_name'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['Uid'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['price'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['company'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['txid'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['inst_revenue'] . '</td>';
                                echo '<td class="border px-4 py-2 text-center">' . $row['brought_on'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "No records found";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
} else {
    header("Location: login.html");
    exit();
}
?>