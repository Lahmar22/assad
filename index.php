<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSAD | Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Welcome to ASSAD</h1>

        </div>

        <form action="controller/login.php" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                <input type="email" id="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                    placeholder="you@example.com" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                    placeholder="••••••••" required>
                <!-- <div class="flex justify-end mt-1">
                    <a href="#" class="text-xs text-indigo-600 hover:underline">Forgot password?</a>
                </div> -->
            </div>

            <button type="submit" 
                class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-200">
                Sign In
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Don't have an account? 
            <button onclick="toggleModal('signup-modal')" class="text-indigo-600 font-bold hover:underline">
                Sign up
            </button>
        </p>
    </div>

    <div id="signup-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div onclick="toggleModal('signup-modal')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" onclick="toggleModal('signup-modal')" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Create an Account
                            </h3>
                            <div class="mt-4">
                                <form action="controller/insciption.php" method="POST">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reg-name">Full Name</label>
                                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" name="reg-name" type="text" placeholder="John Doe">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reg-email">Email</label>
                                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" name="reg-email" type="email" placeholder="john@example.com">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reg-pass">Password</label>
                                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" name="reg-pass" type="password" placeholder="••••••••">
                                    </div>
                                    <div class="mb-4">  
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="reg-dateNaissance">Date Naissance</label>
                                        <input class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" name="reg-dateNaissance" type="date" >
                                    </div>
                                    
                                    <button type="submit" class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Sign Up
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalID){
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }
    </script>
</body>
</html>