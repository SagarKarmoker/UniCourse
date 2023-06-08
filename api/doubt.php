<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>UniCourse Doubt Solver</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
<!-- Navar Section -->
    <?php include '../nav.php'; ?>

    <div class="container mx-auto my-10 p-4 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-4 text-center">UniCourse Doubt Solver</h1>
        <div class="flex justify-center items-center">
            <textarea name="doubt-input" rows="8" cols="20" id="doubt-input" type="text"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none"
                placeholder="Enter your doubt..."></textarea>
            <p class="ml-2"><button id="start-button"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full mr-2"><i
                        class="fa-solid fa-microphone fa-beat"></i></button>
                <button id="stop-button"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full mt-2" hidden><i
                        class="fa-solid fa-microphone-slash"></i></button>
            </p>
            <button id="solve-button"
                class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Solve</button>
        </div>
        <div id="response-container" class="mt-4"></div>
    </div>

    <script>
        const solveButton = document.getElementById('solve-button');
        const doubtInput = document.getElementById('doubt-input');
        const responseContainer = document.getElementById('response-container');

        solveButton.addEventListener('click', () => {
            const doubt = doubtInput.value.trim();
	    document.querySelector("#stop-button").style.display = 'none';

            if (!doubt) {
                alert('Please enter a doubt.');
                return;
            }

            const apiKey = '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';
            const apiUrl = 'https://api.openai.com/v1/completions';

            const data = {
                // prompt: `I have a doubt about ${doubt}.`,
                prompt: `${doubt}`,
                model: 'text-davinci-003',
                temperature: 0.5,
                max_tokens: 500
            };

            fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${apiKey}`
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    const responseText = data.choices[0].text.trim();
                    console.log(responseText);
                    responseContainer.innerHTML = `<div class="bg-gray-200 p-4 rounded-lg">${responseText}</div>`;
                })
                .catch(error => {
                    console.error(error);
                    responseContainer.innerHTML = '<p class="text-red-500">An error occurred.</p>';
                });
        });


        // voice option
        const recognition = new window.webkitSpeechRecognition();

        recognition.continuous = true;
        recognition.lang = "en-US";
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        document.querySelector("#start-button").addEventListener("click", () => {
            document.querySelector("#doubt-input").value = "";
            document.querySelector("#stop-button").style.display = 'inline-flex';
            recognition.start();
            setTimeout(() => {
                recognition.stop();
		document.querySelector("#stop-button").style.display = 'none';
            }, 60000); // Stop after 60 seconds
        });

        document.querySelector("#stop-button").addEventListener("click", () => {
            recognition.stop();
            document.querySelector("#stop-button").style.display = 'none';
        });

        recognition.onresult = (event) => {
            const resultIndex = event.resultIndex;
            const transcript = event.results[resultIndex][0].transcript;

            document.querySelector("#doubt-input").value += transcript;
        };
    </script>
</body>

</html>