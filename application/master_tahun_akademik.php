<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Tahun Akademik </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=tahunakademik&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Tahun Akademik</th>
                        <th>Nama Tahun</th>
                        <th>Keterangan</th>
                        <th>Aktif</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM tahun_akademik ORDER BY id_tahun_akademik DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[id_tahun_akademik]</td>
                              <td>$r[nama_tahun]</td>
                              <td>$r[keterangan]</td>
                              <td>$r[aktif]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='index.php?view=tahunakademik&act=edit&id=$r[id_tahun_akademik]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=tahunakademik&hapus=$r[id_tahun_akademik]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM tahun_akademik where id_tahun_akademik='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=tahunakademik';</script>";
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
        mysqli_query($koneksi,"UPDATE tahun_akademik SET id_tahun_akademik = '$_POST[a]',
                                         nama_tahun = '$_POST[b]',
                                         keterangan = '$_POST[c]',
                                         aktif = '$_POST[d]' where id_tahun_akademik='$_POST[id]'");
      echo "<script>document.location='index.php?view=tahunakademik';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM tahun_akademik where id_tahun_akademik='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Tahun Akademik</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_tahun_akademik]'>
                    <tr><th width='120px' scope='row'>Kode Tahun</th> <td><input type='text' class='form-control' name='a' value='$s[id_tahun_akademik]'> </td></tr>
                    <tr><th scope='row'>Nama Tahun</th>           <td><input type='text' class='form-control' name='b' value='$s[nama_tahun]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='c' value='$s[keterangan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
                                                                  if ($s[aktif]=='Ya'){
                                                                      echo "<input type='radio' name='d' value='Ya' checked> Ya
                                                                             <input type='radio' name='d' value='Tidak'> Tidak";
                                                                  }else{
                                                                      echo "<input type='radio' name='d' value='Ya'>
                                                                             <input type='radio' name='d' value='Tidak' checked> Tidak";
                                                                  }
                  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=tahunakademik'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO tahun_akademik VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
        echo "<script>document.location='index.php?view=tahunakademik';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Tahun Akademik</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Kode Tahun</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Nama Tahun</th>           <td><input type='text' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='d' value='Ya'> Ya
                                                                      <input type='radio' name='d' value='Tidak'> Tidak
                    </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=tahunakademik'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>