<?php
session_start();
include 'dbconfig.php';
if(isset($_SESSION['adminuser'])){
    // echo 'Welcome, '.$_SESSION['adminuser'].'!';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Selling Earnings Dashboard</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>

<body class="">
    <div class="h-screen">
        <div class="container mx-auto py-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white mb-6">Course Selling Earnings Dashboard</h1>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Total Revenue</h2>
                    <p class="text-3xl font-bold">
            <?php
               // get id from cookie
              $id = 'unicourse_admin';
              $balance = "select * from instructor_earning where instructor_id = '$id'";
              $res_ac = $conn->query($balance);
              $row_ac = $res_ac->fetch_assoc();

              echo '$'. $row_ac['balance'];
            ?>
            </p>
                    <!-- <p class="text-green-500 mt-2"><span class="text-sm">(+</span>$2,000<span class="text-sm">)</span> from last week</p> -->
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Average Earning</h2>
                    <p class="text-3xl font-bold">$
                    <?php
                       $cnt = "select count(*) as sold from earning";
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

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="font-semibold text-lg mb-4">Paid to Instructors</h2>
                    <p class="text-3xl font-bold">
                    <?php
                        $tot_paid = "select sum(inst_revenue) as total_paid from earning";
                        $paid_res = $conn->query($tot_paid);
                        $paid_row = $paid_res->fetch_assoc();
                        echo '$' . $paid_row['total_paid'];
                    ?>
                    </p>
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
                            <th class="px-4 py-2">Instructor Revenue (70% of Course Price)</th>
                            <th class="px-4 py-2">Brought On </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * from earning, courses_details where earning.cid = courses_details.cid order by id ASC";
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
    header("Location: admin.html");
    exit();
}
?>