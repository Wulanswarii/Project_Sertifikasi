<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['role'] != 'dosen') {
    header("Location: ../../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$dosen = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT * FROM users 
WHERE id_user='$id_user'
"));

$totalMK = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM mata_kuliah 
WHERE id_dosen='$id_user'
"));

$totalTugas = mysqli_num_rows(mysqli_query($conn, "
SELECT tugas.*
FROM tugas
JOIN mata_kuliah ON tugas.id_mk = mata_kuliah.id_mk
WHERE mata_kuliah.id_dosen='$id_user'
"));

$tugasBelum = mysqli_num_rows(mysqli_query($conn, "
SELECT tugas.*
FROM tugas
JOIN mata_kuliah ON tugas.id_mk = mata_kuliah.id_mk
WHERE mata_kuliah.id_dosen='$id_user'
AND tugas.status='Belum Selesai'
"));
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>

    <link href="../../src/output.css" rel="stylesheet">

    <style>
        @keyframes float {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }

            100% {
                transform: translateY(0)
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }
    </style>

</head>

<body class="bg-gray-100">

    <?php include '../../component/sidebar.php'; ?>


    <div class="ml-64 p-10">

        <h1 class="text-2xl font-bold mb-8">
            Dashboard Dosen
        </h1>


        <!-- PROFIL -->
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition mb-10 flex items-center gap-5">

            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-700 text-white
                        flex items-center justify-center rounded-full text-2xl font-bold shadow-lg">

                <?= strtoupper(substr($dosen['nama'], 0, 1)) ?>

            </div>

            <div>

                <h2 class="text-lg font-semibold">
                    <?= $dosen['nama'] ?>
                </h2>

                <p class="text-gray-500 text-sm">
                    <?= $dosen['email'] ?>
                </p>

                <p class="text-gray-400 text-sm">
                    Role : Dosen
                </p>

            </div>

        </div>



        <!-- STATISTIK -->
        <div class="grid md:grid-cols-3 gap-6">



            <!-- Mata Kuliah -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-blue-500 to-blue-700
                        p-6 text-white
                        shadow-lg shadow-blue-300/40
                        transition duration-300
                        hover:shadow-xl hover:shadow-blue-400/60 hover:-translate-y-1">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-sm opacity-90">
                            Mata Kuliah Diajar
                        </p>

                        <p class="text-3xl font-bold">
                            <?= $totalMK ?>
                        </p>

                    </div>

                    <div class="bg-white/20 backdrop-blur-md p-3 rounded-xl shadow-inner float">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z" />

                        </svg>

                    </div>

                </div>

            </div>




            <!-- Total Tugas -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-green-500 to-green-700
                        p-6 text-white
                        shadow-lg shadow-green-300/40
                        transition duration-300
                        hover:shadow-xl hover:shadow-green-400/60 hover:-translate-y-1">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-sm opacity-90">
                            Total Tugas
                        </p>

                        <p class="text-3xl font-bold">
                            <?= $totalTugas ?>
                        </p>

                    </div>

                    <div class="bg-white/20 backdrop-blur-md p-3 rounded-xl shadow-inner float">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5h6M9 9h6M9 13h6" />

                        </svg>

                    </div>

                </div>

            </div>




            <!-- Tugas Belum -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-red-500 to-red-700
                        p-6 text-white
                        shadow-lg shadow-red-300/40
                        transition duration-300
                        hover:shadow-xl hover:shadow-red-400/60 hover:-translate-y-1">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-sm opacity-90">
                            Tugas Belum Selesai
                        </p>

                        <p class="text-3xl font-bold">
                            <?= $tugasBelum ?>
                        </p>

                    </div>

                    <div class="bg-white/20 backdrop-blur-md p-3 rounded-xl shadow-inner float">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </div>

                </div>

            </div>


        </div>


    </div>

</body>

</html>