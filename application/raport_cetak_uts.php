<?php if ($_GET[act]==''){
  $k = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kelas where kode_kelas='$_GET[id]'"));
  $t = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tahun_akademik where id_tahun_akademik='$_GET[tahun]'"));
?>
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Cetak Raport UTS Siswa</h3>
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                    <input type="hidden" name='view' value='raportcetakuts'>
                    <select name='tahun' style='padding:4px'>
                        <?php 
                            echo "<option value=''>- Pilih Tahun Akademik -</option>";
                            $tahun = mysqli_query($koneksi,"SELECT * FROM tahun_akademik");
                            while ($k = mysqli_fetch_array($tahun)){
                              if ($_GET[tahun]==$k[id_tahun_akademik]){
                                echo "<option value='$k[id_tahun_akademik]' selected>$k[nama_tahun]</option>";
                              }else{
                                echo "<option value='$k[id_tahun_akademik]'>$k[nama_tahun]</option>";
                              }
                            }
                        ?>
                    </select>
                    <select name='id' style='padding:4px'>
                        <?php 
                            echo "<option value=''>- Filter Kelas -</option>";
                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                            while ($k = mysqli_fetch_array($kelas)){
                              if ($_GET[id]==$k[kode_kelas]){
                                echo "<option value='$k[kode_kelas]' selected>$k[kode_kelas] - $k[nama_kelas]</option>";
                              }else{
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
                        <th>No</th>
                        <th>NIPD</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysqli_query($koneksi,"SELECT * FROM siswa a
                                              JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin 
                                                where a.kode_kelas='$_GET[id]' ORDER BY a.id_siswa");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr><td width=40px>$no</td>
                              <td>$r[nipd]</td>
                              <td>$r[nisn]</td>
                              <td>$r[nama]</td>
                              <td>$r[jenis_kelamin]</td>
                              <td width='90px'><center>
                                <a target='_BLANK' class='btn btn-primary btn-xs' href='print-raport_uts.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Print Raport UTS</a>
                              </center></td>";
                            echo "</tr>";
                      $no++;
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <?php 
                    if ($_GET[kelas] == '' AND $_GET[tahun] == ''){
                        echo "<center style='padding:60px; color:red'>Silahkan Memilih Tahun akademik dan Kelas Terlebih dahulu...</center>";
                    }
                ?>
              </div>
            </div>

<?php 
}
?>