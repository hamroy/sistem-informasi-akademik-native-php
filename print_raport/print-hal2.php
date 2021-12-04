<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$s = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin 
                                        LEFT JOIN agama c ON a.id_agama=c.id_agama where a.nisn='$_GET[id]'"));
?>
<html>
<head>
<title>Hal 2 - Raport Siswa</title>
<link rel="stylesheet" href="../bootstrap/css/printer.css">
<style type="text/css">
  td { padding:2px; }
</style>
</head>
<body onload="window.print()">
    <h1 align=center>IDENTITAS PESERTA DIDIK</h1><br>

    <table style='font-size:15px' width='100%'>
        <tr><td width='25px'>1.</td>  <td width='190px'>Nama Lengkap Peserta Didik</td>   <td width='10px'> : </td><td> <?php echo "$s[nama]"; ?></td></tr>
        <tr><td>2.</td>  <td width='190px'>Nomor Induk/NISN</td>                          <td width='10px'> : </td><td> <?php echo "$s[nipd] / $s[nisn]"; ?></td></tr>
        <tr><td>3.</td>  <td width='190px'>Tempat,Tanggal Lahir</td>                      <td width='10px'> : </td><td> <?php echo "$s[tempat_lahir], ".tgl_raport($s[tanggal_lahir]); ?></td></tr>
        <tr><td>4.</td>  <td width='190px'>Jenis Kelamin</td>                             <td width='10px'> : </td><td> <?php echo "$s[jenis_kelamin]"; ?></td></tr>
        <tr><td>5.</td>  <td width='190px'>Agama</td>                                     <td width='10px'> : </td><td> <?php echo "$s[nama_agama]"; ?></td></tr>
        <tr><td>6.</td>  <td width='190px'>Status dalam Keluarga</td>                     <td width='10px'> : </td><td> <?php echo "Anak Kandung"; ?></td></tr>
        <tr><td>7.</td>  <td width='190px'>Anak ke</td>                                   <td width='10px'> : </td><td> <?php echo "-"; ?></td></tr>
        <tr><td>8.</td>  <td width='190px'>Alamat Peserta Didik</td>                      <td width='10px'> : </td><td> <?php echo "$s[alamat]"; ?></td></tr>
        <tr><td>9.</td>  <td width='190px'>Nomor Telepon Rumah</td>                       <td width='10px'> : </td><td> <?php echo "$s[telepon]"; ?></td></tr>
        <tr><td>10.</td> <td width='190px'>Sekolah Asal (SMP/MTs)</td>                    <td width='10px'> : </td><td> <?php echo ""; ?></td></tr>
        <tr><td>11.</td> <td width='190px'>Diterima di sekolah ini</td>                   <td width='10px'> : </td><td> <?php echo ""; ?></td></tr>
        <tr><td></td> <td width='190px'>Di Kelas</td>                                     <td width='10px'> : </td><td> <?php echo "$s[kode_kelas]"; ?></td></tr>
        <tr><td></td> <td width='190px'>Pada Tanggal</td>                                 <td width='10px'> : </td><td> <?php echo tgl_raport(date('Y-m-d')); ?></td></tr>
        <tr><td>12.</td> <td width='190px'>Orang Tua</td>                                 <td width='10px'> : </td><td> <?php echo ""; ?></td></tr>
        <tr><td></td> <td width='190px'>a. Nama Ayah</td>                                 <td width='10px'> : </td><td> <?php echo "$s[nama_ayah]"; ?></td></tr>
        <tr><td></td> <td width='190px'>b. Nama Ibu</td>                                  <td width='10px'> : </td><td> <?php echo "$s[nama_ibu]"; ?></td></tr>
        <tr><td></td> <td width='190px'>c. Alamat</td>                                    <td width='10px'> : </td><td> <?php echo "$s[alamat]"; ?></td></tr>
        <tr><td></td> <td width='190px'>d. Nomor Telepon/HP</td>                          <td width='10px'> : </td><td> <?php echo "$s[no_telpon_ayah]"; ?></td></tr>
        <tr><td>13.</td> <td width='190px'>Pekerjaan Orang Tua</td>                       <td width='10px'> : </td><td> <?php echo ""; ?></td></tr>
        <tr><td></td> <td width='190px'>a. Ayah</td>                                      <td width='10px'> : </td><td> <?php echo "$s[pekerjaan_ayah]"; ?></td></tr>
        <tr><td></td> <td width='190px'>b. Ibu</td>                                       <td width='10px'> : </td><td> <?php echo "$s[pekerjaan_ibu]"; ?></td></tr>
        <tr><td>14.</td> <td width='190px'>Wali Peserta Didik</td>                        <td width='10px'> : </td><td> <?php echo ""; ?></td></tr>
        <tr><td></td> <td width='190px'>a. Nama Wali</td>                                 <td width='10px'> : </td><td> <?php echo "$s[nama_wali]"; ?></td></tr>
        <tr><td></td> <td width='190px'>b. No Telepon/HP</td>                             <td width='10px'> : </td><td> <?php echo "-"; ?></td></tr>
        <tr><td></td> <td width='190px'>c. Alamat</td>                                    <td width='10px'> : </td><td> <?php echo "$s[alamat]"; ?></td></tr>
        <tr><td></td> <td width='190px'>d. Pekerjaan</td>                                 <td width='10px'> : </td><td> <?php echo "$s[pekerjaan_wali]"; ?></td></tr>
    </table>
    <br><br><br>
    <table width='40%' style='float:right'>
        <tr><td>Padang, <?php echo tgl_raport(date('Y-m-d')); ?> <br>
                Kepala Sekolah,<br><br><br><br>


                <b>Drs. H.AMRI JUNA, M.Pd<br>
                NIP : 196209051987031007</b></td></tr>
    </table>
</body>
</html>