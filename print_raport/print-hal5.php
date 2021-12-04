<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$frt = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM header_print ORDER BY id_header_print DESC LIMIT 1")); 
?>
<head>
<title>Hal 5 - Raport Siswa</title>
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

echo "DESKRIPSI PENGETAHUAN DAN KETERAMPILAM
<table id='tablemodul1' width=100% style='margin-top:2px' border=1>
          <tr>
            <th width='160px' colspan='2'>Mata Pelajaran</th>
            <th width='140px'>Aspek</th>
            <th>Deskripsi</th>
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
        $maxn = mysqli_fetch_array(mysqli_query($koneksi,"SELECT ((nilai1+nilai2+nilai3+nilai4+nilai5)/5) as rata_rata, deskripsi FROM nilai_pengetahuan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
        $maxnk = mysqli_fetch_array(mysqli_query($koneksi,"SELECT deskripsi, GREATEST(nilai1,nilai2,nilai3,nilai4,nilai5,nilai6) as tertinggi FROM nilai_keterampilan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY tertinggi DESC LIMIT 1"));
        echo "<tr>
                <td width='30px' rowspan=2 align=center>$no</td>
                <td width='160px' rowspan=2>$m[namamatapelajaran]</td>
                <td>Pengetahuan</td>
                <td>$maxn[deskripsi]</td>
            </tr>
            <tr>
                <td>Keterampilan</td>
                <td>$maxnk[deskripsi]</td>
            </tr>";
        $no++;
        }
      }

        echo "</table><br/>";
?>
</body>