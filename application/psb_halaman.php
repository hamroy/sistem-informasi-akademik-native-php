<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Semua Halaman Statis PSB </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=psbhalaman&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Judul</th>
                        <th>Url</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM halaman where status='psb' ORDER BY id_halaman DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[judul]</td>
                              <td>halaman-$r[judul_seo].mu</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=psbhalaman&act=edit&id=$r[id_halaman]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=psbhalaman&hapus=$r[id_halaman]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM halaman where id_halaman='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=psbhalaman';</script>";
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
      $judul = seo_title($_POST[a]);
      mysqli_query($koneksi,"UPDATE halaman SET judul = '$_POST[a]',
                                         judul_seo = '$judul',
                                         isi_halaman = '$_POST[b]' where id_halaman='$_POST[id]'");

      echo "<script>document.location='index.php?view=psbhalaman';</script>";
    }

    $edit = mysqli_query($koneksi,"SELECT * FROM halaman where id_halaman='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Halaman PSB</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_halaman]'>
                    <tr><th width='120px' scope='row'>Judul</th> <td><input type='text' class='form-control' name='a' value='$s[judul]'> </td></tr>
                    <tr><th scope='row'>Isi Halaman</th>        <td><textarea class='form-control' name='b' style='height:350px'>$s[isi_halaman]</textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=psbhalaman'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        $judul = seo_title($_POST[a]);
        mysqli_query($koneksi,"INSERT INTO halaman VALUES('','$_POST[a]','$judul','$_POST[b]','$_SESSION[id]','journal')");
        echo "<script>document.location='index.php?view=psbhalaman';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Halaman PSB</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_halaman]'>
                    <tr><th width='120px' scope='row'>Judul</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Isi Halaman</th>        <td><textarea class='form-control' name='b' style='height:350px'></textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=psbhalaman'><button class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>