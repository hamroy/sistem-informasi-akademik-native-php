<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$skp = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_sikap_semester where id_tahun_akademik='$_GET[tahun]' AND nisn='$_GET[id]' AND kode_kelas='$_GET[kelas]'")); 
?>
<html>
<head>
<title>Hal 3 - Raport Siswa</title>
<link rel="stylesheet" href="../bootstrap/css/printer.css">
</head>
<body onload="window.print()">
<?php
$t = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tahun_akademik where id_tahun_akademik='$_GET[tahun]'"));
$s = mysqli_fetch_array(mysqli_query($koneksi,"SELECT a.*, b.*, c.nama_guru as walikelas, c.nip FROM siswa a 
                                      JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                                        LEFT JOIN guru c ON b.nip=c.nip where a.nisn='$_GET[id]'"));
if (substr($_GET[tahun],4,5)=='1'){ $semester = 'Ganjil'; }else{ $semester = 'Genap'; }
$iden = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM identitas_sekolah ORDER BY id_identitas_sekolah DESC LIMIT 1"));
echo "<table width=100%>
        <tr><td width=140px>Nama Sekolah</td> <td> : $iden[nama_sekolah] </td>       <td width=140px>Kelas </td>   <td>: $s[kode_kelas]</td></tr>
        <tr><td>Alamat</td>                   <td> : $iden[alamat_sekolah] </td>     <td>Semester </td> <td>: $semester</td></tr>
        <tr><td>Nama Peserta Didik</td>       <td> : <b>$s[nama]</b> </td>           <td>Tahun Pelajaran </td> <td>: $t[keterangan]</td></tr>
        <tr><td>No Induk/NISN</td>            <td> : $s[nipd] / $s[nisn]</td>        <td></td></tr>
      </table><br>

      <h2 align=center>CAPAIAN HASIL BELAJAR</h2>
      <b>A. SIKAP</b><br><br>";
echo "<b>1. Sikap Spiritual</b>
      <table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='190px'>Predikat</th>
            <th>Deskripsi</th>
          </tr>
          <tr>
            <th style='padding:60px'>$skp[spiritual_predikat]</th>
            <th>$skp[spiritual_deskripsi]</th>
          </tr>
      </table><br/>";

echo "<b>2. Sikap Sosial</b>
      <table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='190px'>Predikat</th>
            <th>Deskripsi</th>
          </tr>
          <tr>
            <th style='padding:60px'>$skp[sosial_predikat]</th>
            <th>$skp[sosial_deskripsi]</th>
          </tr>
      </table><br/>";
?>

</body>
</html>