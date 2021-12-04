<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Gedung </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=gedung&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Jumlah Lantai</th>
                        <th>Panjang</th>
                        <th>Tinggi</th>
                        <th>Lebar</th>
                        <th>Keterangan</th>
                        <th>Aktif</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM gedung ORDER BY kode_gedung DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_gedung]</td>
                              <td>$r[nama_gedung]</td>
                              <td>$r[jumlah_lantai] Lantai</td>
                              <td>$r[panjang] Meter</td>
                              <td>$r[tinggi] Meter</td>
                              <td>$r[lebar] Meter</td>
                              <td>$r[keterangan]</td>
                              <td>$r[aktif]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='index.php?view=gedung&act=edit&id=$r[kode_gedung]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=gedung&hapus=$r[kode_gedung]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM gedung where kode_gedung='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=gedung';</script>";
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
        mysqli_query($koneksi,"UPDATE gedung SET kode_gedung = '$_POST[a]',
                                         nama_gedung = '$_POST[b]',
                                         jumlah_lantai = '$_POST[c]',
                                         panjang = '$_POST[d]',
                                         tinggi = '$_POST[e]',
                                         lebar = '$_POST[f]',
                                         keterangan = '$_POST[g]',
                                         aktif = '$_POST[h]' where kode_gedung='$_POST[id]'");
      echo "<script>document.location='index.php?view=gedung';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM gedung where kode_gedung='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Gedung</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_gedung]'>
                    <tr><th width='120px' scope='row'>Kode Gedung</th> <td><input type='text' class='form-control' name='a' value='$s[id_gedung]'> </td></tr>
                    <tr><th scope='row'>Nama Gedung</th>          <td><input type='text' class='form-control' name='b' value='$s[nama_gedung]'></td></tr>
                    <tr><th scope='row'>Jumlah Lantai</th>        <td><input type='text' class='form-control' name='c' value='$s[jumlah_lantai]'></td></tr>
                    <tr><th scope='row'>Panjang</th>              <td><input type='text' class='form-control' name='d' value='$s[panjang]'></td></tr>
                    <tr><th scope='row'>Tinggi</th>               <td><input type='text' class='form-control' name='e' value='$s[tinggi]'></td></tr>
                    <tr><th scope='row'>Lebar</th>                <td><input type='text' class='form-control' name='f' value='$s[lebar]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='g' value='$s[keterangan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
                                                                  if ($s[aktif]=='Ya'){
                                                                      echo "<input type='radio' name='h' value='Ya' checked> Ya
                                                                             <input type='radio' name='h' value='Tidak'> Tidak";
                                                                  }else{
                                                                      echo "<input type='radio' name='h' value='Ya'> Ya
                                                                             <input type='radio' name='h' value='Tidak' checked> Tidak";
                                                                  }
                  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=gedung'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO gedung VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$_POST[h]')");
        echo "<script>document.location='index.php?view=gedung';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Gedung</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Kode Gedung</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama Gedung</th>          <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Jumlah Lantai</th>        <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Panjang</th>              <td><input type='text' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Tinggi</th>               <td><input type='text' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Lebar</th>                <td><input type='text' class='form-control' name='f'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='g'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='h' value='Ya'> Ya
                                                                             <input type='radio' name='h' value='Tidak'> Tidak
                    </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=gedung'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>