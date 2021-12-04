<?php if ($_GET[act] == '') { ?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Mata Pelajaran </h3>
        <?php if ($_SESSION[level] != 'kepala') { ?>
          <a class='pull-right btn btn-primary btn-sm' href='index.php?view=matapelajaran&act=tambah'>Tambahkan Data</a>
        <?php } ?>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style='width:30px'>No</th>
              <th>Kode Mapel</th>
              <th>Nama Mapel</th>
              <!-- <th>Jurusan</th> -->
              <th>Tingkat</th>
              <th>Guru Pengampu</th>
              <th>Urutan</th>
              <?php if ($_SESSION[level] != 'kepala') { ?>
                <th style='width:70px'>Action</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran a 
                                              LEFT JOIN kelompok_mata_pelajaran b ON a.id_kelompok_mata_pelajaran=b.id_kelompok_mata_pelajaran
                                                    where a.kode_kurikulum='$kurikulum[kode_kurikulum]'
                                                      ORDER BY a.urutan ASC");
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)) {
              $sql = "SELECT * FROM tbl_peg where nik='$r[nip]'";
              $nama_guru = "Belum Memilih";
              if ($result = mysqli_query($koneksi2, $sql)) {
                while ($row = mysqli_fetch_row($result)) {
                  $nama_guru = $row[1];
                }
              }
              echo "<tr><td>$no</td>
                              <td>$r[kode_pelajaran]</td>
                              <td>$r[namamatapelajaran]</td>
                              <td>$r[tingkat]</td>
                              <td>$nama_guru</td>
                              <td>$r[urutan]</td>";
              if ($_SESSION[level] != 'kepala') {
                echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Detail Data' href='?view=matapelajaran&act=detail&id=$r[kode_pelajaran]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=matapelajaran&act=edit&id=$r[kode_pelajaran]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=matapelajaran&hapus=$r[kode_pelajaran]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
              }
              echo "</tr>";
              $no++;
            }
            if (isset($_GET[hapus])) {
              mysqli_query($koneksi, "DELETE FROM mata_pelajaran where kode_pelajaran='$_GET[hapus]'");
              echo "<script>document.location='index.php?view=matapelajaran';</script>";
            }

            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
