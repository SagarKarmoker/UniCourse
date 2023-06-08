<?php 
session_start();
include 'dbconfig.php';
// echo $_SESSION['instruct'];
if(isset($_SESSION['instruct'])){
    //echo 'Welcome, '.$_SESSION['instruct'].'!';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Create Assignment | UniCourse</title>
  </head>
  <body class="bg-gray-200">
    <form class="mx-auto max-w-md py-8" action="submit.php" method="post">
      <div class="mb-8 p-4 bg-gray-100 rounded-lg">
        <h2 class="mb-6 text-xl font-medium">Create Assignments (Course: <?php echo $_POST['cid'] ?>)</h2>
        <input type="hidden" name="cid" value="<?php echo isset($_POST['cid']) ? $_POST['cid'] : ''; ?>">
        <input type="text" name="num" id="mum" class="mb-4 w-full rounded-lg border border-gray-400 p-2 focus:border-blue-500 focus:outline-none" placeholder="Enter assignment number" />
        <input type="text" name="title" id="title" class="mb-4 w-full rounded-lg border border-gray-400 p-2 focus:border-blue-500 focus:outline-none" placeholder="Enter assignment title" />
        <textarea name="desc" id="desc" cols="30" rows="5" class="mb-4 w-full rounded-lg border border-gray-400 p-2 focus:border-blue-500 focus:outline-none" placeholder="Enter assignment details"></textarea>
        <input type="submit" value="Create Assignment" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg cursor-pointer focus:outline-none focus:shadow-outline-blue">
      </div>
    </form>


    <script type="text/javascript">
      const form = document.querySelector("form");
const cid = "<?php echo isset($_POST['cid']) ? $_POST['cid'] : ''; ?>";
  console.log(cid);

form.addEventListener("submit", (event) => {
  event.preventDefault();
  
  // Create a new FormData object
  const formData = new FormData(form);

  // Add the cid value to the FormData object
  // formData.append("cid", cid);

  // Convert the form data into a JSON object and log it to the console
  const jsonObject = {};
  formData.forEach((value, key) => { jsonObject[key] = value });
  console.log(JSON.stringify(jsonObject));

  fetch("submit.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      // Reset the form data
      form.reset();
      // Redirect to another page
      window.location.href = "dash.php";
    })
    .catch((error) => {
      console.log(error);
      // Reset the form data
      form.reset();
      // Redirect to another page
      alert("Assignment added successfully and your are redirecting to course page");
      window.location.href = "dash.php";
    }); 
});


    </script>
  </body>
</html>
<?php
} else {
    header("Location: login.html");
    exit();
}
?>