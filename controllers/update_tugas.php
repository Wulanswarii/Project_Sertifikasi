<?php
session_start();
require '../config/config.php';

/* ambil data dari form */
$id = $_POST['id_tugas'];
$id_mk = $_POST['id_mk'];
$judul = $_POST['judul_tugas'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];

/* update data tugas */
mysqli_query($conn,"
UPDATE tugas 
SET 
id_mk='$id_mk',
judul_tugas='$judul',
deskripsi='$deskripsi',
deadline='$deadline'
WHERE id_tugas='$id'
");

/* kembali ke halaman tugas dosen */
header("Location: ../views/dosen/tugas.php");
exit;
?>