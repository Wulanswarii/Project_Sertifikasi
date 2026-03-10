<?php
session_start();
require '../../config/config.php';

/* PROTEKSI LOGIN */
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

/* PROTEKSI ROLE MAHASISWA */
if ($_SESSION['role'] != 'mahasiswa') {
    header("Location: ../../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$mahasiswa = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
$mhs = mysqli_fetch_assoc($mahasiswa);

$semester = $mhs['semester'];

/* TOTAL TUGAS */
$totalTugas = mysqli_num_rows(mysqli_query($conn, "
SELECT tugas.id_tugas
FROM tugas
JOIN mata_kuliah ON tugas.id_mk = mata_kuliah.id_mk
WHERE mata_kuliah.semester='$semester'
"));

/* TUGAS SELESAI */
$tugasSelesai = mysqli_num_rows(mysqli_query($conn, "
SELECT pengumpulan_tugas.id_pengumpulan
FROM pengumpulan_tugas
JOIN tugas ON pengumpulan_tugas.id_tugas = tugas.id_tugas
JOIN mata_kuliah ON tugas.id_mk = mata_kuliah.id_mk
WHERE pengumpulan_tugas.id_user='$id_user'
AND mata_kuliah.semester='$semester'
"));

$tugasBelum = $totalTugas - $tugasSelesai;

/* tugas terbaru */
$tugas = mysqli_query($conn, "
SELECT 
tugas.*, 
mata_kuliah.nama_mk,
mata_kuliah.dosen,
mata_kuliah.semester,
pengumpulan_tugas.id_user AS sudah_kumpul
FROM tugas
JOIN mata_kuliah 
ON tugas.id_mk = mata_kuliah.id_mk
LEFT JOIN pengumpulan_tugas 
ON tugas.id_tugas = pengumpulan_tugas.id_tugas
AND pengumpulan_tugas.id_user='$id_user'
WHERE mata_kuliah.semester='$semester'
ORDER BY tugas.id_tugas DESC
LIMIT 3
");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard Mahasiswa</title>
    <link href="../../src/output.css" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans">


    <!-- HEADER -->
    <div class="bg-blue-600 text-white px-10 py-5 flex justify-between items-center shadow">

        <div class="flex items-center gap-4">

            <img src="../../assets/logo.png" class="w-12 h-12">

            <div>
                <h1 class="font-bold text-xl">
                    Sistem Monitoring Tugas Mahasiswa
                </h1>
                <p class="text-sm opacity-90">
                    Institut Teknologi dan Bisnis
                </p>
            </div>

        </div>

        <div class="flex items-center gap-8 text-sm">

            <div class="flex items-center gap-2">
                📞 0361-223858
            </div>

            <div class="flex items-center gap-2">
                ✉️ info@stikombali.ac.id
            </div>

        </div>

    </div>


    <!-- MENU -->
    <div class="bg-white shadow">

        <div class="py-4 px-10 flex justify-between items-center font-medium text-gray-800">

            <div class="flex gap-12">

                <a href="dashboard.php" class="text-black border-b-2 border-black pb-1">
                    Dashboard
                </a>

                <a href="tugas.php" class="hover:text-black hover:border-b-2 hover:border-black pb-1 transition">
                    Daftar Tugas
                </a>

            </div>


            <!-- LOGOUT -->
            <form id="logoutForm" action="../../logout.php">
                <button
                    id="logoutBtn"
                    class="bg-gradient-to-r from-red-500 to-red-700 text-white px-6 py-2 rounded-lg font-medium
                            shadow-md shadow-red-300/40
                            hover:shadow-lg hover:shadow-red-400/60
                            hover:-translate-y-[2px]
                            transition-all duration-300 flex items-center gap-2">

                    <span id="logoutText">Logout</span>

                    <span id="logoutSpinner" class="hidden">
                        <svg class="animate-spin w-5 h-5 text-white" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
                        </svg>
                    </span>

                </button>
            </form>

        </div>

    </div>


    <div class="p-10">


        <!-- PROFIL CARD -->
        <div class="bg-white/70 backdrop-blur-xl shadow-lg rounded-2xl p-6 flex items-center gap-6 mb-10">

            <div class="w-16 h-16 rounded-full bg-black text-white flex items-center justify-center text-2xl font-bold">
                <?= strtoupper(substr($mhs['nama'], 0, 1)) ?>
            </div>

            <div>

                <h2 class="text-xl font-semibold">
                    <?= $mhs['nama'] ?>
                </h2>

                <p class="text-gray-500 text-sm">
                    <?= $mhs['email'] ?>
                </p>

                <p class="text-gray-500 text-sm">
                    Semester <?= $mhs['semester'] ?>
                </p>

            </div>

        </div>



        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

            <!-- TOTAL TUGAS -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-blue-500 to-blue-700
                        p-6 text-white
                        shadow-xl shadow-blue-400/40
                        transition-all duration-300
                        hover:shadow-blue-500/60 hover:-translate-y-1">

                <!-- GLASS LAYER -->
                <div class="absolute inset-0 bg-white/10 backdrop-blur-md rounded-2xl"></div>

                <div class="relative z-10">

                    <div class="mb-4 w-14 h-14 flex items-center justify-center
                                bg-white/20 backdrop-blur-lg rounded-xl
                                shadow-inner animate-float">

                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M9 17v-6h13M9 11l3-3m0 0l3 3m-3-3v12" />
                        </svg>

                    </div>

                    <p class="text-sm opacity-90">Total Tugas</p>
                    <h3 class="text-3xl font-bold"><?= $totalTugas ?></h3>

                </div>

            </div>


            <!-- TUGAS SELESAI -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-green-500 to-green-700
                        p-6 text-white
                        shadow-xl shadow-green-400/40
                        transition-all duration-300
                        hover:shadow-green-500/60 hover:-translate-y-1">

                <div class="absolute inset-0 bg-white/10 backdrop-blur-md rounded-2xl"></div>

                <div class="relative z-10">

                    <div class="mb-4 w-14 h-14 flex items-center justify-center
                                bg-white/20 backdrop-blur-lg rounded-xl
                                shadow-inner animate-float">

                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>

                    </div>

                    <p class="text-sm opacity-90">Tugas Selesai</p>
                    <h3 class="text-3xl font-bold"><?= $tugasSelesai ?></h3>

                </div>

            </div>


            <!-- TUGAS BELUM -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-r from-red-500 to-red-700
                        p-6 text-white
                        shadow-xl shadow-red-400/40
                        transition-all duration-300
                        hover:shadow-red-500/60 hover:-translate-y-1">

                <div class="absolute inset-0 bg-white/10 backdrop-blur-md rounded-2xl"></div>

                <div class="relative z-10">

                    <div class="mb-4 w-14 h-14 flex items-center justify-center
                                bg-white/20 backdrop-blur-lg rounded-xl
                                shadow-inner animate-float">

                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </div>

                    <p class="text-sm opacity-90">Belum Selesai</p>
                    <h3 class="text-3xl font-bold"><?= $tugasBelum ?></h3>

                </div>

            </div>

        </div>
        <!--  -->
        <style>
            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-6px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>





        <!-- TUGAS TERBARU -->
        <h2 class="text-xl font-semibold mb-5">
            Tugas Terbaru
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <?php while ($row = mysqli_fetch_assoc($tugas)) : ?>

                <div class="bg-white shadow-lg hover:shadow-xl transition rounded-xl p-5 flex flex-col justify-between">

                    <div>

                        <p class="text-xs text-blue-600 font-semibold mb-1">
                            📚 <?= $row['nama_mk'] ?? '-' ?>
                        </p>

                        <h3 class="font-semibold text-gray-800 mb-2">
                            <?= $row['judul_tugas'] ?>
                        </h3>

                        <p class="text-sm text-gray-500 mb-3">
                            <?= $row['deskripsi'] ?>
                        </p>

                        <p class="text-sm text-gray-600 mb-3">
                            ⏰ Deadline : <span class="font-medium"><?= $row['deadline'] ?></span>
                        </p>

                        <?php if ($row['sudah_kumpul']) : ?>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                ✔ Selesai
                            </span>

                        <?php else : ?>

                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                                Belum Selesai
                            </span>

                        <?php endif; ?>

                    </div>


                    <div class="mt-4">

                        <?php if (!$row['sudah_kumpul']) : ?>

                            <a href="kumpulkan_tugas.php?id=<?= $row['id_tugas'] ?>"
                                class="block text-center
                                        bg-gradient-to-r from-blue-500 to-blue-700
                                        text-white py-2 rounded-lg text-sm
                                        shadow-md shadow-blue-300/40
                                        hover:shadow-lg hover:shadow-blue-400/60
                                        hover:-translate-y-[2px]
                                        transition">

                                Kumpulkan Tugas

                            </a>

                        <?php else : ?>

                            <button
                                class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg text-sm cursor-not-allowed">

                                Sudah Dikumpulkan

                            </button>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>


    </div>


    <script>
        document.getElementById("logoutForm").addEventListener("submit", function() {
            document.getElementById("logoutText").classList.add("hidden");
            document.getElementById("logoutSpinner").classList.remove("hidden");
        });
    </script>

</body>

</html>