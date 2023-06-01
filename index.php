<!DOCTYPE html>
<html lang="en">
<head>
<title>Data Kehadiran Siswa</title>
</head>
<body>
<?php
include('class/Database.php');
include('class/Kehadiran.php');
?>
<h1>Aplikasi Data Kehadiran Siswa</h1>
<hr/>
<p>
<a href="index.php">Home</a>
<a href="index.php?file=kehadiran&aksi=tampil">Data Kehadiran Siswa</a>
<a href="index.php?file=kehadiran&aksi=tambah">Tambah Data Kehadiran Siswa</a>
</p>
<hr/>
<?php
if(isset($_GET['file'])){
include($_GET['file'].'.php');
} else {
echo '<h1 align="center">Selamat Datang</h1>';
}
?>
</body>
</html>