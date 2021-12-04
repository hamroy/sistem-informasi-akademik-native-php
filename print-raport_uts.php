<?php 
session_start();
error_reporting(0);
include "config/koneksi.php"; 
include "config/fungsi_indotgl.php"; 
$frt = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM header_print ORDER BY id_header_print DESC LIMIT 1")); 
?>
<head>
<title>Raport Siswa</title>
<link rel="stylesheet" href="bootstrap/css/printer.css">
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

echo "<table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='160px' colspan='2' rowspan='2'>Mata Pelajaran</th>
            <th rowspan='2'>KKM</th>
            <th colspan='2' style='text-align:center'>Pengetahuan</th>
            <th colspan='2' style='text-align:center'>Keterampilan</th>
          </tr>
          <tr>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Nilai</th>
            <th>Predikat</th>
          </tr>";
      $kelompok = mysqli_query($koneksi,"SELECT * FROM kelompok_mata_pelajaran");  
      while ($k = mysqli_fetch_array($kelompok)){
      echo "<tr>
            <td colspan='7'><b>$k[nama_kelompok_mata_pelajaran]</b></td>
          </tr>";
        $mapel = mysqli_query($koneksi,"SELECT * FROM  jadwal_pelajaran a JOIN mata_pelajaran b ON a.kode_pelajaran=b.kode_pelajaran 
                                  where a.kode_kelas='$_GET[kelas]' AND a.id_tahun_akademik='$_GET[tahun]' AND b.id_kelompok_mata_pelajaran='$k[id_kelompok_mata_pelajaran]'");
        $no = 1;
        while ($m = mysqli_fetch_array($mapel)){
          $n = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_uts where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]'"));
          $cekpredikat = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[kelas]'"));
                      if ($cekpredikat >= 1){
                        $grade1 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where ($n[angka_pengetahuan] >=nilai_a) AND ($n[angka_pengetahuan] <= nilai_b) AND kode_kelas='$_GET[kelas]'"));
                        $grade2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where ($n[angka_keterampilan] >=nilai_a) AND ($n[angka_keterampilan] <= nilai_b) AND kode_kelas='$_GET[kelas]'"));
                      }else{
                        $grade1 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where ($n[angka_pengetahuan] >=nilai_a) AND ($n[angka_pengetahuan] <= nilai_b) AND kode_kelas='0'"));
                        $grade2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where ($n[angka_keterampilan] >=nilai_a) AND ($n[angka_keterampilan] <= nilai_b) AND kode_kelas='0'"));
                      }
        echo "<tr>
                <td align=center>$no</td>
                <td>$m[namamatapelajaran]</td>
                <td align=center>77</td>
                <td align=center>".number_format($n[angka_pengetahuan])."</td>
                <td align=center>$grade1[grade]</td>
                <td align=center>".number_format($n[angka_keterampilan])."</td>
                <td align=center>$grade2[grade]</td>
            </tr>";
        $no++;
        }
      }

		echo "</table><br/>";
        $cekpredikat2 = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[kelas]'"));
        if ($cekpredikat2 >= 1){
          $grade = mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[kelas]'");
          $gradea = mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[kelas]'");
          $total = mysqli_num_rows($grade);
        }else{
          $grade = mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='0'");
          $gradea = mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='0'");
          $total = mysqli_num_rows($grade);
        }
          echo "<center><table width='90%' border=1 id='tablemodul1'>
              <tr>
                  <th rowspan='2'>KKM</th>
                  <th colspan='$total'>Predikat</th>
              </tr>
              <tr>";
                  while ($g = mysqli_fetch_array($grade)){
                      echo "<th>$g[grade] = $g[keterangan]</th>";
                  }
              echo "</tr>
              <tr>
                  <th>77</th>";
                  while ($p = mysqli_fetch_array($gradea)){
                      echo "<th>$p[nilai_a] - $p[nilai_b]</th>";
                  }
              echo "</tr>
          </table></center><br>";
?>
<table border=0 width=100%>
  <tr>
    <td width="260" align="left">Orang Tua / Wali</td>
    <td width="520"align="center">Mengetahui <br> Kepala SMA Negeri 1 Padang</td>
    <td width="260" align="left">Padang, <?php echo tgl_raport(date("Y-m-d")); ?> <br> Wali Kelas</td>
  </tr>
  <tr>
    <td align="left"><br /><br /><br /><br /><br />
      ................................... <br /><br /></td>

    <td align="center" valign="top"><br /><br /><br /><br /><br />
      <b>DRS. AMRI JUNA, M.Pd<br>
      NIP : 196209051987031007</b>
    </td>

    <td align="left" valign="top"><br /><br /><br /><br /><br />
      <b><?php echo $s[walikelas]; ?><br />
      NIP : <?php echo $s[nip]; ?></b>
    </td>
  </tr>
</table> 
</body>