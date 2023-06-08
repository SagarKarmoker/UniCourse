<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Instructor Dashboard | UniCourse</title>
</head>

<body>
    <div class="flex">
        <!-- sidebar left -->
        <div class="h-screen sticky top-0 bg-gray-100 p-5 pt-8">
            <div class="w-64 bg-gray-800 text-gray-100 flex flex-col">
                <div class="flex items-center justify-center h-16 px-4 mt-4">
                    <span class="text-white text-xl font-semibold">Instructor Dashboard</span>
                </div>
                <nav class="flex-grow px-4 py-8">
                    <a href="wel.php" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg"><i class="fa fa-home"></i> Dashboard</a>
                    <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg"><i class="fa fa-book"></i> Create Course</a>
                    <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg"><i class="fa-solid fa-chalkboard-user"></i> Classroom</a>
                    <a href="#" class="block mb-4 py-2 px-4 text-sm text-white hover:bg-gray-700 rounded-lg"><i class="fa-solid fa-graduation-cap"></i> View Students</a>
                </nav>
            </div>
        </div>
        <!-- right side -->
        <div class="w-full bg-slate-500">
            <!-- navbar -->
            <div class="flex sticky top-0 justify-between bg-slate-600">
                <header class="px-4 py-5 bg-white shadow border-b w-full">
                    <h1 class="text-lg font-bold">Course Instructor Dashboard</h1>
                </header>
                <div class="flex-grow">
                    <header class="px-4 py-5 bg-white shadow border-b w-full">
                        <h1 class="text-lg font-bold">Course Instructor Dashboard</h1>
                    </header>
                    <!-- main page -->
                    <div class="">
                        <main class="p-6">
                            <p class="text-xl font-semibold mb-4">Welcome to your dashboard!</p>
                            <p class="mb-4">Here you can manage your courses, track your students' progress, and more.</p>
                            <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Get Started</button>

                        </main>

                        <main class="flex-1 p-4">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold">My Courses</h2>
                                <button class="px-4 py-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                    Create Course
                                </button>
                            </div>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                <!-- course -->
                                <li class="bg-white border shadow-sm rounded-md p-4">
                                    <h3 class="font-bold text-lg mb-2">Course Name</h3>
                                    <p class="text-gray-700">Course Description</p>
                                    <a href="#" class="block mt-4 text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </li>
                                <!-- Repeat the above course card element for each course -->
                            </ul>
                        </main>
                    </div>

                    <!-- ajax content -->
                    <div class="main-content" id="main-content">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ajax code here -->
</body>

</html>