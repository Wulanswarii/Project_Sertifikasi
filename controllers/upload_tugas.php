<?php
session_start();
require '../config/config.php';

$id_user = $_SESSION['id_user'];
$id_tugas = $_POST['id_tugas'];

$file = $_FILES['file_tugas']['name'];
$tmp = $_FILES['file_tugas']['tmp_name'];

$folder = "../uploads/tugas/";

$nama_file = time().'_'.$file;

move_uploaded_file($tmp, $folder.$nama_file);

/* simpan ke database */

mysqli_query($conn,"
INSERT INTO pengumpulan_tugas
(id_tugas,id_user,file_tugas)
VALUES
('$id_tugas','$id_user','$nama_file')
");

header("Location: ../views/mahasiswa/dashboard.php");
exit;
?>