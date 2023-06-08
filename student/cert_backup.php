<?php
session_start();
if (isset($_SESSION['username']) && isset($_GET['cid'])) {
    // echo 'Welcome, '.$_SESSION['username'].'!';
    include 'dbconfig.php';
    $cid = $_GET['cid'];
    // echo $cid;

    $sql = "select course_name from courses_details where cid = '$cid'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();

    $course_name = $row['course_name'];
    // echo $course_name;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>JavaScript Certificate Generator</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Include html2canvas Library -->
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <!-- Include Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Custom styles -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #F3F4F6;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .certificate {
                position: relative;
                overflow: hidden;
                border-radius: 10px;
                box-shadow: 0 0 40px rgba(0, 0, 0, .05);
                background-color: #fff;
                width: 700px;
                max-width: 100%;
                margin: 20px;
                padding: 20px;
                text-align: center;
            }

            .certificate__title {
                margin-bottom: 15px;
                font-size: 32px;
                font-weight: 700;
                color: #000;
                text-transform: uppercase;
            }

            .certificate__recipient {
                margin-top: 10px;
                font-size: 20px;
                font-weight: 700;
                color: #000;
            }

            .certificate__course {
                margin-top: 16px;
                font-size: 20px;
                color: #000;
            }

            .certificate__date {
                margin-top: 5px;
                font-size: 12px;
                color: #000;
            }

            .certificate__id {
                margin-top: 5px;
                font-size: 12px;
                color: #000;
            }

            .certificate__logo {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                /* opacity: 0.15; */
            }

            .btn {
                display: inline-block;
                background-color: #1E3A8A;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #1C2D63;
            }

            .transparent {
                opacity: 0.5;
            }
        </style>
    </head>

    <?php
    // include 'dbconfig.php';
    $id = $_SESSION['username'];
    $sql = "select Fname, Lname from userdetails where Uid = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row['Fname'] . ' ' . $row['Lname'];
    // echo $name;

    $gen_id = uniqid();

    ?>

    <body>
        <!-- Certificate Template -->
        <div class="mt-8">
            <div id="certificate-template" class="certificate">
                <img src="bg-cert.png" alt="Certificate Background Image" class="certificate__logo">
                <div class="p-14 mb-14 transparent">
                    <h1 class="certificate__title text-slate-950">Certificate of Completion</h1>
                    <p>This is to certify that</p>
                    <h2 id="recipient-name" class="certificate__recipient"><?php echo $name ?></h2>
                    <p>has successfully completed the course</p>
                    <h3 id="course-name" class="certificate__course"><?php echo $course_name ?></h3>
                    <p class="certificate__date">Issued on: <span id="issue-date"></span></p>
                    <p class="certificate__id">Certificate ID: <span id="cert_id"></span><?php echo $gen_id ?></p>
                </div>
            </div>

            <button id="download-btn" onclick="generateCertificate()" class="btn mx-4">Download Certificate</button>

        </div>

        <script>
            function generateCertificate() {

                <?php
                $uid = $_SESSION['username'];
                $cert = "insert into certificate (cid, uid, cert_id) values ('$cid', '$uid', '$gen_id')";
                $conn->query($cert);
                ?>
                
                // Get Certificate Template HTML Element
                var certificateTemplate = document.getElementById('certificate-template');

                // Get Recipient Name and Course Name Elements
                var recipientName = document.getElementById('recipient-name');
                var courseName = document.getElementById('course-name');

                // Set Recipient Name and Course Name
                recipientName.innerHTML = '<?php echo $name ?>';
                courseName.innerHTML = '<?php echo $course_name ?>';

                // Get Issue Date Element
                var issueDate = document.getElementById('issue-date');

                // Set Issue Date
                issueDate.innerHTML = (new Date()).toLocaleDateString();

                // Create PDF from Certificate Template Element
                var options = {
                    orientation: 'landscape'
                };
                html2pdf().set(options).from(certificateTemplate).save('certificate.pdf');
            }
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: ../login.html");
    exit();
}
?>