<?php
} elseif ($_GET[act] == 'edit') {
  if (isset($_POST[update])) {
    mysqli_query($koneksi, "UPDATE mata_pelajaran SET kode_pelajaran = '$_POST[a]',
                                         id_kelompok_mata_pelajaran = '$_POST[b]',
                                         kode_jurusan = '$_POST[c]',
                                         nip = '$_POST[d]',
                                         kode_kurikulum = '$_POST[e]',
                                         namamatapelajaran = '$_POST[f]',
                                         namamatapelajaran_en = '$_POST[g]',
                                         tingkat = '$_POST[h]',
                                         kompetensi_umum = '$_POST[i]',
                                         kompetensi_khusus = '$_POST[j]',
                                         jumlah_jam = '$_POST[k]',
                                         sesi = '$_POST[n]',
                                         urutan = '$_POST[l]',
                                         aktif = '$_POST[m]' where kode_pelajaran='$_POST[id]'");
    echo "<script>document.location='index.php?view=matapelajaran';</script>";
  }
  $edit = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran where kode_pelajaran='$_GET[id]'");
  $s = mysqli_fetch_array($edit);
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_pelajaran]'>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td><select class='form-control' name='e'> 
                             <option value='0' selected>- Pilih Kurikulum -</option>";
  $kurikulum = mysqli_query($koneksi, "SELECT * FROM kurikulum");
  while ($a = mysqli_fetch_array($kurikulum)) {
    if ($s[kode_kurikulum] == $a[kode_kurikulum]) {
      echo "<option value='$a[kode_kurikulum]' selected>$a[nama_kurikulum]</option>";
    } else {
      echo "<option value='$a[kode_kurikulum]'>$a[nama_kurikulum]</option>";
    }
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td><input type='text' class='form-control' name='a' value='$s[kode_pelajaran]'> </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td><input type='text' class='form-control' name='f' value='$s[namamatapelajaran]'></td></tr>
                    <tr><th scope='row'>Nama Mapel En</th>        <td><input type='text' class='form-control' name='g' value='$s[namamatapelajaran_en]'></td></tr>
                    <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='c'> 
                             <option value='0' selected>- Pilih Jurusan -</option>";
  $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
  while ($a = mysqli_fetch_array($jurusan)) {
    if ($s[kode_jurusan] == $a[kode_jurusan]) {
      echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
    } else {
      echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
    }
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Guru Pengampu</th> <td><select class='form-control' name='d'> 
                             <option value='0' selected>- Pilih Guru Pengampu -</option>";
  $guru = mysqli_query($koneksi2, "SELECT * FROM tbl_peg");
  while ($a = mysqli_fetch_array($guru)) {
    if ($s[nip] == $a[nik]) {
      echo "<option value='$a[nik]' selected>$a[nama]</option>";
    } else {
      echo "<option value='$a[nik]'>$a[nama]</option>";
    }
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td><input type='text' class='form-control' name='h' value='$s[tingkat]'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>           <td><input type='text' class='form-control' name='i' value='$s[kompetensi_umum]'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>           <td><input type='text' class='form-control' name='j' value='$s[kompetensi_khusus]'></td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td><input type='text' class='form-control' name='k' value='$s[jumlah_jam]'></td></tr>
                    <tr><th scope='row'>Urutan</th>           <td><input type='text' class='form-control' name='l' value='$s[urutan]'></td></tr>
                    <tr><th scope='row'>Sesi</th>           <td><input type='text' class='form-control' name='n' value='$s[sesi]'></td></tr>
                    <tr><th scope='row'>Kelompok</th> <td><select class='form-control' name='b'> 
                             <option value='0' selected>- Pilih Kelompok Mata Pelajaran -</option>";
  $kelompok = mysqli_query($koneksi, "SELECT * FROM kelompok_mata_pelajaran");
  while ($a = mysqli_fetch_array($kelompok)) {
    if ($s[id_kelompok_mata_pelajaran] == $a[id_kelompok_mata_pelajaran]) {
      echo "<option value='$a[id_kelompok_mata_pelajaran]' selected>$a[nama_kelompok_mata_pelajaran]</option>";
    } else {
      echo "<option value='$a[id_kelompok_mata_pelajaran]'>$a[nama_kelompok_mata_pelajaran]</option>";
    }
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
  if ($s[aktif] == 'Ya') {
    echo "<input type='radio' name='m' value='Ya' checked> Ya
                                                                             <input type='radio' name='m' value='Tidak'> Tidak";
  } else {
    echo "<input type='radio' name='m' value='Ya'> Ya
                                                                             <input type='radio' name='m' value='Tidak' checked> Tidak";
  }
  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
} elseif ($_GET[act] == 'tambah') {
  if (isset($_POST[tambah])) {
    mysqli_query($koneksi, "INSERT INTO mata_pelajaran VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]',
                                                          '$_POST[g]','$_POST[h]','$_POST[i]','$_POST[j]','$_POST[k]','$_POST[n]','$_POST[l]','$_POST[m]')");
    echo "<script>document.location='index.php?view=matapelajaran';</script>";
  }

  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td><select class='form-control' name='e'> 
                             <option value='0' selected>- Pilih Kurikulum -</option>";
  $kurikulum = mysqli_query($koneksi, "SELECT * FROM kurikulum");
  while ($a = mysqli_fetch_array($kurikulum)) {
    echo "<option value='$a[kode_kurikulum]'>$a[nama_kurikulum]</option>";
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td><input type='text' class='form-control' name='a' value='$s[kode_pelajaran]'> </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td><input type='text' class='form-control' name='f' value='$s[namamatapelajaran]'></td></tr>
                    <tr><th scope='row'>Nama Mapel En</th>        <td><input type='text' class='form-control' name='g' value='$s[namamatapelajaran_en]'></td></tr>
                    ";
  echo "<input type='hidden' name='c' value='0'>"; //JURUSAN - Tinggat SMA
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Guru Pengampu</th> <td><select class='form-control' name='d'> 
                             <option value='0' selected>- Pilih Guru Pengampu -</option>";

  $guru = mysqli_query($koneksi2, "SELECT * FROM tbl_peg");
  while ($a = mysqli_fetch_array($guru)) {
    echo "<option value='$a[nik]'>$a[nama]</option>";
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td><input type='text' class='form-control' name='h' value='$s[tingkat]'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>           <td><input type='text' class='form-control' name='i' value='$s[kompetensi_umum]'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>           <td><input type='text' class='form-control' name='j' value='$s[kompetensi_khusus]'></td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td><input type='text' class='form-control' name='k' value='$s[jumlah_jam]'></td></tr>
                    <tr><th scope='row'>Urutan</th>           <td><input type='text' class='form-control' name='l' value='$s[urutan]'></td></tr>
                    <tr><th scope='row'>Sesi</th>           <td><input type='text' class='form-control' name='n'></td></tr>
                    <tr><th scope='row'>Kelompok</th> <td><select class='form-control' name='b'> 
                             <option value='0' selected>- Pilih Kelompok Mata Pelajaran -</option>";
  $kelompok = mysqli_query($koneksi, "SELECT * FROM kelompok_mata_pelajaran");
  while ($a = mysqli_fetch_array($kelompok)) {
    echo "<option value='$a[id_kelompok_mata_pelajaran]'>$a[nama_kelompok_mata_pelajaran]</option>";
  }
  echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='m' value='Ya' checked> Ya
                                                                             <input type='radio' name='m' value='Tidak'> Tidak</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
} elseif ($_GET[act] == 'detail') {
  $edit = mysqli_query($koneksi, "SELECT a.*, b.nama_kelompok_mata_pelajaran, d.nama_kurikulum FROM mata_pelajaran a 
                                              JOIN kelompok_mata_pelajaran b ON a.id_kelompok_mata_pelajaran=b.id_kelompok_mata_pelajaran
                                                  JOIN kurikulum d ON a.kode_kurikulum=d.kode_kurikulum
                                                      where a.kode_pelajaran='$_GET[id]'");
  $s = mysqli_fetch_array($edit);
  echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td>$s[nama_kurikulum]</td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td>$s[kode_pelajaran] </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td>$s[namamatapelajaran]</td></tr>
                    <tr><th scope='row'>Nama Mapel En</th>        <td>$s[namamatapelajaran_en]</td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td>$s[tingkat]</td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>      <td>$s[kompetensi_umum]</td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>    <td>$s[kompetensi_khusus]</td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td>$s[jumlah_jam]</td></tr>
                    <tr><th scope='row'>Urutan</th>               <td>$s[urutan]</td></tr>
                    <tr><th scope='row'>Sesi</th>                 <td>$s[sesi]</td></tr>
                    <tr><th scope='row'>Kelompok</th>             <td>$s[nama_kelompok_mata_pelajaran]</td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>$s[aktif]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>