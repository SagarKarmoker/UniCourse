<?php

include 'dbconfig.php';

$cid = $_GET['cid'];

if(isset($_GET['cid'])){

$url = "course.php?cid=" . $cid;



// $sql = "select mid from modules_details where cid='$cid'";

// $result = $conn->query($sql);

// $row = $result->fetch_assoc();



// echo $row['mid'];



// Course details here 

$course_sql = "select * from courses_details where cid = '$cid'";

$cour = $conn->query($course_sql);

$co_row = $cour->fetch_assoc();



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- <script src="course.js"></script> -->

    <!-- <link rel="stylesheet" href="/dist/output.css"> -->

    <title><?php echo $co_row['course_name'] . ' | UniCourse'?></title>

</head>



<body>

    <div class="bg-[#ffffff]">

        <?php

        $c1 = 'cyan';

        $c2 = 'purple';

        $c3 = 'indigo';

        $c4 = 'sky';

        $c5 = 'emerald';

        $c6 = 'maroon';

        $c7 = 'violet';

        $colors = array($c1, $c2, $c3, $c4, $c5, $c6, $c7);



        $random_keys = array_rand($colors, 2);

        $random_color_1 = $colors[$random_keys[0]];

        $random_color_2 = $colors[$random_keys[1]];

        ?>

        <div class="grid grid-cols-3 p-4 text-white bg-gradient-to-r from-<?php echo $random_color_1?>-500 to-<?php echo $random_color_2?>-500">

            <div class="col-span-2 p-4 ml-40">

                <h2 class="font-bold text-3xl pb-2">

                    <?php echo $co_row['course_name']; ?>

                </h2>

                <!-- course details -->

                <p class="font-semibold pb-2"><?php echo $co_row['description']; ?></p>

                <div class="rating flex mt-2">

                    <label for="">4.9</label>

                    <i class="fa-solid fa-star"></i>

                    <i class="fa-solid fa-star"></i>

                    <i class="fa-solid fa-star"></i>

                    <i class="fa-solid fa-star"></i>

                    <i class="fa-solid fa-star-half-stroke"></i>

                </div>

                <p class=""><?php echo 'UPDATE HERE' ?> Total student</p>

                <p class="mt-2 font-bold">Created by <?php echo $co_row['instructor_name']; ?></p>

                <p class="mt-2">Last updated <?php echo $co_row['created']; ?> English</p>

                <button class="bg-[#ffe357] hover:bg-yellow-200 p-3 rounded-md font-bold w-3/2 mt-2 text-black">Enroll

                    Now</button>

                <a href="" class="mt-2 flex justify-start underline hover:text-black">Financial aid available</a>

            </div>

            <div class="p-4 flex justify-center mr-40">

                <?php

                echo '<img src="data:image/png;base64,' . base64_encode($co_row['thumbnail']) . '" class="rounded-xl" />';

                ?>

                <!-- <img src="https://www.python.org/static/community_logos/python-logo-master-v3-TM-flattened.png" alt="" class="rounded-xl"> -->

            </div>

        </div>



        <div class="p-4 grid grid-cols-4 gap-x-4 ml-44 mr-44">

            <!-- what will learn -->

            <div class="col-span-3">

                <div class="border p-4 shadow-sm rounded-xl h-fit">

                    <div class="grid grid-cols-2">

                        <div>

                            <h1 class="font-bold text-2xl p-2">What you'll learn</h1>

                            <div class="grid grid-cols-2 gap-x-2 pl-2">

                                <?php

                                $json = $co_row['whatlearn'];

                                // Decode the JSON data into a PHP associative array

                                $data = json_decode($json, true);



                                // Loop through the array to access each key-value pair

                                foreach ($data as $key => $value) {

                                    echo "<p>✔ {$value}</p>";

                                }

                                ?>

                                <!-- <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p>

                                <p>✔ Create their own Python Programs</p> -->

                            </div>

                        </div>

                        <div class="flex justify-center">

                            <?php

                            echo '<img src="data:image/png;base64,' . base64_encode($co_row['thumbnail']) . '" class="rounded-xl" />';

                            ?>

                            <!-- <img src="https://www.python.org/static/community_logos/python-logo-master-v3-TM-flattened.png" alt="" class="rounded-xl"> -->

                        </div>

                    </div>

                </div>



                <!-- About -->

                <div class="p-4 h-fit mt-4">

                    <div class="w-2/3 p-2">

                        <h1 class="font-medium text-2xl underline">About this Course</h1>

                        <p class="mt-2">

                            <?php

                            echo $co_row['about'];

                            ?>

                        </p>

                    </div>

                </div>



                <div class="p-4 h-fit mt-4 rounded-lg border shadow-sm">

                    <div>

                        <h1 class="uppercase text-zinc-600 font-bold p-2">SKILLS YOU WILL GAIN</h1>

                        <div class="grid grid-cols-5">

                            <?php

                            $tag = $co_row['whatlearn'];

                            // Decode the JSON data into a PHP associative array

                            $tag_data = json_decode($tag, true);



                            // Loop through the array to access each key-value pair

                            foreach ($tag_data as $key => $value) {

                                echo "<h1 class='bg-slate-200 m-2 text-center p-0.5 rounded-full'>{$value}</h1>";

                            }

                            ?>

                            <!-- <h1 class="bg-slate-200 m-2 text-center p-0.5 rounded-full">Tag 1</h1>

                            <h1 class="bg-slate-200 m-2 text-center p-0.5 rounded-full">Tag 2</h1>

                            <h1 class="bg-slate-200 m-2 text-center p-0.5 rounded-full">Tag 3</h1>

                            <h1 class="bg-slate-200 m-2 text-center p-0.5 rounded-full">Tag 4</h1>

                            <h1 class="bg-slate-200 m-2 text-center p-0.5 rounded-full">Tag 5</h1> -->

                        </div>

                    </div>

                </div>



                <!-- instrcutor -->

                <div class="p-4 h-fit mt-4">

                    <div class="p-2">

                        <h1 class="font-semibold text-xl">Instructors</h1>

                        <h2 class="mt-4 font-extrabold text-lg underline text-purple-500"><?php echo $co_row['instructor_name']; ?></h2>

                        <h3 class="font-medium text-slate-400">

                            <?php

                            $in = "SELECT profession FROM instructors WHERE instructor_id = '" . $co_row['instructor_id'] . "'";

                            $i = $conn->query($in);

                            $row_i = $i->fetch_assoc();

                            echo $row_i['profession'];

                            ?>

                        </h3>



                        <div class="grid grid-rows-4 grid-flow-col gap-2 w-fit mt-4">

                            <div class="row-span-4">

                                <div class="rounded-full w-fit">

                                    <?php

                                    echo '<img src="data:image/png;base64,' . base64_encode($co_row['instructor_img']) . '"class="rounded-full" />';

                                    ?>

                                </div>

                            </div>

                            <div class="col-span-2 inline-flex pl-2">

                                <i class="fa-solid fa-star pr-1 pt-1"></i>

                                <p>4.3 Instructor Rating</p>

                            </div>

                            <div class="col-span-2 inline-flex pl-2">

                                <i class="fa-solid fa-stamp pr-1 pt-1"></i>

                                <p>1000 Review</p>

                            </div>

                            <div class="col-span-2 inline-flex pl-2">

                                <i class="fa-solid fa-user pr-1 pt-1"></i>

                                <p>1000 Students</p>

                            </div>

                            <div class="col-span-2 inline-flex pl-2">

                                <i class="fa-solid fa-circle-play pr-1 pt-1"></i>

                                <p>

                                    <?php

                                    $count = "SELECT COUNT(*) as total FROM courses WHERE instructor_id = '" . $co_row['instructor_id'] . "'";

                                    $res = $conn->query($count);

                                    $r = $res->fetch_assoc();

                                    echo $r['total'] . ' courses';

                                    ?>

                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- content here -->

                <div class="border p-4 shadow-md rounded-xl h-fit mt-4">

                    <h1 class="text-2xl text-center font-semibold pb-2">Syllabus - What you will learn from this course</h1>

                    <hr>

                    <?php

                    $modsql = "select * from modules_details where cid = '$cid'";

                    $mod_result = $conn->query($modsql);

                    $mod_row = $mod_result->fetch_assoc();



                    $mod_json = $mod_row['module_data'];

                    // print_r($mod_json);



                    $array = json_decode($mod_json, true);

                    // print_r($array);



                    $size = count($array);

                    $j = 1;



                    $html = '';



                    $html .= '<div class="grid grid-cols-4 mt-2">

                                <div class="col-span-1">

                                <h1 class="text-3xl p-2 text-center uppercase">Course content</h1>

                                </div>

                                <div class="grid-flow-row col-span-3 w-full">';

                    for ($i = 0; $i < $size; $i++) {

                        $html .= '<div class="border rounded-md p-2 mt-2" >

                    <div class="grid h-fit ">

                      <h1 class="font-bold text-lg toggle-btn cursor-pointer" data-target="div' . $j . '">Module ' . $j . ': ' . $array[$i]['module_name' . $j] . ' <i class="fa-solid fa-angle-down font-extrabold ml-4"></i></h1>

                      <p>' . $array[$i]['module_code' . $j] . '</p>

                      <div id="div' . $j . '" class="hidden">

                      <hr class="pt-2">

                      <!-- update course video -->

                      <a href="google.com">google</a>

                      <a href="google.com">google2</a>

                      <a href="google.com">google3</a>

                      <a href="google.com">google4</a>

                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel voluptas, accusantium aspernatur possimus soluta, temporibus, libero repudiandae nobis atque nostrum debitis? Illo neque sunt blanditiis quibusdam, expedita quo quam maiores?

                        </div>

                    </div>

                  </div>';

                        $j++;

                    }

                    $html .= '</div></div>';



                    // Output the generated HTML code

                    echo $html;

                    ?>



                </div>



                <!-- extra -->

                <div class="border p-4 shadow-lg rounded-xl h-fit mt-4">

                    <h2 class="italic text-2xl font-bold p-2 underline">Some Other Courses from this instructor</h2>

                    <?php

                    $sql = "SELECT * FROM courses_details where instructor_id = '" . $co_row['instructor_id'] . "'";

                    $result = $conn->query($sql);

                    // $row = $result->fetch_assoc();

                    echo '<script src="https://cdn.tailwindcss.com"></script>';

                    echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 h-3/2">';

                    if (mysqli_num_rows($result) > 0) {

                        // Output data of each row

                        while ($row = mysqli_fetch_assoc($result)) {

                            // echo $row['cid'];

                            echo '<div class="bg-white shadow-lg border rounded-lg overflow-hidden">';

                            echo '<img class="w-full h-48 object-scale-down object-center"

                                                        src="data:image/png;base64,' . base64_encode($row['thumbnail']) . '" alt="Course Image">';

                            echo '<div class="px-6 py-4">';

                            echo '<h3 class="text-lg font-bold text-gray-800 mb-2"> ' . $row['course_name'] . '</h3>';

                            echo '<p class="text-gray-600">' . $row['description'] . '</p>';

                            echo '</div>';

                            echo '<div class="mt-4 flex justify-between px-6 py-4">';

                            echo '<button class="bg-gray-500 text-white text-bold p-2 justify-center rounded-lg font-bold" onclick="redirectToPage(\'' . $row['cid'] . '\')">View Course Details</button>';

                            echo '<a href="#" class="bg-indigo-700 text-white text-bold p-2 justify-center mr-2 rounded-lg font-bold">Enroll Now</a>';

                            echo '</div>';

                            echo '</div>';

                        }

                    } else {

                        echo "0 results";

                    }

                    echo '</div>';

                    ?>

                </div>



            </div>



            <!-- price section -->

            <div class="relative">

                <div class="sticky top-5 bg-indigo-500 text-white p-4 border rounded-lg shadow-xl h-fit">

                    <h2 class="font-bold text-3xl pb-2 text-center"><?php echo $co_row['course_name']; ?></h2>

                    <div class="flex justify-center">

                        <?php

                        // https://docs.bunny.net/docs/stream-embed-token-authentication

                        $token_auth_key = "6915dfba-77de-46ad-b658-7e4b76cfe130";

                        $videoId = '5398b9d3-431d-4ce8-b962-5f075834842b';

                        $expiration = time() + 20; // Set expiration time to one hour from now



                        $token = hash('sha256', $token_auth_key . $videoId . $expiration); // Generate token



                        // Add token and expiration to query string of the video URL

                        $videoUrl = 'https://iframe.mediadelivery.net/embed/109241/' . $videoId . '?token=' . $token . '&expires=' . $expiration;



                        ?>

                        <iframe width="320" height="220" src="<?php echo $videoUrl; ?>" title="<?php echo $co_row['course_name']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="rounded-xl w-full"></iframe>

                    </div>

                    <div class="">

                        <div class="price p-4">

                            <h1 class="font-bold text-3xl"><?php echo '$ ' . $co_row['price'] . '.00'; ?></h1>

                            <button class="bg-blue-600 p-3 rounded-full font-bold w-full mt-2 hover:bg-blue-500 hover:transition-shadow">Enroll

                                Now</button>

                            <a href="" class="mt-2 flex justify-end underline">Audit Course</a>

                            <div class="flex">

                                <i class="fa-regular fa-calendar w-fit h-fit pr-2 text-2xl"></i>

                                <i class=""></i>

                                <div class="grid grid-rows-2">

                                    <h1 class="font-semibold text-xl">Flexible deadlines</h1>

                                    <p>Reset deadlines in accordance to your schedule.</p>

                                </div>

                            </div>

                            <div class="flex mt-2">

                                <i class="fa-solid fa-certificate w-fit h-fit pr-2 text-2xl"></i>

                                <div class="grid grid-rows-2">

                                    <h1 class="font-semibold text-xl">Shareable Certificate</h1>

                                    <p>Earn a Certificate upon completion</p>

                                </div>

                            </div>

                            <div class="flex mt-2">

                                <i class="fa-solid fa-signal w-fit h-fit pr-2 text-2xl"></i>

                                <div class="grid grid-rows-2">

                                    <h1 class="font-semibold text-xl mb-0">100% online</h1>

                                    <p>Start instantly and learn at your own schedule.</p>

                                </div>

                            </div>

                            <div class="flex mt-2 mb-2">

                                <i class="fa-solid fa-ranking-star w-fit h-fit pr-2 text-2xl"></i>

                                <h1 class="font-semibold text-xl"><?php echo $co_row['course_level']; ?> Level</h1>

                            </div>

                            <div class="flex">

                                <i class="fa-solid fa-hourglass-end w-fit h-fit pr-4 text-2xl"></i>

                                <h1 class="font-semibold text-xl">Approx. <?php echo $co_row['duration']; ?> hours to complete</h1>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="border p-4 bg-gray-100 h-fit mt-4">

        <div class="bg-gray-100 py-20">

            <div class="container mx-auto px-4">

                <h2 class="text-3xl font-bold mb-8">Student Reviews</h2>

                <div class="flex flex-wrap -mx-4">

                    <?php

                        $getReview = "SELECT * FROM coursereview natural join userdetails WHERE cid = '" . $co_row['cid'] . "' LIMIT 3";

                        $result = mysqli_query($conn, $getReview);

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '<div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">

                                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">

                                    <p class="text-gray-700 text-base leading-relaxed mb-4">"' . $row['review'] . '"</p>

                                    <div class="flex items-center">

                                        <img src="https://i.pravatar.cc/50?img=' . rand(1,70) . '" alt="Avatar" class="rounded-full mr-4">

                                        <div>

                                            <h3 class="text-lg font-medium mb-2">' . $row['Fname'] . ' ' . $row['Lname'] . '</h3>

                                            <span class="text-gray-600 text-sm">' . $row['Profession'] . '</span>

                                        </div>

                                    </div>

                                </div>

                            </div>';

                        }

                    ?>

                </div>

            </div>

        </div>



    </div>



    <div class="grid grid-cols-2 mt-12 mb-12">

        <div class="ml-44 p-2 pl-14">

            <h1 class="text-2xl font-semibold mb-2">Start Learning Today</h1>

            <div class="grid-rows-auto">

                <p>✔ Taught by top companies and universities</p>

                <p>✔ Affordable programs</p>

                <p>✔ Apply your skills with hands-on projects</p>

                <p>✔ Learn on your own schedule</p>

                <p>✔ Course videos and readings</p>

                <p>✔ Graded quizzes and assignments</p>

                <p>✔ No degree or experience required for many programs</p>

                <p>✔ Shareable Certificate upon completion</p>

                <button class="bg-blue-600 hover:bg-yellow-200 p-3 rounded-md font-bold w-3/2 mt-4 text-white p-2 rounded-full">Enroll

                    Now</button>

            </div>

        </div>

        <div class="mr-44 p-2">

            <div class="grid-rows-auto">

                <h2>Shareable on <span class="font-semibold text-2xl">LinkedIn</span></h2>

                <img src="cert.png" alt="" class="h-64 pb-2">

                <p class="w-1/2">You can share your Certificate in the Certifications section of your LinkedIn profile, on printed resumes, CVs, or other documents.</p>

            </div>

        </div>







        <!-- js code -->

        <script>

            const parentEl = document.body;

            parentEl.addEventListener("click", function(event) {

                if (event.target.classList.contains("toggle-btn")) {

                    const targetId = event.target.dataset.target;

                    const targetDiv = document.getElementById(targetId);

                    targetDiv.classList.toggle("hidden");

                }

            });



            function redirectToPage(cid) {

                // Create a new XMLHttpRequest object

                var xhttp = new XMLHttpRequest();



                // Define the function to handle the AJAX response

                xhttp.onreadystatechange = function() {

                    if (this.readyState == 4 && this.status == 200) {

                        // Redirect the user to the specified page

                        const url = "course.php?cid=" + cid;

                        window.location.href = url;

                    }

                };



                // Build the AJAX request

                const url = "course.php?cid=" + cid;

                xhttp.open("GET", url, true);



                // Send the AJAX request

                xhttp.send();

            }

        </script>

</body>



</html>

<?php
}
else{
    header("Location: dash.php");
    exit();
}
?>