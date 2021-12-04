<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data SMS Autoreply </h3>
                  <?php if($_SESSION[level]!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=autoreply&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Keyword</th>
                        <th>Isi Pesan</th>
                        <?php if($_SESSION[level]!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM sms_autoreply ORDER BY id_autoreply DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[keyword]</td>
                              <td>$r[isi_pesan]</td>";
                              if($_SESSION[level]!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='index.php?view=autoreply&act=edit&id=$r[id_autoreply]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=autoreply&hapus=$r[id_autoreply]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM sms_autoreply where id_autoreply='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=autoreply';</script>";
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
        mysqli_query($koneksi,"UPDATE sms_autoreply SET keyword = '$_POST[a]',
                                         isi_pesan = '$_POST[b]' where id_autoreply='$_POST[id]'");
      echo "<script>document.location='index.php?view=autoreply';</script>";
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM sms_autoreply where id_autoreply='$_GET[id]'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data SMS Autoreply</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_autoreply]'>
                    <tr><th width='120px' scope='row'>Keyword</th> <td><input type='text' class='form-control' name='a' value='$s[keyword]'> </td></tr>
                    <tr><th scope='row'>Isi Pesan</th>            <td><textarea rows='6' class='form-control' name='b' placeholder='Tuliskan Pesan anda (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.b,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.b,this.form.countDisplay);\" required>$s[isi_pesan]</textarea>
                                                                      <input type='number' name='countDisplay' size='3' maxlength='3' value='160' style='width:10%; text-align:center' readonly> Sisa Karakter</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=autoreply'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET[act]=='tambah'){
    if (isset($_POST[tambah])){
        mysqli_query($koneksi,"INSERT INTO sms_autoreply VALUES('','$_POST[a]','$_POST[b]','".date('Y-m-d H:i:s')."')");
        echo "<script>document.location='index.php?view=autoreply';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data SMS Autoreply</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Keyword</th> <td><input type='text' class='form-control' name='a'> </td></tr>
                    <tr><th scope='row'>Isi Pesan</th>            <td><textarea rows='6' class='form-control' name='b' placeholder='Tuliskan Pesan anda (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.b,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.b,this.form.countDisplay);\" required></textarea>
                                                                      <input type='number' name='countDisplay' size='3' maxlength='3' value='160' style='width:10%; text-align:center' readonly> Sisa Karakter</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=autoreply'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>