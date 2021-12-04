<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Ruangan </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=ruangan&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Ruangan</th>
                        <th>Nama Gedung</th>
                        <th>Nama Ruangan</th>
                        <th>Kapasitas Belajar</th>
                        <th>Kapasitas Ujian</th>
                        <th>Keterangan</th>
                        <th>Aktif</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM ruangan a 
                                            JOIN gedung b ON a.kode_gedung=b.kode_gedung 
                                              ORDER BY a.kode_ruangan DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_ruangan]</td>
                              <td>$r[nama_gedung]</td>
                              <td>$r[nama_ruangan]</td>
                              <td>$r[kapasitas_belajar] Orang</td>
                              <td>$r[kapasitas_ujian] Orang</td>
                              <td>$r[keterangan]</td>
                              <td>$r[aktif]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=ruangan&act=edit&id=$r[kode_ruangan]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=ruangan&hapus=$r[kode_ruangan]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM ruangan where kode_ruangan='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=ruangan';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='edit'){
    if (isset($_POST[update])){
        mysqli_query($koneksi,"UPDATE ruangan SET kode_ruangan = '$_POST[a]',
                                         kode_gedung = '$_POST[b]',
                                         nama_ruangan = '$_POST[c]',
                                         kapasitas_belajar = '$_POST[d]',
                                         kapasitas_ujian = '$_POST[e]',
                                         keterangan = '$_POST[f]',
                                         aktif = '$_POST[g]' where kode_ruangan='$_POST[id]'");
      echo "<script>document.location='index.php?view=ruangan';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM ruangan where kode_ruangan='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Ruangan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_ruangan]'>
                    <tr><th width='120px' scope='row'>Kode Ruangan</th> <td><input type='text' class='form-control' name='a' value='$s[kode_ruangan]'> </td></tr>
                    <tr><th scope='row'>Nama Gedung</th>          <td><select class='form-control' name='b'> 
                                                                          <option value='0' selected>- Pilih Gedung -</option>"; 
                                                                            $wali = mysqli_query($koneksi,"SELECT * FROM gedung");
                                                                            while($a = mysqli_fetch_array($wali)){
                                                                              if ($a[kode_gedung] == $s[kode_gedung]){
                                                                                echo "<option value='$a[kode_gedung]' selected>$a[nama_gedung]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[kode_gedung]'>$a[nama_gedung]</option>";
                                                                              }
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Nama Ruangan</th>        <td><input type='text' class='form-control' name='c' value='$s[nama_ruangan]'></td></tr>
                    <tr><th scope='row'>Kapasitas Belajar</th>              <td><input type='text' class='form-control' name='d' value='$s[kapasitas_belajar]'></td></tr>
                    <tr><th scope='row'>Kapasitas Ujian</th>               <td><input type='text' class='form-control' name='e' value='$s[kapasitas_ujian]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='f' value='$s[keterangan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
                                                                  if ($s[aktif]=='Ya'){
                                                                      echo "<input type='radio' name='g' value='Ya' checked> Ya
                                                                             <input type='radio' name='g' value='Tidak'> Tidak";
                                                                  }else{
                                                                      echo "<input type='radio' name='g' value='Ya'>
                                                                             <input type='radio' name='g' value='Tidak' checked> Tidak";
                                                                  }
                  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=ruangan'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO ruangan VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]')");
        echo "<script>document.location='index.php?view=ruangan';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Ruangan</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Kode Ruangan</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama Gedung</th>          <td><select class='form-control' name='b'> 
                                                                          <option value='0' selected>- Pilih Gedung -</option>"; 
                                                                            $wali = mysqli_query($koneksi,"SELECT * FROM gedung");
                                                                            while($a = mysqli_fetch_array($wali)){
                                                                                echo "<option value='$a[kode_gedung]'>$a[nama_gedung]</option>";
                                                                            }
                                                                         echo "</select></td></tr>
                    <tr><th scope='row'>Nama Ruangan</th>        <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Kapasitas Belajar</th>              <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Kapasitas Ujian</th>               <td><input type='text' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='f'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='g' value='Ya'> Ya
                                                                             <input type='radio' name='g' value='Tidak'> Tidak</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=ruangan'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>