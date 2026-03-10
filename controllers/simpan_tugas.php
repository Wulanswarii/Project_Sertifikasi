<?php
session_start();
require '../config/config.php';

$id_mk = $_POST['id_mk'];
$judul = $_POST['judul_tugas'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];

$status = "Belum Selesai";


$id_user = NULL;

// Proses Menyimpan Tugas //
mysqli_query($conn,"
INSERT INTO tugas 
(id_user, id_mk, judul_tugas, deskripsi, deadline, status)
VALUES 
(NULL,'$id_mk','$judul','$deskripsi','$deadline','$status')
");

header("Location: ../views/dosen/tugas.php");
exit;
?>