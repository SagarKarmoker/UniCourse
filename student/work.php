<?php
session_start();
include 'dbconfig.php';
if(isset($_SESSION['username']) && isset($_GET['cid'])){
  // echo 'Welcome, '.$_SESSION['username'].'!';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Course Work | UniCourse</title>
  </head>
  <body>
    <!-- ml-[30%] mr-[30%] -->
    <div class="ml-[10%] mr-[10%]">
      <div class="mt-4 grid auto-rows-auto gap-y-4">
        <!-- assignment div -->
        <?php
          $cid = $_GET['cid']; // get from post 
          // echo $cid;
          $modsql = "SELECT * FROM assign WHERE cid = '$cid'";
          $mod_result = $conn->query($modsql);
          $mod_row = $mod_result->fetch_assoc();

          $mod_json = $mod_row['assignments'];
          $mod_json .= ']';
          // print_r($mod_json);

          // Decode the JSON string into an associative array
          $array = json_decode($mod_json, true);

          // Check if the decoding was successful
          if ($array === null) {
              echo "Error decoding JSON: " . json_last_error_msg();
          } else {
              // Loop through the array and print each element
              $i = 1;
              foreach ($array as $elem) {
                  echo '
                  <div class="cursor-pointer rounded-lg bg-slate-300 p-3" id="show_assign" onclick="toggleAssignmentDiv('. $i .')">
                    <div class="inline-flex">
                      <h1 class="font-bold text-gray-700">Assignment ' . $i . ':</h1>
                      <h2 class="pl-2 text-base font-semibold">'. $elem['title'] .'</h2>
                    </div>
                    <div class="hidden items-center justify-between" id="assignment-div-'. $i .'">
                      <hr class="border-white my-1">
                      <div><span class="font-semibold">Description: </span>'. $elem['desc'] . '</div>
                      <div class="mt-1">
                        <input type="file" name="" id="" class="rounded-full border bg-white p-2 file:rounded-full file:border-0 file:bg-violet-50 file:p-1 file:font-bold file:text-violet-700 hover:file:bg-violet-100" />
                        <button type="submit" class="self-end rounded-full bg-blue-600 px-4 py-2 text-white">Submit</button>
                      </div>
                    </div>
                  </div>
                  ';
                  $i++;
              }
          }
        ?>
      </div>
    </div>

    <script>
      function toggleAssignmentDiv(id) {
          var divid = id;
          const assignmentDiv = document.getElementById("assignment-div-" + divid);
          assignmentDiv.classList.toggle("hidden");
      }
    </script>
  </body>
</html>
<?php
} else {
  header("Location: mycourse.php");
  exit();
}
?>