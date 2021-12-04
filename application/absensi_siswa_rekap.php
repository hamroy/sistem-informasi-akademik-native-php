<?php if ($_GET[act] == '') { ?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php if (isset($_GET[kelas]) and isset($_GET[tahun])) {
                                echo "Rekap Absensi siswa";
                              } else {
                                echo "Rekap Absensi Siswa Pada Tahun " . date('Y');
                              } ?></h3>
        <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
          <input type="hidden" name='view' value='rekapabsensiswa'>
          <select name='tahun' style='padding:4px'>
            <?php
            echo "<option value=''>- Pilih Tahun Akademik -</option>";
            $tahun = mysqli_query($koneksi, "SELECT * FROM tahun_akademik");
            while ($k = mysqli_fetch_array($tahun)) {
              if ($_GET[tahun] == $k[id_tahun_akademik]) {
                echo "<option value='$k[id_tahun_akademik]' selected>$k[nama_tahun]</option>";
              } else {
                echo "<option value='$k[id_tahun_akademik]'>$k[nama_tahun]</option>";
              }
            }
            ?>
          </select>
          <select name='kelas' style='padding:4px'>
            <?php
            echo "<option value=''>- Pilih Kelas -</option>";
            $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($k = mysqli_fetch_array($kelas)) {
              if ($_GET[kelas] == $k[kode_kelas]) {
                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas]</option>";
              } else {
                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas]</option>";
              }
            }
            ?>
          </select>
          <input type="submit" style='margin-top:-4px' class='btn btn-success btn-sm' value='Lihat'>
        </form>

      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="example" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style='width:20px'>No</th>
              <th>Jadwal Pelajaran</th>
              <th>Kelas</th>
              <th>Guru</th>
              <th>Hari</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Ruangan</th>
              <th>Semester</th>
              <?php if ($_SESSION[level] != 'kepala') { ?>
                <th>Action</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET[kelas]) and isset($_GET[tahun])) {
              $tampil = mysqli_query($koneksi, "SELECT a.*, e.nama_kelas, b.namamatapelajaran, b.kode_pelajaran, b.kode_kurikulum, d.nama_ruangan FROM jadwal_pelajaran a 
                                            JOIN mata_pelajaran b ON a.kode_pelajaran=b.kode_pelajaran
                                                JOIN ruangan d ON a.kode_ruangan=d.kode_ruangan
                                                  JOIN kelas e ON a.kode_kelas=e.kode_kelas 
                                                  where a.kode_kelas='$_GET[kelas]' 
                                                    AND a.id_tahun_akademik='$_GET[tahun]' 
                                                      AND b.kode_kurikulum='$kurikulum[kode_kurikulum]' ORDER BY a.hari DESC");
            }
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)) {
              echo "<tr><td>$no</td>
                              <td>$r[namamatapelajaran]</td>
                              <td>$r[nama_kelas]</td>
                              <td>$r[nama_guru]</td>
                              <td>$r[hari]</td>
                              <td>$r[jam_mulai]</td>
                              <td>$r[jam_selesai]</td>
                              <td>$r[nama_ruangan]</td>
                              <td>$r[id_tahun_akademik]</td>";
              if ($_SESSION[level] != 'kepala') {
                echo "<td style='width:70px !important'><center>
                                <a class='btn btn-success btn-xs' title='Tampil List Absensi' href='index.php?view=rekapabsensiswa&act=tampilabsen&id=$r[kode_kelas]&kd=$r[kode_pelajaran]&jdwl=$r[kodejdwl]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-th'></span> Tampilkan</a>
                              </center></td>";
              }
              echo "</tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
      <?php
      if ($_GET[kelas] == '' and $_GET[tahun] == '') {
        echo "<center style='padding:60px; color:red'>Silahkan Memilih Tahun akademik dan Kelas Terlebih dahulu...</center>";
      }
      ?>
    </div>
  </div>
<?php
} elseif ($_GET[act] == 'tampilabsen') {
  $d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas where kode_kelas='$_GET[id]'"));
  $m = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mata_pelajaran where kode_pelajaran='$_GET[kd]'"));
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Rekap Data Absensi Siswa Pada $_GET[tahun]</b></h3>
                </div>
              <div class='box-body'>

              <div class='col-md-12'>
              <table class='table table-condensed table-hover'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_kelas]'>
                    <tr><th width='120px' scope='row'>Kode Kelas</th> <td>$d[kode_kelas]</td></tr>
                    <tr><th scope='row'>Nama Kelas</th>               <td>$d[nama_kelas]</td></tr>
                    <tr><th scope='row'>Mata Pelajaran</th>           <td>$m[namamatapelajaran]</td></tr>
                  </tbody>
              </table>
              </div>

              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered table-striped'>
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Pertemuan</th>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpa</th>
                        <th><center>% Kehadiran</center></th>
                      </tr>
                    </thead>
                    <tbody>";

  $no = 1;
  $tampil = mysqli_query($koneksi, "SELECT * FROM siswa a JOIN jenis_kelamin b ON a.jenis_kelamin=b.kode_jeniskelamin where a.kode_kelas='$_GET[id]' ORDER BY a.id_siswa");
  while ($r = mysqli_fetch_array($tampil)) {
    $total = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `absensi_siswa` where kodejdwl='$_GET[jdwl]' GROUP BY tanggal"));
    $hadir = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `absensi_siswa` where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND kode_kehadiran='H'"));
    $sakit = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `absensi_siswa` where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND kode_kehadiran='S'"));
    $izin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `absensi_siswa` where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND kode_kehadiran='I'"));
    $alpa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `absensi_siswa` where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND kode_kehadiran='A'"));
    $persen = $hadir / ($total) * 100;
    echo "<tr bgcolor=$warna>
                            <td>$no</td>
                            <td>$r[nisn]</td>
                            <td>$r[nama]</td>
                            <td>$r[jenis_kelamin]</td>
                            <td align=center>$total</td>
                            <td align=center>$hadir</td>
                            <td align=center>$sakit</td>
                            <td align=center>$izin</td>
                            <td align=center>$alpa</td>
                            <td align=right>" . number_format($persen, 2) . " %</td>";
    echo "</tr>";
    $no++;
  }

  echo "</tbody>
                  </table>
                </div>
              </div>
            </div>";
}
?>