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
$id_tugas = $_GET['id'];

$data = mysqli_query($conn, "
SELECT tugas.*, mata_kuliah.nama_mk
FROM tugas
JOIN mata_kuliah ON tugas.id_mk = mata_kuliah.id_mk
WHERE tugas.id_tugas='$id_tugas'
");

$tugas = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Kumpulkan Tugas</title>
    <link href="../../src/output.css" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans min-h-screen">


    <!-- BACKDROP -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm overflow-y-auto p-6 flex items-start justify-center">


        <!-- MODAL -->
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-8 animate-fade max-h-[90vh] overflow-y-auto">

            <h1 class="text-2xl font-bold mb-2">
                Upload Tugas
            </h1>

            <p class="text-gray-500 text-sm mb-6">
                Silakan unggah file tugas sesuai format yang ditentukan.
            </p>


            <!-- INFO TUGAS -->
            <div class="mb-6 bg-gray-50 rounded-xl p-4">

                <p class="text-sm text-blue-600 font-semibold">
                    <?= $tugas['nama_mk'] ?>
                </p>

                <h2 class="text-lg font-semibold text-gray-800">
                    <?= $tugas['judul_tugas'] ?>
                </h2>

                <p class="text-sm text-gray-500">
                    Deadline : <?= $tugas['deadline'] ?>
                </p>

            </div>



            <form id="uploadForm"
                action="../../controllers/upload_tugas.php"
                method="POST"
                enctype="multipart/form-data">

                <input type="hidden" name="id_tugas" value="<?= $tugas['id_tugas'] ?>">



                <!-- DRAG DROP AREA -->
                <div id="dropArea"

                    class="
                            border-2 border-dashed
                            border-gray-300
                            rounded-xl
                            p-8
                            text-center
                            cursor-pointer
                            transition
                            hover:border-blue-500
                            hover:bg-blue-50
                            ">

                    <div id="uploadText">

                        <p class="text-gray-600 font-medium mb-2">
                            Drag & Drop File di sini
                        </p>

                        <p class="text-sm text-gray-400 mb-3">
                            atau klik untuk memilih file
                        </p>

                    </div>

                    <input
                        type="file"
                        name="file_tugas"
                        id="fileInput"
                        required
                        class="hidden"
                        accept=".pdf,.doc,.docx,.zip">

                    <p id="fileName" class="text-xs text-gray-500 mt-2"></p>

                    <p class="text-xs text-gray-400 mt-2">
                        Format yang didukung: PDF, DOCX, ZIP
                    </p>

                </div>


                <!-- PREVIEW PDF -->
                <div id="previewContainer"
                    class="hidden mt-6 border rounded-xl overflow-hidden shadow">

                    <iframe
                        id="pdfPreview"
                        class="w-full h-72 bg-white">
                    </iframe>

                </div>



                <!-- BUTTON -->
                <div class="flex gap-4 mt-6">


                    <!-- UPLOAD -->
                    <button
                        id="uploadBtn"

                        class="
                                flex-1
                                bg-gradient-to-r from-blue-500 to-blue-700
                                text-white
                                py-2.5
                                rounded-lg
                                font-medium

                                shadow-md shadow-blue-300/40
                                transition-all duration-300

                                hover:shadow-lg hover:shadow-blue-400/60
                                hover:-translate-y-[1px]

                                flex items-center justify-center gap-2
                                ">

                        <span id="btnText">
                            Upload Tugas
                        </span>

                        <span id="spinner" class="hidden">

                            <svg class="animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24">

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"></circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v8z"></path>

                            </svg>

                        </span>

                    </button>



                    <!-- BATAL -->
                    <a href="dashboard.php"

                        class="
                                flex-1 text-center
                                bg-gradient-to-r from-red-500 to-red-700
                                text-white
                                py-2.5
                                rounded-lg
                                font-medium

                                shadow-md shadow-red-300/40
                                transition-all duration-300

                                hover:shadow-lg hover:shadow-red-400/60
                                hover:-translate-y-[1px]
">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>



    <script>
        /* DRAG DROP */

        const dropArea = document.getElementById("dropArea");
        const fileInput = document.getElementById("fileInput");
        const fileName = document.getElementById("fileName");

        const previewContainer = document.getElementById("previewContainer");
        const pdfPreview = document.getElementById("pdfPreview");
        const uploadText = document.getElementById("uploadText");


        dropArea.addEventListener("click", () => fileInput.click());


        fileInput.addEventListener("change", () => {
            showPreview(fileInput.files[0]);
        });


        dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropArea.classList.add("border-blue-500", "bg-blue-50");
        });


        dropArea.addEventListener("dragleave", () => {
            dropArea.classList.remove("border-blue-500", "bg-blue-50");
        });


        dropArea.addEventListener("drop", (e) => {

            e.preventDefault();

            fileInput.files = e.dataTransfer.files;

            showPreview(e.dataTransfer.files[0]);

            dropArea.classList.remove("border-blue-500", "bg-blue-50");

        });


        function showPreview(file) {

            fileName.textContent = file.name;

            let ext = file.name.split('.').pop().toLowerCase();

            if (ext === "pdf") {

                uploadText.classList.add("hidden");

                previewContainer.classList.remove("hidden");

                let fileURL = URL.createObjectURL(file);

                pdfPreview.src = fileURL;

            }

        }


        /* loading upload */

        document.getElementById("uploadForm").addEventListener("submit", function() {

            document.getElementById("btnText").classList.add("hidden");
            document.getElementById("spinner").classList.remove("hidden");

        });
    </script>


</body>

</html>