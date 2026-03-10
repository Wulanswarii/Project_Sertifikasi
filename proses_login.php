<?php
session_start();
require 'config/config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,"
SELECT * FROM users 
WHERE email='$email' AND password='$password'
");

$data = mysqli_fetch_assoc($query);

if($data){

$_SESSION['id_user'] = $data['id_user'];
$_SESSION['nama'] = $data['nama'];
$_SESSION['role'] = $data['role'];

/* arahkan berdasarkan role */

if($data['role'] == 'admin'){

header("Location: views/admin/dashboard.php");

}elseif($data['role'] == 'dosen'){

header("Location: views/dosen/dashboard.php");

}else{

header("Location: views/mahasiswa/dashboard.php");

}

}else{

echo "<script>
alert('Email atau Password salah');
window.location='login.php';
</script>";

}
?>