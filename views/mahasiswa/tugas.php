<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['role'] != 'mahasiswa') {
    header("Location: ../../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$mahasiswa = mysqli_query($conn, "
SELECT * FROM users 
WHERE id_user='$id_user'
");

$mhs = mysqli_fetch_assoc($mahasiswa);

$semester = $mhs['semester'];

$query = mysqli_query($conn, "
SELECT 
tugas.*, 
mata_kuliah.nama_mk,
users.nama AS dosen,
mata_kuliah.semester,
pengumpulan_tugas.file_tugas
FROM tugas
JOIN mata_kuliah 
ON tugas.id_mk = mata_kuliah.id_mk
JOIN users
ON mata_kuliah.id_dosen = users.id_user
LEFT JOIN pengumpulan_tugas 
ON tugas.id_tugas = pengumpulan_tugas.id_tugas
AND pengumpulan_tugas.id_user='$id_user'
WHERE mata_kuliah.semester='$semester'
ORDER BY tugas.deadline ASC
");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Daftar Tugas</title>
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

    </div>



    <!-- MENU -->
    <div class="bg-white shadow">

        <div class="py-4 px-10 flex justify-between items-center font-medium text-gray-800">

            <div class="flex gap-12">

                <a href="dashboard.php"
                    class="hover:text-black hover:border-b-2 hover:border-black pb-1 transition">
                    Dashboard
                </a>

                <a href="tugas.php"
                    class="text-black border-b-2 border-black pb-1">
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

        <h1 class="text-2xl font-bold mb-6">
            Daftar Tugas
        </h1>


        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">


            <table class="w-full">

                <thead class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">

                    <tr>

                        <th class="p-4 text-left">No</th>
                        <th class="p-4 text-left">Mata Kuliah</th>
                        <th class="p-4 text-left">Judul</th>
                        <th class="p-4 text-left">Dosen</th>
                        <th class="p-4 text-left">Deadline</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Aksi</th>

                    </tr>

                </thead>


                <tbody class="text-gray-700">

                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)):
                    ?>

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4"><?= $no++ ?></td>

                            <td class="p-4 font-medium text-blue-600">
                                <?= $row['nama_mk'] ?>
                            </td>

                            <td class="p-4">
                                <?= $row['judul_tugas'] ?>
                            </td>

                            <td class="p-4">
                                <?= $row['dosen'] ?>
                            </td>

                            <td class="p-4">
                                <?= $row['deadline'] ?>
                            </td>


                            <td class="p-4">

                                <?php if ($row['file_tugas']) : ?>

                                    <span
                                        class="px-3 py-1 text-xs font-medium text-white
                                                bg-gradient-to-r from-green-500 to-green-700
                                                rounded-full
                                                shadow-md shadow-green-300/40">

                                        Sudah Dikumpulkan

                                    </span>

                                <?php else : ?>

                                    <span
                                        class="px-3 py-1 text-xs font-medium text-white
                                                bg-gradient-to-r from-red-500 to-red-700
                                                rounded-full
                                                shadow-md shadow-red-300/40">

                                        Belum Dikumpulkan

                                    </span>

                                <?php endif; ?>

                            </td>


                            <td class="p-4 flex gap-3">

                                <?php if (!$row['file_tugas']) : ?>

                                    <a href="kumpulkan_tugas.php?id=<?= $row['id_tugas'] ?>"

                                        class="px-4 py-1.5 text-sm text-white
                                                bg-gradient-to-r from-blue-500 to-blue-700
                                                rounded-lg
                                                shadow-md shadow-blue-300/40
                                                transition-all duration-300
                                                hover:shadow-lg hover:shadow-blue-400/60
                                                hover:-translate-y-[1px]">

                                        Kumpulkan

                                    </a>

                                <?php else : ?>

                                    <a href="#"
                                        onclick="openDownloadModal(
'<?= $row['judul_tugas'] ?>',
'<?= $row['nama_mk'] ?>',
'<?= $row['dosen'] ?>',
'<?= $row['file_tugas'] ?>'
)"

                                        class="px-4 py-1.5 text-sm text-white
bg-gradient-to-r from-green-500 to-green-700
rounded-lg
shadow-md shadow-green-300/40
transition-all duration-300
hover:shadow-lg hover:shadow-green-400/60
hover:-translate-y-[1px]">

                                        Download

                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>


    </div>
    <!-- MODAL DOWNLOAD -->

    <div id="downloadModal"
        class="fixed inset-0 hidden items-center justify-center z-50">

        <!-- background blur -->
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

        <!-- modal card -->
        <div id="modalCard"
            class="relative bg-white/90 backdrop-blur-xl w-full max-w-md rounded-2xl shadow-2xl p-7
                transform scale-90 opacity-0 transition-all duration-300">

            <!-- header -->
            <div class="flex items-center gap-3 mb-5">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-xl">

                    📄

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-gray-800">
                        Download Tugas
                    </h2>

                    <p class="text-sm text-gray-500">
                        File tugas mahasiswa
                    </p>

                </div>

            </div>

            <!-- content -->
            <div class="space-y-2 text-sm text-gray-700">

                <p><b>Judul :</b> <span id="modalJudul"></span></p>
                <p><b>Mata Kuliah :</b> <span id="modalMK"></span></p>
                <p><b>Dosen :</b> <span id="modalDosen"></span></p>

            </div>

            <!-- actions -->
            <div class="flex justify-end gap-3 mt-6">

                <button onclick="closeDownloadModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">

                    Tutup

                </button>

                <a id="modalDownload"
                    download
                    onclick="startDownload()"

                    class="px-4 py-2 text-white
                            bg-gradient-to-r from-green-500 to-green-700
                            rounded-lg
                            shadow-md shadow-green-300/40
                            hover:shadow-lg hover:shadow-green-400/60
                            transition-all duration-300
                            flex items-center gap-2">

                    <span id="downloadText">Download File</span>

                    <!-- spinner -->
                    <svg id="downloadSpinner"
                        class="w-4 h-4 animate-spin hidden"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="10"
                            stroke="white"
                            stroke-width="4"
                            fill="none" />

                    </svg>

                </a>

            </div>

        </div>

    </div>

    <script>
        function openDownloadModal(judul, mk, dosen, file) {

            document.getElementById("modalJudul").innerText = judul;
            document.getElementById("modalMK").innerText = mk;
            document.getElementById("modalDosen").innerText = dosen;

            document.getElementById("modalDownload").href =
                "../../uploads/tugas/" + file;

            let modal = document.getElementById("downloadModal");
            let card = document.getElementById("modalCard");

            modal.classList.remove("hidden");
            modal.classList.add("flex");

            setTimeout(() => {
                card.classList.remove("scale-90", "opacity-0");
                card.classList.add("scale-100", "opacity-100");
            }, 50);

        }


        function closeDownloadModal() {

            let modal = document.getElementById("downloadModal");
            let card = document.getElementById("modalCard");

            card.classList.remove("scale-100", "opacity-100");
            card.classList.add("scale-90", "opacity-0");

            setTimeout(() => {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
            }, 200);

        }


        function startDownload() {

            document.getElementById("downloadText").classList.add("hidden");
            document.getElementById("downloadSpinner").classList.remove("hidden");

            setTimeout(() => {
                closeDownloadModal();
            }, 800);

        }
    </script>
</body>

</html>