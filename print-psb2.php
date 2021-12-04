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
            echo "<h3><center>YAYASAN PENDIDIKAN PHPMU <br> DATA-DATA MURID TK/SD/SMP/SMK</center></h3>
                  <table width='100%'>
                      <tr><td colspan='3'>1. Nama Siswa</td></tr>
                      <tr><td width='160px' style='padding-left:19px'>a. Lengkap</td>         <td>:</td> <td>$s[nama]</td></tr>
                      <tr><td style='padding-left:19px'>b. Panggilan</td>         <td>:</td> <td>$s[nama_panggilan]</td></tr>

                      <tr><td>2. No Induk</td>           <td>:</td> <td>$s[no_induk]</td></tr>
                      <tr><td>3. Jenis Kelamin</td>      <td>:</td> <td>$s[jenis_kelamin]</td></tr>
                      <tr><td>4. Tempat / Tgl Lahir</td> <td>:</td> <td>$s[tempat_lahir], ".tgl_indo($s[tanggal_lahir])."</td></tr>
                      
                      <tr><td>5. Agama</td>              <td>:</td> <td>$s[nama_agama]</td></tr>
                      <tr><td>6. Anak Ke</td>            <td>:</td> <td>$s[anak_ke]</td></tr>
                      <tr><td>7. Jumlah Saudara</td>     <td>:</td> <td>$s[jumlah_saudara]</td></tr>
                      <tr><td>8. Status Dalam Keluarga</td><td>:</td> <td>$s[status_dalam_keluarga]</td></tr>
                      <tr><td></td><td></td> <td>Telp. $s[no_telpon]</td></tr>
                      <tr><td>9. Alamat Rumah</td>       <td>:</td> <td>$s[alamat_siswa]</td></tr>

                      <tr><td colspan='3'>10. Keadaan Jasmani</td></tr>
                      <tr><td style='padding-left:23px'>a. Berat Badan</td>            <td>:</td> <td>$s[berat_badan]</td></tr>
                      <tr><td style='padding-left:23px'>b. Tinggi Badan</td>            <td>:</td> <td>$s[tinggi_badan]</td></tr>
                      <tr><td style='padding-left:23px'>c. Golongan Darah</td>            <td>:</td> <td>$s[golongan_darah]</td></tr>
                      <tr><td style='padding-left:23px'>d. Penyakit Pernah Diderita</td>            <td>:</td> <td>$s[penyakit_pernah_diderita]</td></tr>

                      <tr><td colspan='3'>11. Diterima Di Sekolah Ini</td></tr>
                      <tr><td style='padding-left:23px'>a. Di Kelas</td>            <td>:</td> <td>$s[diterima_dikelas]</td></tr>
                      <tr><td style='padding-left:23px'>b. Pada tanggal / Tahun</td>            <td>:</td> <td>".tgl_indo($s[diterima_tanggal])."</td></tr>

                      <tr><td colspan='3'>12. Sekolah Asal</td></tr>
                      <tr><td style='padding-left:23px'>a. Nama Sekolah</td>            <td>:</td> <td>$s[sekolah_asal]</td></tr>
                      <tr><td style='padding-left:23px'>b. Alamat Sekolah</td>            <td>:</td> <td>$s[alamat_sekolah_asal]</td></tr>


                      <tr><td colspan='3'><br><u>Keterangan Orang Tua Wali Murid</u></td></tr>
                      <tr><td colspan='3'>13. Ayah</td></tr>
                      <tr><td style='padding-left:23px'>a. Nama Ayah</td>            <td>:</td> <td>$s[nama_ayah]</td></tr>
                      <tr><td style='padding-left:23px'>b. Tempat / Tanggal Lahir</td>            <td>:</td> <td>$s[tempat_lahir_ayah], ".tgl_indo($s[tanggal_lahir_ayah])."</td></tr>
                      <tr><td style='padding-left:23px'>c. Agama</td>            <td>:</td> <td>$s[nama_agama_ayah]</td></tr>
                      <tr><td style='padding-left:23px'>d. Pendidikan Tertinggi</td>            <td>:</td> <td>$s[pendidikan_ayah]</td></tr>
                      <tr><td style='padding-left:23px'>e. Pekerjaan</td>            <td>:</td> <td>$s[pekerjaan_ayah]</td></tr>
                      <tr><td style='padding-left:23px'>f. Alamat / Telepon Rumah</td>            <td>:</td> <td>$s[alamat_rumah_ayah] / $s[telpon_rumah_ayah]</td></tr>
                      <tr><td style='padding-left:23px'>h. Alamat / Telepon Kantor</td>            <td>:</td> <td>$s[alamat_kantor_ayah] / $s[telpon_kantor_ayah]</td></tr>

                      <tr><td colspan='3'>14. Ibu</td></tr>
                      <tr><td style='padding-left:23px'>a. Nama Ibu</td>            <td>:</td> <td>$s[nama_ibu]</td></tr>
                      <tr><td style='padding-left:23px'>b. Tempat / Tanggal Lahir</td>            <td>:</td> <td>$s[tempat_lahir_ibu], ".tgl_indo($s[tanggal_lahir_ibu])."</td></tr>
                      <tr><td style='padding-left:23px'>c. Agama</td>            <td>:</td> <td>$s[nama_agama_ibu]</td></tr>
                      <tr><td style='padding-left:23px'>d. Pendidikan Tertinggi</td>            <td>:</td> <td>$s[pendidikan_ibu]</td></tr>
                      <tr><td style='padding-left:23px'>e. Pekerjaan</td>            <td>:</td> <td>$s[pekerjaan_ibu]</td></tr>
                      <tr><td style='padding-left:23px'>f. Alamat / Telepon Rumah</td>            <td>:</td> <td>$s[alamat_rumah_ibu] / Telp. $s[telpon_rumah_ibu]</td></tr>
                      <tr><td style='padding-left:23px'>g. Alamat / Telepon Kantor</td>            <td>:</td> <td>$s[alamat_kantor_ibu] / Telp. $s[telpon_kantor_ibu]</td></tr>

                      <tr><td colspan='3'>15. Wali</td></tr>
                      <tr><td style='padding-left:23px'>a. Nama Wali</td>       <td>:</td> <td>$s[nama_wali]</td></tr>
                      <tr><td style='padding-left:23px'>b. Alamat Wali</td><td>:</td> <td>$s[alamat_wali]</td></tr>
                      <tr><td style='padding-left:23px'>c. No Telepon</td>  <td>:</td> <td>$s[no_telpon_wali]</td></tr>
                  </table>";

?>

<br><br>
<table border=0 width=100%>
  <tr>
    <td width="400" align="center"></td>
    <td width="400" align="center">Padang, <?php echo tgl_raport(date("Y-m-d")); ?> <br> Mengetahui: orang tua / wali</td>
  </tr>
  <tr>
    <td align="center"><br /></td>

    <td align="center"><br /><br />
      ................................... <br /><br /></td>
  </tr>
</table> 
</body>