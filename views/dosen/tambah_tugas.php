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

$mk = mysqli_query($conn, "
SELECT * FROM mata_kuliah 
WHERE id_dosen='$id_dosen'
");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Tugas</title>

    <link href="../../src/output.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <?php include '../../component/sidebar.php'; ?>

    <div class="ml-64 p-10">

        <h1 class="text-2xl font-bold mb-8">
            Tambah Tugas
        </h1>


        <!-- CARD FORM -->
        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition w-full max-w-xl">

            <form action="../../controllers/simpan_tugas.php" method="POST" class="space-y-6">


                <!-- MATA KULIAH -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Mata Kuliah
                    </label>

                    <select name="id_mk"

                        class="w-full bg-gray-50 rounded-xl px-4 py-3
                                outline-none
                                transition-all duration-300
                                focus:bg-white
                                focus:shadow-md
                                focus:shadow-gray-300/40"

                        required>

                        <option value="">-- Pilih Mata Kuliah --</option>

                        <?php while ($m = mysqli_fetch_assoc($mk)) : ?>

                            <option value="<?= $m['id_mk'] ?>">
                                <?= $m['nama_mk'] ?> (Semester <?= $m['semester'] ?>)
                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>



                <!-- JUDUL -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Tugas
                    </label>

                    <input type="text"
                        name="judul_tugas"

                        class="w-full bg-gray-50 rounded-xl px-4 py-3
                                outline-none
                                transition-all duration-300
                                focus:bg-white
                                focus:shadow-md
                                focus:shadow-gray-300/40"

                        placeholder="Masukkan judul tugas..."
                        required>

                </div>



                <!-- DESKRIPSI -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi Tugas
                    </label>

                    <textarea
                        name="deskripsi"

                        class="w-full bg-gray-50 rounded-xl px-4 py-3
                                outline-none resize-none
                                transition-all duration-300
                                focus:bg-white
                                focus:shadow-md
                                focus:shadow-gray-300/40"

                        rows="4"
                        placeholder="Masukkan deskripsi tugas..."
                        required></textarea>

                </div>



                <!-- DEADLINE -->
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Deadline
                    </label>

                    <input type="date"
                        name="deadline"

                        class="w-full bg-gray-50 rounded-xl px-4 py-3
                                outline-none
                                transition-all duration-300
                                focus:bg-white
                                focus:shadow-md
                                focus:shadow-gray-300/40"

                        required>

                </div>



                <!-- BUTTON -->
                <div class="flex gap-4 pt-2">


                    <!-- SIMPAN -->
                    <button type="submit"

                        class="flex items-center gap-2

                                bg-gradient-to-r from-blue-500 to-blue-700
                                text-white px-6 py-2.5 rounded-xl

                                shadow-md shadow-blue-300/40
                                transition duration-300

                                hover:shadow-lg hover:shadow-blue-400/60
                                hover:-translate-y-[2px]">

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

                        Simpan

                    </button>



                    <!-- BATAL -->
                    <a href="tugas.php"

                        class="flex items-center justify-center

                                bg-gradient-to-r from-red-500 to-red-700
                                text-white px-6 py-2.5 rounded-xl

                                shadow-md shadow-red-300/40
                                transition duration-300

                                hover:shadow-lg hover:shadow-red-400/60
                                hover:-translate-y-[2px]">

                        Batal

                    </a>


                </div>


            </form>

        </div>

    </div>

</body>

</html>