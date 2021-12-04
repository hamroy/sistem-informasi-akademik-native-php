<?php 
session_start();
error_reporting(0);
include "config/koneksi.php"; 
include "config/fungsi_indotgl.php"; 
?>
<head>
<title>Data Penerimaan Siswa Baru</title>
<link rel="stylesheet" href="bootstrap/css/printer.css">
</head>
<body onload="window.print()">
<?php
    $detail = mysqli_query($koneksi,"SELECT a.*, b.*, c.nama_agama, d.nama_agama as nama_agama_ayah, e.nama_agama as nama_agama_ibu 
                            FROM psb_pendaftaran a JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin
                              JOIN agama c ON a.id_agama=c.id_agama 
                                JOIN agama d ON a.agama_ayah=d.id_agama 
                                  JOIN agama e ON a.agama_ibu=e.id_agama 
                                    where a.id_pendaftaran='$_GET[id]'");
    $s = mysqli_fetch_array($detail);
            echo "<table width=100%>
                      <tr><td width='90px'><img style='width:80px' src='print_raport/logo.png'>
                          </td><td><b>$status PHPMU <br> BUSINESS SCHOOL </b><br> Jl.AR Hakim No.57 Telp. (0751) xxxxx Padang</td></tr>
                  </table><hr>";
            echo "<h3><center>FORMULIR PENDAFTARAN <br>DATA SISWA</center></h3>
                  <table width='100%'>
                      <tr><td width='160px'>Nama Siswa</td>         <td>:</td> <td>$s[nama]</td></tr>
                      <tr><td>Tempat / Tgl Lahir</td> <td>:</td> <td>$s[tempat_lahir], ".tgl_indo($s[tanggal_lahir])."</td></tr>
                      <tr><td>Jenis Kelamin</td>      <td>:</td> <td>$s[jenis_kelamin]</td></tr>
                      <tr><td>Agama</td>              <td>:</td> <td>$s[nama_agama]</td></tr>
                      <tr><td>Status Anak</td>        <td>:</td> <td>$s[status_dalam_keluarga]</td></tr>
                      <tr><td>Anak Ke</td>            <td>:</td> <td>$s[anak_ke]</td></tr>
                      <tr><td>Alamat Rumah</td>       <td>:</td> <td>$s[alamat_siswa]</td></tr>
                      <tr><td>Telepon</td>            <td>:</td> <td>$s[no_telpon]</td></tr>
                      <tr><td>Sekolah Asal</td>       <td>:</td> <td>$s[sekolah_asal]</td></tr>
                      <tr><td>Alamat Sekolah Asal</td><td>:</td> <td>$s[alamat_sekolah_asal]</td></tr>
                      <tr><td>Kelas Yang Dituju</td>  <td>:</td> <td>$s[diterima_dikelas]</td></tr>
                  </table>

                  <h3><center>DATA ORANG TUA / WALI SISWA</center></h3>
                  <table width='100%' id='tablemodul1'>
                  <tr>
                    <th><center>Keterangan</center></th>
                    <th><center>Data Ayah</center></th>
                    <th><center>Data Ibu</center></th>
                  </tr>
                  <tr>
                    <td width='170px'>Nama Lengkap</td>
                    <td>$s[nama_ayah]</td>
                    <td>$s[nama_ibu]</td>
                  </tr>
                  <tr>
                    <td>Tempat / Tgl Lahir</td>
                    <td>$s[tempat_lahir_ayah], ".tgl_indo($s[tanggal_lahir_ayah])."</td>
                    <td>$s[tempat_lahir_ibu], ".tgl_indo($s[tanggal_lahir_ibu])."</td>
                  </tr>
                  <tr>
                    <td>Pekerjaan</td>
                    <td>$s[pekerjaan_ayah]</td>
                    <td>$s[pekerjaan_ibu]</td>
                  </tr>
                  <tr>
                    <td>Alamat Tempat Kerja</td>
                    <td>$s[alamat_kantor_ayah]</td>
                    <td>$s[alamat_kantor_ibu]</td>
                  </tr>
                  <tr>
                    <td>Telepon / Handphone</td>
                    <td>$s[telpon_rumah_ayah]</td>
                    <td>$s[telpon_rumah_ibu]</td>
                  </tr>
                  <tr>
                    <td>Telepon Kantor</td>
                    <td>$s[telpon_kantor_ayah]</td>
                    <td>$s[telpon_kantor_ibu]</td>
                  </tr>
                  <tr>
                    <td>Alamat Rumah</td>
                    <td>$s[alamat_rumah_ayah]</td>
                    <td>$s[alamat_rumah_ibu]</td>
                  </tr>
                  <tr>
                    <td>Telepon Rumah</td>
                    <td>$s[telpon_rumah_ayah]</td>
                    <td>$s[telpon_rumah_ibu]</td>
                  </tr>
                </table>";

                echo "<h3><center>DATA SAUDARA</center></h3>
                <table width='100%' id='tablemodul1'>
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Umur</th>
                      <th>Pendidikan</th>
                  </tr>";
                $no = 1;
                $saudara = mysqli_query($koneksi,"SELECT * FROM psb_pendaftaran_saudara where id_pendaftaran='$_GET[id]'");
                while ($sa = mysqli_fetch_array($saudara)){
                    echo "<tr>
                              <td>$no</td>
                              <td>$sa[nama_saudara]</td>
                              <td>$sa[umur_saudara] Tahun</td>
                              <td>$sa[pendidikan_saudara]</td>
                          </tr>";
                  $no++;
                }
                echo "</table>";


?>
Saya yang bertanda tangan dibawah ini , mendaftarkan anak saya sebagai siswa/i dan bersedia mengikuti persyaratan dan peraturan yang berlaku.
<br>
<table border=0 width=100%>
  <tr>
    <td width="400" align="left"><br>Padang, <?php echo tgl_raport(date("Y-m-d")); ?></td>
  </tr>
  <tr>
    <td align="left"><br /><br />
      ................................... </td>

  </tr>
</table> 
</body>