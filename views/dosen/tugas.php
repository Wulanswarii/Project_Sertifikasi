<?php
session_start();
require '../../config/config.php';

/* proteksi login dosen */
if (!isset($_SESSION['id_user'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SESSION['role'] != 'dosen') {
    header("Location: ../../login.php");
    exit;
}

$id_dosen = $_SESSION['id_user'];

$query = mysqli_query($conn, "
SELECT 
tugas.*, 
mata_kuliah.nama_mk, mata_kuliah.semester
FROM tugas
JOIN mata_kuliah 
ON tugas.id_mk = mata_kuliah.id_mk
WHERE mata_kuliah.id_dosen='$id_dosen'
ORDER BY tugas.deadline ASC
");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Data Tugas Dosen</title>

    <link href="../../src/output.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <?php include '../../component/sidebar.php'; ?>

    <div class="ml-64 p-10">

        <h1 class="text-2xl font-bold mb-8">
            Data Tugas Dosen
        </h1>


        <!-- BUTTON TAMBAH -->
        <a href="tambah_tugas.php"

            class="inline-flex items-center gap-2

                    bg-gradient-to-r from-blue-500 to-blue-700
                    text-white px-5 py-2.5 rounded-xl

                    shadow-md shadow-blue-300/40
                    transition duration-300

                    hover:shadow-lg hover:shadow-blue-400/60
                    hover:-translate-y-[2px] mb-6">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />

            </svg>

            Tambah Tugas

        </a>



        <!-- TABLE CARD -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <table class="w-full">

                <thead class="bg-white">
                    <tr class="text-gray-600 text-sm border-b">

                        <th class="p-4 text-center">No</th>
                        <th class="p-4 text-center">Mata Kuliah</th>
                        <th class="p-4 text-center">Semester</th>
                        <th class="p-4 text-center">Judul</th>
                        <th class="p-4 text-center">Deskripsi</th>
                        <th class="p-4 text-center">Deadline</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>

                    </tr>

                </thead>


                <tbody class="text-gray-700">

                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) : ?>

                        <tr class="border-b hover:bg-gray-50 transition duration-200">

                            <td class="p-4 text-center"><?= $no++ ?></td>

                            <td class="p-4 text-center font-medium text-blue-600">
                                <?= $row['nama_mk'] ?>
                            </td>

                            <td class="p-4 text-center">
                                Semester <?= $row['semester'] ?>
                            </td>

                            <td class="p-4 text-center">
                                <?= $row['judul_tugas'] ?>
                            </td>

                            <td class="p-4 text-center text-gray-500">
                                <?= $row['deskripsi'] ?>
                            </td>

                            <td class="p-4 text-center">
                                <?= $row['deadline'] ?>
                            </td>


                            <td class="p-4 text-center">

                                <?php if ($row['status'] == "Selesai") : ?>

                                    <span class="px-3 py-1 rounded-full text-sm text-green-700 bg-green-100">
                                        Selesai
                                    </span>

                                <?php else : ?>

                                    <span class="px-3 py-1 rounded-full text-sm text-red-600 bg-red-100">
                                        Belum
                                    </span>

                                <?php endif; ?>

                            </td>



                            <td class="p-4 flex justify-center gap-3">

                                <!-- EDIT -->
                                <a href="edit_tugas.php?id=<?= $row['id_tugas'] ?>"

                                    class="p-2 rounded-lg

                                            bg-gradient-to-r from-yellow-400 to-yellow-600
                                            text-white

                                            shadow-md shadow-yellow-300/40
                                            transition duration-300

                                            hover:shadow-lg hover:shadow-yellow-400/60
                                            hover:-translate-y-[1px]">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 13l6.768-6.768
                                                a2.5 2.5 0 013.536 3.536L12.5 16.5
                                                H9v-3.5z" />

                                    </svg>

                                </a>


                                <!-- DELETE -->
                                <button onclick="openDeleteModal(<?= $row['id_tugas'] ?>)"

                                    class="p-2 rounded-lg

                                            bg-gradient-to-r from-red-500 to-red-700
                                            text-white

                                            shadow-md shadow-red-300/40
                                            transition duration-300

                                            hover:shadow-lg hover:shadow-red-400/60
                                            hover:-translate-y-[1px]">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                            a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6" />

                                    </svg>

                                </button>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>



    <!-- MODAL HAPUS -->
    <div id="deleteModal"
        class="fixed inset-0 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-white p-6 rounded-xl shadow-xl w-80">

            <h2 class="text-lg font-semibold mb-3">
                Konfirmasi Hapus
            </h2>

            <p class="text-gray-600 mb-5">
                Apakah Anda yakin ingin menghapus data ini?
            </p>

            <div class="flex justify-end gap-3">

                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">

                    Batal

                </button>

                <a id="deleteLink"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">

                    Hapus

                </a>

            </div>

        </div>

    </div>



    <script>
        function openDeleteModal(id) {

            const modal = document.getElementById("deleteModal");
            const deleteLink = document.getElementById("deleteLink");

            deleteLink.href = "../../controllers/hapus_tugas.php?id=" + id;

            modal.classList.remove("hidden");
            modal.classList.add("flex");

        }

        function closeDeleteModal() {

            const modal = document.getElementById("deleteModal");

            modal.classList.remove("flex");
            modal.classList.add("hidden");

        }
    </script>

</body>

</html>