<?php
session_start();
include 'dbconfig.php';
$user = $_SESSION['username'];
// $cid = $_GET['cid'];

if (isset($_SESSION['username'])) {
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $rating = $_POST["rating"];
        $review = $_POST["review"];
        $cour = $_POST["cid"];

        $rid = 'rev'. rand(1000, 9999);

        // Insert review into database
        $sql = "INSERT INTO coursereview (rid, cid, Uid, rating, review) VALUES ('$rid', '$cour', '$user',  '$rating', '$review')";
        if ($conn->query($sql) === TRUE) {
            echo "Review submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}
else{
    echo 'error';
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Review Submit</title>
</head>

<body>
    <div class="bg-white shadow-md p-4 rounded-lg ml-[20%] mr-[20%] mt-[10%] border">
        <h2 class="text-xl font-semibold mb-2">Course Review (Course: CourseCode Here)</h2>
        <form class="space-y-4" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>">
            <div class="flex flex-col">
                <label for="rating" class="text-lg font-medium mb-1">Rating</label>
                <select id="rating" name="rating" class="border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 form-select w-full rounded-full p-2">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="review" class="text-lg font-medium mb-1">Review</label>
                <textarea id="review" name="review" rows="4" class="p-1 border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 form-textarea w-full rounded-lg" placeholder="Write your review here"></textarea>
            </div>
            <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg">Submit Review</button>
        </form>
    </div>

</body>

</html>