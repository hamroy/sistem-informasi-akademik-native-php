<?php if ($_GET[act]==''){ 
  $k = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kelas where kode_kelas='$_GET[id]'"));
  $t = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tahun_akademik where id_tahun_akademik='$_GET[tahun]'"));
?>
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Cetak Raport Semester Siswa <?php echo $_GET[tahun]; ?></h3>
                  <form style='margin-right:5px; margin-top:0px' class='pull-right' action='' method='GET'>
                    <input type="hidden" name='view' value='raportcetak'>
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
                              <td width='420px'><center>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Cover</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal1.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 1</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal2.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 2</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal3.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 3</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal4.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 4</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal5.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 5</a>
                                <a target='_BLANK' class='btn btn-success btn-xs' href='print_raport/print-hal6.php?id=$r[nisn]&kelas=$r[kode_kelas]&tahun=$_GET[tahun]'><span class='glyphicon glyphicon-print'></span> Hal 6</a>
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

<?php } ?>