<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$skp = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_sikap_semester where id_tahun_akademik='$_GET[tahun]' AND nisn='$_GET[id]' AND kode_kelas='$_GET[kelas]'")); 
?>
<html>
<head>
<title>Hal 6 - Raport Siswa</title>
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
      </table><br>";

echo "<b>C. Extrakulikuler</b>
      <table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='40px'>No</th>
            <th width='30%'>Kegiatan Extrakulikuler</th>
            <th>Nilai</th>
            <th>Deskripsi</th>
          </tr>";

          $extra = mysqli_query($koneksi,"SELECT * FROM nilai_extrakulikuler where id_tahun_akademik='$_GET[tahun]' AND nisn='$_GET[id]' AND kode_kelas='$_GET[kelas]'");
          $no = 1;
          while ($ex = mysqli_fetch_array($extra)){
            echo "<tr>
                    <td>$no</td>
                    <td>$ex[kegiatan]</td>
                    <td>$ex[nilai]</td>
                    <td>$ex[deskripsi]</td>
                  </tr>";
              $no++;
          }
      echo "</table>";

echo "<b>D. Prestasi</b>
      <table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='40px'>No</th>
            <th width='30%'>Jenis Kegiatan</th>
            <th>Keterangan</th>
          </tr>";

          $prestasi = mysqli_query($koneksi,"SELECT * FROM nilai_prestasi where id_tahun_akademik='$_GET[tahun]' AND nisn='$_GET[id]' AND kode_kelas='$_GET[kelas]'");
          $no = 1;
          while ($pr = mysqli_fetch_array($prestasi)){
            echo "<tr>
                    <td>$no</td>
                    <td>$pr[jenis_kegiatan]</td>
                    <td>$pr[keterangan]</td>
                  </tr>";
              $no++;
          }
      echo "</table>";

echo "<b>E. Ketidakhadiran</b>
      <table id='tablemodul1' width=85% border=1>
        <tr><td width='70%'>Sakit</td>  <td width='10px'> : </td> <td align=center>0</td> </tr>
        <tr><td>Izin</td>               <td> : </td>              <td align=center>0</td> </tr>
        <tr><td>Tanpa Keterangan</td>   <td> : </td>              <td align=center>0</td> </tr>
      </table>";

echo "<b>F. Catatan Wali Kelas</b>
      <table id='tablemodul1' width=100% height=80px border=1>
        <tr><td></td></tr>
      </table>";

echo "<b>G. Tanggapan Orang tua / Wali</b>
      <table id='tablemodul1' width=100% height=80px border=1>
        <tr><td></td></tr>
      </table><br/>";

?>

<table border=0 width=100%>
  <tr>
    <td width="260" align="left">Orang Tua / Wali</td>
    <td width="520"align="center">Mengetahui <br> Kepala SMA Negeri 1 Padang</td>
    <td width="260" align="left">Bukittinggi, <?php echo tgl_raport(date("Y-m-d")); ?> <br> Wali Kelas</td>
  </tr>
  <tr>
    <td align="left"><br /><br /><br />
      ................................... <br /><br /></td>

    <td align="center" valign="top"><br /><br /><br />
      <b>DRS. AMRI JUNA, M.Pd<br>
      NIP : 196209051987031007</b>
    </td>

    <td align="left" valign="top"><br /><br /><br />
      <b><?php echo $s[walikelas]; ?><br />
      NIP : <?php echo $s[nip]; ?></b>
    </td>
  </tr>
</table> 
</body>
</html>