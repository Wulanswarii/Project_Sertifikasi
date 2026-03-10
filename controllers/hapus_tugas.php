<?php
session_start();
require '../config/config.php';

/* proteksi login */
if(!isset($_SESSION['id_user'])){
header("Location: ../login.php");
exit;
}

/* proteksi role dosen */
if($_SESSION['role'] != 'dosen'){
header("Location: ../login.php");
exit;
}

/* cek id tugas */
if(!isset($_GET['id'])){
header("Location: ../views/dosen/tugas.php");
exit;
}

$id = $_GET['id'];

/* hapus tugas */
$hapus = mysqli_query($conn,"DELETE FROM tugas WHERE id_tugas='$id'");

/* cek hasil */
if($hapus){

echo "<script>
alert('Tugas berhasil dihapus');
window.location='../views/dosen/tugas.php';
</script>";

}else{

echo "<script>
alert('Gagal menghapus tugas');
window.location='../views/dosen/tugas.php';
</script>";

}
