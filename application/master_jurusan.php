<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Jurusan </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=jurusan&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Bidang Keahlian</th>
                        <th>Kompetensi Umum</th>
                        <th>Kompetensi Khusus</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM jurusan ORDER BY kode_jurusan DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_jurusan]</td>
                              <td>$r[nama_jurusan]</td>
                              <td>$r[bidang_keahlian]</td>
                              <td>$r[kompetensi_umum]</td>
                              <td>$r[kompetensi_khusus]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Edit Data' href='?view=jurusan&act=detail&id=$r[kode_jurusan]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=jurusan&act=edit&id=$r[kode_jurusan]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=jurusan&hapus=$r[kode_jurusan]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM jurusan where kode_jurusan='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=jurusan';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='detail'){
    $edit = mysqli_query($koneksi,"SELECT * FROM jurusan where kode_jurusan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_jurusan]'>
                    <tr><th width='140px' scope='row'>Kode Jurusan</th> <td>$s[kode_jurusan]</td></tr>
                    <tr><th scope='row'>Nama Jurusan</th>       <td>$s[nama_jurusan]</td></tr>
                    <tr><th scope='row'>Nama Jurusan En</th>    <td>$s[nama_jurusan_en]</td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td>$s[bidang_keahlian]</td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td>$s[kompetensi_umum]</td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td>$s[kompetensi_khusus]</td></tr>
                    <tr><th scope='row'>Pejabat</th>            <td>$s[pejabat]</td></tr>
                    <tr><th scope='row'>Jabataan</th>           <td>$s[jabatan]</td></tr>
                    <tr><th scope='row'>Keterangan</th>         <td>$s[keterangan]</td></tr>
                    <tr><th scope='row'>Aktif</th>              <td>$s[aktif]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=jurusan'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
              </div>
              </form>
            </div>";
}elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE jurusan SET kode_jurusan = '$_POST[a]',
                                         nama_jurusan = '$_POST[b]',
                                         nama_jurusan_en = '$_POST[c]',
                                         bidang_keahlian = '$_POST[d]',
                                         kompetensi_umum = '$_POST[e]',
                                         kompetensi_khusus = '$_POST[f]',
                                         pejabat = '$_POST[g]',
                                         jabatan = '$_POST[h]',
                                         keterangan = '$_POST[i]',
                                         aktif = '$_POST[j]' where kode_jurusan='$_POST[id]'");
      echo "<script>document.location='index.php?view=jurusan';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM jurusan where kode_jurusan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_jurusan]'>
                    <tr><th width='140px' scope='row'>Kode Jurusan</th> <td><input type='text' class='form-control' name='a' value='$s[kode_jurusan]'> </td></tr>
                    <tr><th scope='row'>Nama Jurusan</th>       <td><input type='text' class='form-control' name='b' value='$s[nama_jurusan]'></td></tr>
                    <tr><th scope='row'>Nama Jurusan En</th>    <td><input type='text' class='form-control' name='c' value='$s[nama_jurusan_en]'></td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td><input type='text' class='form-control' name='d' value='$s[bidang_keahlian]'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td><input type='text' class='form-control' name='e' value='$s[kompetensi_umum]'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td><input type='text' class='form-control' name='f' value='$s[kompetensi_khusus]'></td></tr>
                    <tr><th scope='row'>Pejabat</th>            <td><input type='text' class='form-control' name='g' value='$s[pejabat]'></td></tr>
                    <tr><th scope='row'>Jabataan</th>           <td><input type='text' class='form-control' name='h' value='$s[jabatan]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='i' value='$s[keterangan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
                                                                  if ($s[aktif]=='Ya'){
                                                                      echo "<input type='radio' name='j' value='Ya' checked> Ya
                                                                             <input type='radio' name='j' value='Tidak'> Tidak";
                                                                  }else{
                                                                      echo "<input type='radio' name='j' value='Ya'> Ya
                                                                             <input type='radio' name='j' value='Tidak' checked> Tidak";
                                                                  }
                  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=jurusan'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO jurusan VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]','$_POST[i]','$_POST[j]')");
        echo "<script>document.location='index.php?view=jurusan';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Jurusan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Jurusan</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama Jurusan</th>       <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Nama Jurusan En</th>    <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Bidang Keahlian</th>    <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Kompetensi Umum</th>    <td><input type='text' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Kompetensi Khusus</th>  <td><input type='text' class='form-control' name='f'></td></tr>
                    <tr><th scope='row'>Pejabat</th>            <td><input type='text' class='form-control' name='g'></td></tr>
                    <tr><th scope='row'>Jabataan</th>           <td><input type='text' class='form-control' name='h'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='i'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='j' value='Ya'> Ya
                                                                      <input type='radio' name='j' value='Tidak'> Tidak </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=jurusan'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>