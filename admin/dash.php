<?php
session_start();
// require 'F:\Program Files\Xampp\NewXampp\htdocs\Project\dbconfig.php';
include 'dbconfig.php';


if(isset($_SESSION['adminuser'])){
    echo 'Welcome, '.$_SESSION['adminuser'].'!';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="dash.js"></script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="flex font-mono">
        <div class="h-screen sticky top-0 bg-gray-100 p-5 pt-8">
            <!-- left icon -->
            <div class="absolute cursor-pointer rounded-full">
                <!-- <i class="fa fa-arrow-circle-left"></i> -->
            </div>
            <div class="inline-flex">
                <img src="../fav/favicon-32x32.png" alt="logo" class="float-left mr-2 h-10 cursor-pointer rounded-full" />
                <h1 class="origin-left text-2xl font-medium">UniCourse</h1>
            </div>
            <div>
                <hr class="bg-black"/>
            </div>
            <div class="mt-6 flex items-center rounded-full bg-gray-300 px-4 py-2" id="">
                <input type="text" name="" id="" class="bg-gray-300 focus:outline-none" />
                <i class="fa fa-search cursor-pointer px-2" id=""></i>
            </div>
            <div class="flex items-center rounded-full px-4 py-2">
                <ul class="pt-2">
                    <li class="flex cursor-pointer items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700">
                        <i class="fa fa-home float-left block"></i><a href="https://unicourse.helloworlddev.software/admin/dash.php">Dashboard</a>
                    </li>
                    <li class="relative course">
                        <button class="flex items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700 course">
                            <i class="fa fa-book"></i>
                            <span>Courses</span>
                            <i class="fa fa-caret-down ml-20"></i>
                        </button>
                        <!-- sub menu -->
                        <ul class="relative hidden text-gray-900 pt-1 w-full rounded-lg z-10 course_sub">
                            <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700" id="course_add">Add
                                    Course</a>
                            </li>
                            <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700" id="course_view">View
                                    Course</a>
                            </li>
                            <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700">Get
                                    Course Details</a>
                            </li>
                        </ul>
                    </li>

                    <li class="relative" id="std">
                        <button class="flex items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700 course">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span>Students</span>
                            <i class="fa fa-caret-down ml-16"></i>
                        </button>
                        <!-- sub menu -->
                        <ul class="relative hidden text-gray-900 pt-1 w-full rounded-lg z-10" id="std_sub">
                            <!-- <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700">Add
                                    Student</a>
                            </li> -->
                            <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700" id="std_view">View
                                    Student</a>
                            </li>
                            <li>
                                <a href="#" class="text-md flex items-center rounded-full pb-1 font-semibold py-2 px-4 hover:text-blue-700" id="enrolled_std">Enrolled
                                    Student Details</a>
                            </li>
                        </ul>
                    </li>
                    <li class="flex cursor-pointer items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700" id="inst">
                        <i class="fa fa-pencil"></i>Instructors
                    </li>
                    <li class="flex cursor-pointer items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700" id="earn">
                        <i class="fa fa-usd"></i>Earning
                    </li>
                    <li class="flex cursor-pointer items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700" id="add_admin">
                        <i class="fa fa-unlock"></i>Admin Setting
                    </li>
                    <li class="flex cursor-pointer items-center gap-x-2 rounded-full p-2 text-xl font-semibold text-gray-900 hover:text-blue-700">
                        <i class="fa fa-cogs"></i><a href="http://47.251.18.165:888/phpmyadmin_b6d46c684fc5995f/index.php?route=/database/structure&db=cse347_project">DB Setting</a>
                    </li>

                    <div class="absolute bottom-2">
                        <hr class="w-full">
                        <div class="inline-flex ">
                            <form action="logout.php" method="post">
                                <button type="submit"><i class="fa fa-sign-out"></i> Sign Out</button>
                            </form>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <!-- right side -->
        <div class="w-full bg-slate-500">
            <!-- <h1 class="text-2xl font-semibold">Home Page</h1> -->
            <!-- navbar -->
            <div class="flex sticky top-0 justify-between bg-slate-600">
                <div class="flex justify-start">
                    <div class="flex m-2 ml-5 items-center rounded-full bg-gray-300 px-4 py-2" id="">
                        <input type="text" name="" id="" class="bg-gray-300 focus:outline-none" />
                        <i class="fa fa-search cursor-pointer px-2" id=""></i>
                    </div>
                </div>
                <div class="flex mt-2">
                    <h1 class="text-white font-semibold text-2xl">Welcome to Admin Dashboard</h1>
                </div>
                <div class="flex justify-end">
                    <div class="flex cursor-pointer hover:bg-blue-100 m-2 p-3 rounded-full bg-slate-400 mr-6">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <div class="flex cursor-pointer hover:bg-blue-100 m-2 p-3 rounded-full bg-slate-400 mr-6">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </div>
            <!-- rest of the content -->
            <div id="main_content">
                <!-- rest of the content -->
                <div class="p-2">
                    <div class="flex grid-cols-4 justify-between m-2">
                        <div class="flex grid-rows-2 px-10 bg-yellow-200 rounded-xl shadow-lg">
                            <div class="flex-col items-center p-5 ">
                                <h1 class="font-bold text-5xl mb-0 text-center">
                                    <?php
                                    $q1 = 'SELECT count(*) as tot FROM courses_details';
                                    $result = mysqli_query($conn, $q1);
                                    $row = mysqli_fetch_array($result);
                                    echo $row['tot'];
                                    ?>
                                </h1>
                                <h2 class="font-bold text-lg mt-2">Total Courses</h2>
                            </div>
                            <div class="p-5 text-8xl items-center">
                                <i class="fa fa-book"></i>
                            </div>
                        </div>

                        <div class="flex grid-rows-2 px-10 bg-purple-200 rounded-xl shadow-lg">
                            <div class="flex-col items-center p-5 ">
                                <h1 class="font-bold text-5xl mb-0 text-center">
                                    <?php
                                    $q1 = 'SELECT count(*) as tot FROM std_enrolled';
                                    $result = mysqli_query($conn, $q1);
                                    $row = mysqli_fetch_array($result);
                                    echo $row['tot'];
                                    ?>
                                </h1>
                                <h2 class="font-bold text-lg mt-2">Total Enrolled</h2>
                            </div>
                            <div class="p-5 text-8xl items-center">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                        </div>

                        <div class="flex grid-rows-2 px-10 bg-blue-200 rounded-xl shadow-lg">
                            <div class="flex-col items-center p-5 ">
                                <h1 class="font-bold text-5xl mb-0 text-center">
                                    <?php
                                    $q1 = 'SELECT count(*) as tot FROM instructors';
                                    $result = mysqli_query($conn, $q1);
                                    $row = mysqli_fetch_array($result);
                                    echo $row['tot'];
                                    ?>
                                </h1>
                                <h2 class="font-bold text-lg mt-2">Total Instructors</h2>
                            </div>
                            <div class="p-5 text-8xl items-center">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </div>

                        <div class="flex grid-rows-2 px-10 bg-amber-200 rounded-xl shadow-lg">
                            <div class="flex-col items-center p-5 ">
                                <h1 class="font-bold text-5xl mb-0 text-center">
                                    <?php
                                        $tot_paid = "select sum(company) as total_paid from earning";
                                        $paid_res = $conn->query($tot_paid);
                                        $paid_row = $paid_res->fetch_assoc();
                                        echo '$' . $paid_row['total_paid'];
                                    ?>
                                </h1>
                                <h2 class="font-bold text-lg mt-2">Total Earning</h2>
                            </div>
                            <div class="p-5 text-8xl items-center">
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>

                    </div>

                    <!-- graph -->
                    <div class="container mx-auto mt-8">
                        <h1 class="text-2xl font-bold mb-4">Transaction Graph</h1>
                        <div class="w-full h-64 bg-white rounded-lg shadow-md p-4">
                            <canvas id="transaction-chart"></canvas>
                        </div>
                    </div>

                    <!-- Instructor paid -->
                    <div class="container mx-auto mt-8">
                        <h1 class="text-2xl font-bold mb-4">Paid to Instructor</h1>
                        <div class="w-full h-64 bg-white rounded-lg shadow-md p-4">
                            <canvas id="inst-trans"></canvas>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                </div>
            </div>
        </div>

        <script>
            const coursesListItem = document.querySelector(".course");
            const coursesSubMenu = document.querySelector(".course_sub");

            coursesListItem.addEventListener("click", () => {
                coursesSubMenu.classList.toggle("hidden");
            });

            const stdListItem = document.getElementById("std");
            const stdSubMenu = document.getElementById("std_sub");

            stdListItem.addEventListener("click", () => {
                stdSubMenu.classList.toggle("hidden");
            });

            $(document).ready(function() {
                $("#course_add").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "addcourse.html",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#course_view").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "allcourses.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#std_view").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "students.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#enrolled_std").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "enrolled.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#inst").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "instructor.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#earn").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "earning.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#add_admin").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    $.ajax({
                        url: "addAdmin.php",
                        success: function(result) {
                            $("#main_content").html(result);
                        }
                    });
                });
            });


            // graph
            // fetch transactions from the database and store them in a variable
    fetch('graph.php')
      .then(response => response.json())
      .then(transactions => {
        // create a canvas element for the chart
        const canvas = document.getElementById('transaction-chart');

        // create a new chart object using Chart.js
        const chart = new Chart(canvas, {
          type: 'bar',
          data: {
            labels: transactions.map(transaction => transaction.brought_on),
            datasets: [{
              label: 'Transaction Amount $',
              data: transactions.map(transaction => transaction.price),
              backgroundColor: '#2563EB'
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      });

      // fetch transactions from the database and store them in a variable
    fetch('graph.php')
      .then(response => response.json())
      .then(transactions => {
        // create a canvas element for the chart
        const canvas = document.getElementById('inst-trans');

        // create a new chart object using Chart.js
        const chart = new Chart(canvas, {
          type: 'bar',
          data: {
            labels: transactions.map(transaction => transaction.txid),
            datasets: [{
              label: 'Transaction Amount',
              data: transactions.map(transaction => transaction.inst_revenue),
              backgroundColor: '#FF8400'
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      });
        </script>
    </div>
</body>

</html>

<?php
} else {
    header("Location: admin.html");
    exit();
}
?>