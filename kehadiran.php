<?php
// membuat instance
$datakehadiran=NEW kehadiran;
// aksi tampil data
if($_GET['aksi']=='tampil'){
// aksi untuk tampil data
$html = null;
$html .='<h3>Daftar Siswa</h3>';
$html .='<p>Berikut ini data Kehadiran Siswa</p>';
$html .='<table border="1" width="100%">
<thead>
<th>No.</th>
<th>NIS</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Jenis Kelamin</th>
<th>Kehadiran</th>
<th>Aksi</th>
</thead>
<tbody>';
// variabel $data menyimpan hasil return
$data = $datakehadiran->tampil();
$no=null;
if(isset($data)){
foreach($data as $bariskehadiran){
$no++;
$html .='<tr>
<td>'.$no.'</td>
<td>'.$bariskehadiran->nis.'</td>
<td>'.$bariskehadiran->nama.'</td>
<td>'.$bariskehadiran->tanggal.'</td>
<td>'.$bariskehadiran->jk.'</td>
<td>'.$bariskehadiran->kehadiran.'</td>
<td>
<a href="index.php?file=kehadiran&aksi=edit&nis='.$bariskehadiran->nis.'">Edit</a>
<a href="index.php?file=kehadiran&aksi=hapus&nis='.$bariskehadiran->nis.'">Hapus</a>
</td>
</tr>';
}
}
$html .='</tbody>
</table>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='tambah') {
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=kehadiran&aksi=simpan">';
$html .='<p>Nomor Induk Siswa<br/>';
$html .='<input type="text" name="txtNis"placeholder="Masukan No. Induk" autofocus/></p>';
$html .='<p>Nama Lengkap<br/>';
$html .='<input type="text" name="txtNama"placeholder="Masukan Nama Lengkap" size="30" required/></p>';
$html .='<p>Tanggal<br/>';
$html .='<input type="date" name="txtTanggal"required/></p>';
$html .='<p>Jenis Kelamin<br/>';
$html .='<input type="radio" name="txtJenisKelamin"value="L"> Laki-laki';
$html .='<input type="radio" name="txtJenisKelamin"value="P"> Perempuan</p>';
$html .='<p>Kehadiran<br/>';
$html .='<input type="text" name="txtKehadiran"placeholder="Masukkan ket.hadir,izin,sakit,alpha" size="30" required/></p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='simpan') {
$data=array(
'nis'=>$_POST['txtNis'],
'nama'=>$_POST['txtNama'],
'tanggal'=>$_POST['txtTanggal'],
'jk'=>$_POST['txtJenisKelamin'],
'kehadiran'=>$_POST['txtKehadiran']
);
// simpan siswa dengan menjalankan method simpan
$datakehadiran->simpan($data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=kehadiran&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='edit') {
// ambil data siswa
$kehadiran=$datakehadiran->detail($_GET['nis']);
if($kehadiran->jk =='L') { $pilihL='checked';
$pilihP =null; }
else {
$pilihP='checked'; $pilihL =null; }
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=kehadiran&aksi=update">';
$html .='<p>Nomor Induk Siswa<br/>';
$html .='<input type="text" name="txtNis"value="'.$kehadiran->nis.'" placeholder="Masukan No. Induk"readonly/></p>';
$html .='<p>Nama Lengkap<br/>';
$html .='<input type="text" name="txtNama"value="'.$kehadiran->nama.'" placeholder="Masukan Nama Lengkap"size="30" required autofocus/></p>';
$html .='<p>Tanggal <br/>';
$html .='<input type="date" name="txtTanggal"value="'.$kehadiran->tanggal.'" required/></p>';
$html .='<p>Jenis Kelamin<br/>';
$html .='<input type="radio" name="txtJenisKelamin"value="L" '.$pilihL.'> Laki-laki';
$html .='<input type="radio" name="txtJenisKelamin"value="P" '.$pilihP.'> Perempuan</p>';
$html .='<p>Kehadiran<br/>';
$html .='<textarea name="txtKehadiran" placeholder="Masukan kehadiran" cols="50" rows="5"required>'.$kehadiran->kehadiran.'</textarea></p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='update') {
$data=array(
'nis'=>$_POST['txtNis'],
'nama'=>$_POST['txtNama'],
'tanggal'=>$_POST['txtTanggal'],
'jk'=>$_POST['txtJenisKelamin'],
'kehadiran'=>$_POST['txtKehadiran']
);
$datakehadiran->update($_POST['txtNis'],$data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=kehadiran&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='hapus') {
$datakehadiran->hapus($_GET['nis']);
echo '<meta http-equiv="refresh" content="0;url=index.php?file=kehadiran&aksi=tampil">';
}
// aksi tidak terdaftar
else {
echo '<p>Error 404 : Halaman tidak ditemukan !</p>';
}
?>
