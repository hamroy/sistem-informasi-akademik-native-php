<?php if ($_GET[act]==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pesan Masuk - Local to WEB </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Pesan SMS</th>
                        <th style='width:90px'>Pengirim</th>
                        <th style='width:120px'>Waktu Terima</th>
                        <th style='width:40px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM sms_inbox ORDER BY id DESC LIMIT 500");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[pesan]</td>
                              <td>$r[nohp]</td>
                              <td>$r[waktu]</td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=smstoweb&hapus=$r[id]'><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM sms_inbox where id='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=smstoweb';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}
?>