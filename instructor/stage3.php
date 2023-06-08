<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Stage 3</title>
</head>

<body>

    <div class="stage flex items-center justify-center">
        <div class="w-1/2 bg-slate-200 p-4 rounded-lg mt-5">
            <h2 class="text-xl font-bold mb-5 text-center">Create Course (Stage 3)</h2>
            <div class="mb-6 flex items-center justify-center gap-x-2 p-2">
                <input type="submit" value="Upload Module Content" id="btn" class="bg-amber-300 px-4 py-2 font-semibold rounded-full hover:bg-yellow-200 cursor-pointer" onclick="getData('<?php echo $_GET['cid']; ?>'); this.disabled=true;">
            </div>
            <p class="flex justify-center italic text-red-500 font-semibold">Warning: Make sure you upload an intro video at module 0 [To get preview your student]</p>
            <div class="container mx-auto px-4 py-10">
                <form action="" method="" id="moduleForm">
                    <div class="module-here"></div>
                </form>
            </div>
        </div>
    </div>




    <script>
        let getCid = '';
        let getmodNum = '';

        function getData(cid) {
            // Create XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define function to handle response
            xhr.onload = function() {
                if (this.readyState == 4 && xhr.status === 200) {
                    // Parse JSON response
                    var data = JSON.parse(xhr.responseText);
                    // Update DOM with data
                    //console.log(data);
                    createModules(data[0].module, cid);
                    console.log(cid);

                } else {
                    console.log('Request failed. Returned status of ' + xhr.status);
                }
            };

            // Open connection to PHP script with cid parameter
            xhr.open('GET', 'data.php?cid=' + cid, true);

            // Send request
            xhr.send();
        }

        function createModules(modNum, cid) {
            let numOfModules = modNum;
            getCid = cid;
            getmodNum = modNum;

            // console.log(getCid);

            let form = document.getElementById('moduleForm');
            // Clear any previously generated form inputs
            // form.innerHTML = '';

            let parentDiv = document.createElement('div');
            parentDiv.classList.add('grid', 'grid-cols-3', 'gap-4', 'w-fit');

            for (let i = 0; i <= numOfModules; i++) {
                let moduleDiv = document.createElement('div');
                moduleDiv.classList.add('mb-6');

                let moduleLabel = document.createElement('label');
                moduleLabel.classList.add('block', 'text-gray-700', 'font-bold', 'mb-2');
                moduleLabel.textContent = `Module ${i}:`;

                let moduleNameInput = document.createElement('input');
                moduleNameInput.classList.add('shadow', 'appearance-none', 'border', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
                moduleNameInput.type = 'text';
                moduleNameInput.name = `module_name${i}`;
                moduleNameInput.placeholder = `Enter the name of module ${i}`;

                let moduleCodeInput = document.createElement('input');
                moduleCodeInput.classList.add('shadow', 'appearance-none', 'border', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline', 'mt-2');
                moduleCodeInput.type = 'text';
                moduleCodeInput.name = `module_code${i}`;
                moduleCodeInput.placeholder = `Enter the short description for module ${i}`;

                let moduleDescInput = document.createElement('textarea');
                moduleDescInput.classList.add('shadow', 'appearance-none', 'border', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline', 'mt-2');
                moduleDescInput.type = 'text';
                moduleDescInput.name = `module_desc${i}`;
                moduleDescInput.placeholder = `Enter the details description for module ${i}`;

                // added
                let moduleFileInput = document.createElement('input');
                moduleFileInput.classList.add('shadow', 'appearance-none', 'border', 'rounded-lg', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline', 'mt-2', 'bg-gray-100');
                moduleFileInput.type = 'file';
                moduleFileInput.name = `module${i}_file`;

                moduleDiv.appendChild(moduleLabel);
                moduleDiv.appendChild(moduleNameInput);
                moduleDiv.appendChild(moduleCodeInput);
                moduleDiv.appendChild(moduleDescInput);
                // added
                moduleDiv.appendChild(moduleFileInput);

                // Append the module div to the parent div
                parentDiv.appendChild(moduleDiv);
            }

            // Append the parent div to the body element or any other desired element
            form.appendChild(parentDiv);

            let btnDiv = document.createElement('div');
            btnDiv.classList.add('grid', 'justify-items-stretch');

            let submitButton = document.createElement('button');
            submitButton.classList.add('justify-self-center', 'bg-blue-500', 'hover:bg-blue-700', 'text-white', 'font-bold', 'py-2', 'px-4', 'rounded', 'focus:outline-none', 'focus:shadow-outline');
            submitButton.type = 'submit';
            submitButton.textContent = 'Submit';

            btnDiv.appendChild(submitButton);
            form.appendChild(btnDiv); // Append btnDiv to form

            // Get the module-here div and append the newly created form element to it
            let moduleHereDiv = document.querySelector('.module-here');
            //moduleHereDiv.appendChild(form);

            // Attach event listener to the form
            $('#moduleForm').submit(function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Get the form data
                var formData = new FormData($(this)[0]);
                formData.append('cid', getCid);
                formData.append('modNum', getmodNum);

                console.log(JSON.stringify(Object.fromEntries(formData)));

                // Send the AJAX request
                $.ajax({
                    url: 'moduleupload.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);

                        // Handle the response from the server
                        if (response.status === 'success' && response.message === 'Module uploaded successfully') {
                            // If the status is 'success', show the success message and clear the form:
                            alert("Form submitted successfully!");
                            $('#moduleForm')[0].reset();
                            window.location.href = "thankyou.html";
                        } else if (response.status === 'success' && response.message === 'Module already exists') {
                            alert("Module already exists");
                            $('#moduleForm')[0].reset();
                            window.location.href = "exists.html";
                        } else {
                            // If the status is anything other than 'success', show the failure message:
                            alert("Form submission failed.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

                        // Handle any errors that occur during the request
                        // alert("Error submitting form.");
                        $('#moduleForm')[0].reset(); //added
                        // window.location.href = "thankyou.html";
                        // $.ajax({
                        //     url: 'thankyou.html',
                        //     type: 'GET',
                        //     success: function(data) {
                        //         $('html').html(data);
                        //     },
                        //     error: function(xhr, status, error) {
                        //         console.log('Error reloading page: ' + error);
                        //     }
                        // });
                    }
                });
            });

        }
    </script>
</body>

</html>