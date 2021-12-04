<?php
if ($_GET[act] == '') {
  if (isset($_GET[gettanggal])) {
    $filtertgl = $_GET[gettanggal];
  } else {
    if (isset($_POST[tgl])) {
      $tgl = $_POST[tgl];
    } else {
      $tgl = date("d");
    }
    if (isset($_POST[bln])) {
      $bln = $_POST[bln];
    } else {
      $bln = date("m");
    }
    if (isset($_POST[thn])) {
      $thn = $_POST[thn];
    } else {
      $thn = date("Y");
    }
    $lebartgl = strlen($tgl);
    $lebarbln = strlen($bln);

    switch ($lebartgl) {
      case 1: {
          $tglc = "0" . $tgl;
          break;
        }
      case 2: {
          $tglc = $tgl;
          break;
        }
    }

    switch ($lebarbln) {
      case 1: {
          $blnc = "0" . $bln;
          break;
        }
      case 2: {
          $blnc = $bln;
          break;
        }
    }
    $filtertgl = $thn . "-" . $blnc . "-" . $tglc;
  }
  $ex = explode('-', $filtertgl);
  $tahun = $ex[0];
  $bulane = $ex[1];
  $tanggal = $ex[2];
  if (substr($tanggal, 0, 1) == '0') {
    $tgle = substr($tanggal, 1, 1);
  } else {
    $tgle = substr($tanggal, 0, 2);
  }
  if (substr($bulane, 0, 1) == '0') {
    $blnee = substr($bulane, 1, 1);
  } else {
    $blnee = substr($bulane, 0, 2);
  }
?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Absensi Guru Pada : <b style='color:red'><?php echo tgl_indo("$filtertgl") . "</b>"; ?> </h3>
        <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
          <input type="hidden" name='view' value='absenguru'>
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
        <div style="clear:both"></div>

        <?php
        echo "<div class='col-md-7 pull-right' style='margin:5px -14px 5px 0px'>
                  <form action='index.php?view=absenguru' method='POST' style='margin-bottom:5px'>
                          <div class='col-xs-3'><select name='tgl' class='form-control'><option selected>- Tanggal -</option>";
        for ($n = 1; $n <= 31; $n++) {
          if ($tgle == $n) {
            echo "<option value='$n' selected>$n</option>";
          } else {
            echo "<option value='$n'>$n</option>";
          }
        }
        echo "</select></div> <div class='col-xs-4'><select name='bln' class='form-control'><option selected>- Bulan -</option>";
        $blnn = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        for ($n = 1; $n <= 12; $n++) {
          if ($blnee == $n) {
            echo "<option value='$n' selected>$blnn[$n]</option>";
          } else {
            echo "<option value='$n'>$blnn[$n]</option>";
          }
        }
        echo "</select></div> <div class='col-xs-3'><select name='thn' class='form-control'><option selected>- Tahun -</option>";
        $tahunn = date("Y");
        for ($n = 2015; $n <= $tahunn; $n++) {
          if ($tahunn == $n) {
            echo "<option value='$n' selected>$n</option>";
          } else {
            echo "<option value='$n'>$n</option>";
          }
        }
        echo "</select></div> 
                                  <input name='lihat' class='btn btn-primary' type='submit' value='Lihat Absen'>
                        </form></div>";
        ?>
      </div><!-- /.box-header -->
      <form action='' method="POST">
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
                <th width='90px'>Kehadiran</th>
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
                if (isset($_GET[gettanggal])) {
                  $sekarangabsen = $_GET[gettanggal];
                } else {
                  if (isset($_POST[lihat])) {
                    $sekarangabsen = $thn . "-" . $blnc . "-" . $tglc;
                  } else {
                    $sekarangabsen = date("Y-m-d");
                  }
                }

                $a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi_guru where kodejdwl='$r[kodejdwl]' AND nip='$r[nip]' AND tanggal='$sekarangabsen'"));
                echo "<tr><td>$no</td>
                              <td>$r[namamatapelajaran]</td>
                              <td>$r[nama_kelas]</td>
                              <td>$r[nama_guru]</td>
                              <td>$r[hari]</td>
                              <td>$r[jam_mulai]</td>
                              <td>$r[jam_selesai]</td>
                              <td>$r[nama_ruangan]</td>
                              <input type='hidden' value='$r[nip]' name='nip[$no]'>
                              <input type='hidden' value='$r[kode_pelajaran]' name='kode_pelajaran[$no]'>
                              <input type='hidden' value='$r[kode_kelas]' name='kode_kelas[$no]'>
                              <td><select style='width:100px;' name='a[$no]' class='form-control'>";
                $kehadiran = mysqli_query($koneksi, "SELECT * FROM kehadiran");
                while ($k = mysqli_fetch_array($kehadiran)) {
                  if ($a[kode_kehadiran] == $k[kode_kehadiran]) {
                    echo "<option value='$k[kode_kehadiran]' selected>&#42; $k[nama_kehadiran]</option>";
                  } else {
                    echo "<option value='$k[kode_kehadiran]'>$k[nama_kehadiran]</option>";
                  }
                }
                echo "</select></td>
                                    <input type='hidden' name='jdwl[$no]' value='$r[kodejdwl]'>
                              </tr>";
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
        <div class='box-footer'>
          <?php
          echo "<input type='hidden' name='filtertgl' value='$filtertgl'>";
          ?>
          <button type='submit' name='simpan' class='btn btn-info pull-right'>Simpan Absensi</button>
        </div>

      </form>
    </div><!-- /.box -->
  </div>
<?php
  if (isset($_POST[simpan])) {
    $jml_data = count($_POST[nip]);
    $nip = $_POST[nip];
    $kode_pelajaran = $_POST[kode_pelajaran];
    $kode_kelas = $_POST[kode_kelas];
    $jdwl = $_POST[jdwl];
    $a = $_POST[a];

    $tglabsen = $_POST[filtertgl];
    for ($i = 1; $i <= $jml_data; $i++) {
      $cek = mysqli_query($koneksi, "SELECT * FROM absensi_guru where kodejdwl='" . $jdwl[$i] . "' AND nip='" . $nip[$i] . "' AND tanggal='$tglabsen'");
      $total = mysqli_num_rows($cek);
      if ($total >= 1) {
        mysqli_query($koneksi, "UPDATE absensi_guru SET kode_kehadiran = '" . $a[$i] . "' where nip='" . $nip[$i] . "' AND kodejdwl='" . $jdwl[$i] . "' AND tanggal='$tglabsen'");
      } else {
        mysqli_query($koneksi, "INSERT INTO absensi_guru VALUES ('',
                                                              '" . $jdwl[$i] . "',
                                                              '" . $nip[$i] . "',
                                                              '" . $a[$i] . "',
                                                              '$tglabsen',
                                                              '" . date('Y-m-d H:i:s') . "')");
      }
    }
    echo "<script>document.location='index.php?view=absenguru&tahun=" . $_GET[tahun] . "&kelas=" . $_GET[kelas] . "';</script>";
  }
}
?>