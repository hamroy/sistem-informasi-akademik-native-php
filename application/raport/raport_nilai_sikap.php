<?php 
    if (isset($_POST[simpan])){
        $juml = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_GET[id]'"));
        for ($ia=1; $ia<=$juml; $ia++){
          $a   = $_POST['a'.$ia];
          $b   = $_POST['b'.$ia];
          $c   = $_POST['c'.$ia];
          $nisn   = $_POST['nisn'.$ia];
          if ($a != '' OR $b != '' OR $c != ''){
            $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM nilai_sikap where kodejdwl='$_POST[jdwl]' AND nisn='$nisn' AND status='$_POST[status]'"));
            if ($cek >= '1'){
              mysqli_query($koneksi,"UPDATE nilai_sikap SET positif='$a', negatif='$b', deskripsi='$c' where kodejdwl='$_GET[jdwl]' AND nisn='$nisn' AND status='$_POST[status]'");
            }else{
              mysqli_query($koneksi,"INSERT INTO nilai_sikap VALUES('','$_GET[jdwl]','$nisn','$a','$b','$c','$_POST[status]','$_SESSION[id]','".date('Y-m-d H:i:s')."')");
            }
          }
        }
        echo "<script>document.location='index.php?view=raport&act=listsiswasikap&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]';</script>";
    }

    $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kelas where kode_kelas='$_GET[id]'"));
    $m = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM mata_pelajaran where kode_pelajaran='$_GET[kd]'"));
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Input Nilai Sikap Siswa</b></h3>
                </div>
            
        <div class='box-body'>
              <div class='col-md-12'>
              <table class='table table-condensed table-hover'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kodekelas]'>
                    <tr><th width='120px' scope='row'>Kode Kelas</th> <td>$d[kode_kelas]</td></tr>
                    <tr><th scope='row'>Nama Kelas</th>               <td>$d[nama_kelas]</td></tr>
                    <tr><th scope='row'>Mata Pelajaran</th>           <td>$m[namamatapelajaran]</td></tr>
                  </tbody>
              </table>
              </div>

          <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#spiritual' id='spiritual-tab' role='tab' data-toggle='tab' aria-controls='spiritual' aria-expanded='true'>Penilaian Spiritual </a></li>
                      <li role='presentation' class=''><a href='#sosial' role='tab' id='sosial-tab' data-toggle='tab' aria-controls='sosial' aria-expanded='false'>Penilaian Sosial</a></li>
                    </ul><br>
            <div id='myTabContent' class='tab-content'>";

                  // Ini Halaman unutk Nilai Spiritual
                      echo "<div role='tabpanel' class='tab-pane fade active in' id='spiritual' aria-labelledby='spiritual-tab'>";
                      echo "<div class='col-md-12'>
                            <form action='index.php?view=raport&act=listsiswasikap&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]' method='POST'>
                            <input type='hidden' value='spiritual' name='status'>
                            <table class='table table-bordered table-striped'>
                                <tr>
                                  <th style='border:1px solid #e3e3e3' width='30px' rowspan='2'>No</th>
                                  <th style='border:1px solid #e3e3e3' width='80px' rowspan='2'>NISN</th>
                                  <th style='border:1px solid #e3e3e3' width='190px' rowspan='2'>Nama Lengkap</th>
                                  <th style='border:1px solid #e3e3e3' colspan='3'><center>Penilaian Spiritual</center></th>
                                </tr>
                                <tr>
                                  <th style='border:1px solid #e3e3e3;'><center>Positif</center></th>
                                  <th style='border:1px solid #e3e3e3;'><center>Negatif</center></th>
                                  <th style='border:1px solid #e3e3e3;'><center>Desktipsi</center></th>
                                </tr>
                              <tbody>";
                              $no = 1;
                              $tampil = mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_GET[id]' ORDER BY id_siswa");
                              while($r=mysqli_fetch_array($tampil)){
                                $des = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_sikap where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND status='spiritual'"));
                                  echo "<tr>
                                        <td>$no</td>
                                        <td>$r[nisn]</td>
                                        <td>$r[nama]</td>
                                        <input type='hidden' name='nisn".$no."' value='$r[nisn]'>
                                        <td align=center><textarea name='a".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Positif...'>$des[positif]</textarea></td>
                                        <td align=center><textarea name='b".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Negatif...'>$des[negatif]</textarea></td>
                                        <td align=center><textarea name='c".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Deskripsi...'>$des[deskripsi]</textarea></td>
                                      </tr>";
                                  $no++;
                                }

                                echo "</tbody>
                            </table>
                            </div>
                            <div style='clear:both'></div>
                                <div class='box-footer'>
                                  <button type='submit' name='simpan' class='btn btn-info'>Simpan</button>
                                  <button type='reset' class='btn btn-default pull-right'>Cancel</button>
                                </div>
                            </form>
                            </div>";


                      // Ini Halaman unutk Nilai Sosial
                echo "<div role='tabpanel' class='tab-pane fade' id='sosial' aria-labelledby='sosial-tab'>
                      <div class='col-md-12'>
                            <form action='index.php?view=raport&act=listsiswasikap&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]' method='POST'>
                            <input type='hidden' value='sosial' name='status'>
                            <table class='table table-bordered table-striped'>
                                <tr>
                                  <th style='border:1px solid #e3e3e3' width='30px' rowspan='2'>No</th>
                                  <th style='border:1px solid #e3e3e3' width='80px' rowspan='2'>NISN</th>
                                  <th style='border:1px solid #e3e3e3' width='190px' rowspan='2'>Nama Lengkap</th>
                                  <th style='border:1px solid #e3e3e3' colspan='3'><center>Penilaian Sosial</center></th>
                                </tr>
                                <tr>
                                  <th style='border:1px solid #e3e3e3;'><center>Positif</center></th>
                                  <th style='border:1px solid #e3e3e3;'><center>Negatif</center></th>
                                  <th style='border:1px solid #e3e3e3;'><center>Desktipsi</center></th>
                                </tr>
                              <tbody>";
                              $no = 1;
                              $tampil = mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_GET[id]' ORDER BY id_siswa");
                              while($r=mysqli_fetch_array($tampil)){
                                $des = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_sikap where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' AND status='sosial'"));
                                  echo "<tr>
                                        <td>$no</td>
                                        <td>$r[nisn]</td>
                                        <td>$r[nama]</td>
                                        <input type='hidden' name='nisn".$no."' value='$r[nisn]'>
                                        <td align=center><textarea name='a".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Positif...'>$des[positif]</textarea></td>
                                        <td align=center><textarea name='b".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Negatif...'>$des[negatif]</textarea></td>
                                        <td align=center><textarea name='c".$no."' class='form-control' style='width:100%; color:blue' placeholder=' Tuliskan Deskripsi...'>$des[deskripsi]</textarea></td>
                                      </tr>";
                                  $no++;
                                }

                                echo "</tbody>
                            </table>
                            </div>
                            <div style='clear:both'></div>
                                <div class='box-footer'>
                                  <button type='submit' name='simpan' class='btn btn-info'>Simpan</button>
                                  <button type='reset' class='btn btn-default pull-right'>Cancel</button>
                                </div>
                            </form>
                            </div>
                  </div>
              </div>
          </div>
        </div>
      </div>";
?>