<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment Gateway...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full animate-fade-in">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Processing your payment...</h2>
        <p class="text-gray-600 mb-6">Please wait while we securely redirect you to the Flutterwave payment page.</p>
        <div class="flex justify-center items-center">
            <!-- Simple spinner for loading indication -->
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        </div>
        <p class="text-sm text-gray-500">If you are not redirected automatically, please click the button below:</p>
        <button id="redirectButton"
            class="mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
            Go to Payment Page
        </button>
    </div>

    <script>
        const redirectUrl = "{{ $url }}"; // Get the URL passed from the controller
        console.log('Attempting to redirect to:', redirectUrl); // Log the URL for debugging

        // Function to show a custom message box instead of alert()
        function showMessage(message, type = 'error') {
            const messageBox = document.createElement('div');
            messageBox.className =
                `fixed top-4 right-4 p-4 rounded-md shadow-lg text-white ${type === 'error' ? 'bg-red-500' : 'bg-green-500'} z-50`;
            messageBox.innerHTML =
                `<div class="font-bold">${type === 'error' ? 'Error' : 'Success'}</div><div>${message}</div>`;
            document.body.appendChild(messageBox);
            setTimeout(() => {
                messageBox.remove();
            }, 5000); // Message disappears after 5 seconds
        }

        // Function to perform the redirect
        function redirectToPayment() {
            // Check if redirectUrl is a valid URL before attempting redirection
            try {
                new URL(redirectUrl); // Attempt to create a URL object to validate
                window.location.href = redirectUrl;
            } catch (e) {
                console.error('Invalid redirect URL detected:', redirectUrl, e);
                showMessage(
                    'An error occurred during redirection. The payment URL might be invalid. Please check your browser console for details.',
                    'error');
                document.getElementById('redirectButton').innerText = 'Redirection Failed. Invalid URL.';
                document.getElementById('redirectButton').disabled = true;
            }
        }

        // Automatically redirect after a short delay to allow UI to render
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(redirectToPayment, 2000); // Redirect after 2 seconds

            // Add click listener to the button for manual redirection
            document.getElementById('redirectButton').addEventListener('click', redirectToPayment);
        });
    </script>

    <style>
        /* Custom spinner animation */
        .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Fade-in animation for the card */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</body>

</html>
