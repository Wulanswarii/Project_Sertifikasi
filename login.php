<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Sistem Monitoring Tugas</title>

    <link href="src/output.css" rel="stylesheet">

</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200">

    <!-- Container -->
    <div class="login-card opacity-0 translate-y-8 scale-95

                bg-white/80 backdrop-blur-xl
                shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                border border-gray-200/60
                rounded-3xl

                p-12
                w-[420px]

                transition-all duration-700">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Login Sistem
        </h2>

        <p class="text-center text-gray-500 text-sm mb-8">
            Sistem Monitoring Tugas
        </p>

        <form action="proses_login.php" method="POST">

            <!-- Email -->
            <div class="mb-6">

                <label class="block text-sm text-gray-600 mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email..."
                    required

                    class="
                            w-full
                            bg-gray-50
                            rounded-xl
                            px-4 py-3

                            outline-none

                            transition-all duration-300

                            hover:ring-2 hover:ring-blue-200
                            focus:ring-2 focus:ring-blue-400

                            focus:bg-white
                            focus:shadow-md
                            focus:shadow-blue-200/30
                            ">

            </div>


            <!-- Password -->
            <div class="mb-8">

                <label class="block text-sm text-gray-600 mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password..."
                    required

                    class="
                            w-full
                            bg-gray-50
                            rounded-xl
                            px-4 py-3

                            outline-none

                            transition-all duration-300

                            hover:ring-2 hover:ring-blue-200
                            focus:ring-2 focus:ring-blue-400

                            focus:bg-white
                            focus:shadow-md
                            focus:shadow-blue-200/30
                            ">

            </div>


            <!-- Button Login -->
            <button

                class="
                        w-full
                        bg-gradient-to-r from-blue-500 to-blue-700
                        text-white
                py-3
                rounded-xl
                font-medium

                transition-all duration-300 ease-in-out

                hover:from-blue-600
                hover:to-blue-800
                hover:shadow-lg
                hover:shadow-blue-300/40
                hover:-translate-y-[2px]

                focus:outline-none
                focus:ring-2
                focus:ring-blue-400
                focus:ring-offset-2

                active:scale-95
                ">

                Login

            </button>

        </form>

    </div>


    <!-- Animasi Page Load -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const card = document.querySelector(".login-card");

            setTimeout(() => {

                card.classList.remove("opacity-0", "translate-y-8", "scale-95");

            }, 200);

        });
    </script>

</body>

</html>