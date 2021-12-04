<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$s = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM identitas_sekolah ORDER BY id_identitas_sekolah DESC LIMIT 1"));
?>
<html>
<head>
<title>Hal 1 - Raport Siswa</title>
<link rel="stylesheet" href="../bootstrap/css/printer.css">
<style type="text/css">
  td { padding:9px; }
</style>
</head>
<body onload="window.print()">
    <h1 align=center>RAPORT <br>SEKOLAH MENENGAH ATAS <br> (SMA)</h1><br>

    <table style='font-size:23px' width='100%'>
        <tr><td width='180px'>Nama Sekolah</td>   <td width='10px'> : </td><td> <?php echo "$s[nama_sekolah]"; ?></td></tr>
        <tr><td width='180px'>NPSN/NSS</td>       <td width='10px'> : </td><td> <?php echo "$s[npsn]"; ?></td></tr>
        <tr><td width='180px'>NSS</td>            <td width='10px'> : </td><td> <?php echo "$s[nss]"; ?></td></tr>
        <tr><td width='180px'>Alamat Sekolah</td> <td width='10px'> : </td><td> <?php echo "$s[alamat_sekolah]"; ?></td></tr>
        <tr><td width='180px'></td>               <td width='10px'>   </td><td> <?php echo "Kode Pos $s[kode_pos], Telp. $s[no_telpon]"; ?></td></tr>
        <tr><td width='180px'>Kelurahan</td>      <td width='10px'> : </td><td> <?php echo "$s[kelurahan]"; ?></td></tr>
        <tr><td width='180px'>Kecamatan</td>      <td width='10px'> : </td><td> <?php echo "$s[kecamatan]"; ?></td></tr>
        <tr><td width='180px'>Kabupaten/Kota</td> <td width='10px'> : </td><td> <?php echo "$s[kabupaten_kota]"; ?></td></tr>
        <tr><td width='180px'>Provinsi</td>       <td width='10px'> : </td><td> <?php echo "$s[provinsi]"; ?></td></tr>
        <tr><td width='180px'>Website</td>        <td width='10px'> : </td><td> <?php echo "$s[website]"; ?></td></tr>
        <tr><td width='180px'>E-Mail</td>         <td width='10px'> : </td><td> <?php echo "$s[email]"; ?></td></tr>
    </table>
</body>
</html>