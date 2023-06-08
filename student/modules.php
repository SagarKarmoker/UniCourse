<?php
include 'dbconfig.php';
include 'bunny-stream.php';
$cid = $_GET['cid'];
// echo $cid;
session_start();
if (isset($_SESSION['username'])) {
    // echo 'Welcome, '.$_SESSION['username'].'!';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Modules | UniCourse</title>
    </head>

    <body>
        <div class="mt-4 mb-6">

      <div class="">
        <!-- main_content -->
        <div id=""> 
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-4 rounded-lg">

          <div class="mt-4 h-fit">

            <div class="h-40 flex justify-end">

              <img src="bg.png" alt="" >

            </div>

            <?php 
                $sql = "select * from courses_details where cid = '$cid'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
            ?>

            <h2 class="font-bold text-4xl text-white h-fit mt-4"><?php echo $row['course_name'] . ' (' . $row['cid'] . ')' ?></h2>
            <button class="p-2 bg-blue-400 rounded-lg m-2 text-white font-bold inline-flex" id="classwork" data-cid="<?php echo $cid; ?>">Assignments</button>

          </div>

        </div>
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
            $j = 0;

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
                      <p>Description: ' . $array[$i]['module_desc' . $j] . '</p>';
                //module video
                $videoId = $array[$i]['guid' . $j];
                $expiration = time() + 3600; // Set expiration time to one hour from now
                $token_auth_key = "e606e1f7-50a5-4299-9a78-7f9e9e421f51";
                $token = hash('sha256', $token_auth_key . $videoId . $expiration); // Generate token
                $videoUrl = "https://iframe.mediadelivery.net/embed/118150/$videoId?token=$token&expires=$expiration";

                $html .= '<div class="flex justify-center item-center">
                        <div style="position: relative; padding-top: 1%;">
                        <iframe src="' . $videoUrl . '" loading="lazy" style="border: none;" class= "h-fit w-fit rounded" allow="accelerometer; gyroscope; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>
                        </div>
                    </div>';
                // module video end here
                $html .= ' <div class="flex justify-end item-end">
                        <button type="submit" class="p-2 bg-blue-400 rounded-lg m-2 text-white font-bold">Mark as complete</button>
                        </div>
                        </div>
                    </div>
                  </div>';
                $j++;
            }
            $html .= '</div></div>';

            // Output the generated HTML code
            echo $html;
            ?>

            <div class="flex justify-end item-end mt-2 gap-x-4">
                <button type="submit" class="bg-blue-400 p-2 rounded-lg text-white font-bold" id="gen" data-cid="<?php echo $cid; ?>">Get Certificate</button>
                <button type="submit" class="bg-yellow-400 p-2 rounded-lg text-white font-bold" id="review" data-cid="<?php echo $cid; ?>">Submit Review</button>
            </div>
        </div>


        <script>
            const parentEl = document.body;
            parentEl.addEventListener("click", function(event) {
                if (event.target.classList.contains("toggle-btn")) {
                    const targetId = event.target.dataset.target;
                    const targetDiv = document.getElementById(targetId);
                    targetDiv.classList.toggle("hidden");
                }
            });

            $(document).ready(function() {
                $("#gen").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    var cid = $(this).data('cid'); // Get the 'cid' value from the button
                    console.log(cid);
                    $.ajax({
                        url: "gen.php?cid=" + encodeURIComponent(cid),
                        method: "GET"
                    }).done(function(response) {
                        console.log(response); // Log the response for debugging purposes
                        window.location.href = "gen.php?cid=" + cid;
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("AJAX error:", textStatus, errorThrown);
                        alert("Certificate generation failed.");
                    });
                });
            });

              $(document).ready(function() {
              $("#classwork").click(function(e) {
                e.preventDefault(); // Prevent the default behavior of the link
                var cid = $(this).attr('data-cid'); // Get the 'cid' value from the button
                console.log(cid);
                $.ajax({
                  url: "work.php?cid=" + encodeURIComponent(cid),
                  method: "GET"
                }).done(function(response) {
                  console.log(response); // Log the response for debugging purposes
                  $("#main_content").html(response);
                  // window.location.href = "work.php?cid=" + cid;
                }).fail(function(jqXHR, textStatus, errorThrown) {
                  console.log("AJAX error:", textStatus, errorThrown);
                  // alert("Certificate generation failed.");
                });
              });
            });

            $(document).ready(function() {
                $("#review").click(function(e) {
                    e.preventDefault(); // Prevent the default behavior of the link
                    var cid = $(this).data('cid'); // Get the 'cid' value from the button
                    console.log(cid);
                    $.ajax({
                        url: "review.php?cid=" + encodeURIComponent(cid),
                        method: "GET"
                    }).done(function(response) {
                        console.log(response); // Log the response for debugging purposes
                        $("#main_content").html(response);
                        // window.location.href = "review.php?cid=" + cid;
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("AJAX error:", textStatus, errorThrown);
                        alert("Review Submit failed.");
                    });
                });
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: ../login.html");
    exit();
}
?>