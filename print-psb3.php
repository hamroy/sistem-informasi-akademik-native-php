<?php 
session_start();
error_reporting(0);
include "config/koneksi.php"; 
include "config/fungsi_indotgl.php"; 
$r = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM psb_aktivasi where id_aktivasi='$_GET[id]'"));
?>
<html>
<head>
<title>Print Kartu Pendaftaran Peserta</title>
<link rel="stylesheet" href="bootstrap/css/printer.css">
</head>
<body onload="window.print()">
<table style='border:1px solid #000' border='0' width='100%'>
  <tr>
    <td width=120px><img style='width:90px; margin-top:7px' src='print_raport/logo.png'></td>
    <td><center>KARTU AKTIVASI PENDAFTARAN<br> PSB YAYASAN PHPMU PADANG</center></td>
    <td width=120px></td>
  </tr>
</table>

<?php 
$ex = explode(' ', $r[waktu_input]);
echo "<table width='100%' border='1' id='tablemodul1' class='table daftar'>
   <tr><td width='90px' valign=top rowspan='5'><center><img style='width:80px; margin-top:7px' src='foto_siswa/blank.png'></center></td></tr>

   <tr><td><b>Kode Aktivasi</b></td><td><b style='color:red'>$r[kode_pendaftaran]</b></td></tr>
   <tr><td width=150px><b>Nama Lengkap</b></td>  <td>$r[nama_lengkap]</td></tr>
   <tr><td><b>Status</b></td>  <td style='text-transform:uppercase'>$r[status]</td></tr>
   <tr><td><b>Waktu Daftar </b></td><td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td></tr>
</table>";
?>
<table style='border:1px solid #000; background:#e3e3e3; font-size:11px; ' width='100%'>
<tr><td><b>Keterangan Pendaftaran :</b></td></tr>
<tr><td>- Pendaftaran di alamat <span style='color:blue; text-decoration:underline'>http://phpmu.sch.id/psb</span></td></tr>
<tr><td>- Saat membuka form pendaftran, masukkan kode aktivasi yang ada pada kartu ini.</td></tr>
<tr><td>- Kode aktivasi hanya bisa digunakan untuk 1 kali pendaftaran saja.</td></tr>
<tr><td>- Jika ada kendala lainnya bisa kontak kami di email. <span style='color:blue; text-decoration:underline'><?php echo "$r[status]@phpmu.sch.id"; ?></span></td></tr>
</table>
</body>
</html>