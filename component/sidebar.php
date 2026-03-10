<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="w-64 h-screen bg-white shadow-xl fixed flex flex-col overflow-y-auto">

    <!-- Logo + Title -->
    <div class="p-6 flex flex-col items-center text-center gap-2">

        <img src="../../assets/logo.png" class="h-14">

        <p class="text-sm font-semibold text-gray-700 leading-tight">
            Sistem Monitoring<br>Tugas
        </p>

    </div>


    <!-- Menu -->
    <ul class="mt-6 space-y-1 flex-1 px-4">

        <!-- Dashboard -->
        <li>
            <a href="../dosen/dashboard.php"

                class="flex items-center gap-3 px-4 py-3 rounded-lg
            text-black font-medium

            transition-all duration-200
            hover:bg-gray-100 hover:border-r-4 hover:border-blue-500

            <?= ($current_page == 'dashboard.php') ? 'border-r-4 border-blue-500' : '' ?>">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-black"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 13h8V3H3v10zM13 21h8v-6h-8v6zM13 3v6h8V3h-8zM3 21h8v-4H3v4z" />

                </svg>

                Dashboard
            </a>
        </li>


        <!-- Data Tugas -->
        <li>
            <a href="../dosen/tugas.php"

                class="flex items-center gap-3 px-4 py-3 rounded-lg
            text-black font-medium

            transition-all duration-200
            hover:bg-gray-100 hover:border-r-4 hover:border-blue-500

            <?= ($current_page == 'tugas.php') ? 'border-r-4 border-blue-500' : '' ?>">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-black"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5h6M9 9h6M9 13h6M5 5h.01M5 9h.01M5 13h.01" />

                </svg>

                Data Tugas
            </a>
        </li>

    </ul>


    <!-- Logout -->
    <div class="p-4 mt-auto">

        <a href="../../logout.php"

            class="flex items-center justify-center gap-2
                    bg-gradient-to-r from-red-500 to-red-700
                    text-white py-2.5 rounded-xl font-medium

                    shadow-md shadow-red-300/40
                    transition-all duration-300

                    hover:shadow-lg hover:shadow-red-400/60
                    hover:-translate-y-[2px]">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7" />

            </svg>

            Logout

        </a>

    </div>

</div>