<?php 
    if (isset($_POST[simpan])){
            if ($_POST[status]=='Update'){
              mysqli_query($koneksi,"UPDATE nilai_pengetahuan SET kd='$_POST[a]', nilai1='$_POST[b]', nilai2='$_POST[c]', nilai3='$_POST[d]', nilai4='$_POST[e]', nilai5='$_POST[f]', deskripsi='$_POST[g]' where id_nilai_pengetahuan='$_POST[id]'");
            }else{
              mysqli_query($koneksi,"INSERT INTO nilai_pengetahuan VALUES('','$_GET[jdwl]','$_POST[nisn]','$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$_SESSION[id]','".date('Y-m-d H:i:s')."')");
            }
        echo "<script>document.location='index.php?view=raport&act=listsiswa&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]#$_POST[nisn]';</script>";
    }

    if (isset($_GET[delete])){
        mysqli_query($koneksi,"DELETE FROM nilai_pengetahuan where id_nilai_pengetahuan='$_GET[delete]'");
        echo "<script>document.location='index.php?view=raport&act=listsiswa&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]#$_GET[nisn]';</script>";
    }

    $d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kelas where kode_kelas='$_GET[id]'"));
    $m = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM mata_pelajaran where kode_pelajaran='$_GET[kd]'"));
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Input Nilai Pengetahuan Siswa</b></h3>
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
              <table class='table table-bordered table-striped'>
                                <tr>
                                  <th style='border:1px solid #e3e3e3' width='30px' rowspan='2'>No</th>
                                  <th style='border:1px solid #e3e3e3' width='170px' rowspan='2'>Nama Lengkap</th>
                                  <th style='border:1px solid #e3e3e3; width:55px' rowspan='2'><center>KD</center></th>
                                  <th style='border:1px solid #e3e3e3' colspan='5'><center>Penilaian</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px' rowspan='2'><center>Rata2</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px' rowspan='2'><center>Grade</center></th>
                                  <th style='border:1px solid #e3e3e3' rowspan='2'><center>Deskripsi</center></th>
                                  <th style='border:1px solid #e3e3e3; width:65px' rowspan='2'><center>Action</center></th>
                                </tr>
                                <tr>
                                  <th style='border:1px solid #e3e3e3; width:55px'><center>UH</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px'><center>UTS</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px'><center>TU</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px'><center>SM</center></th>
                                  <th style='border:1px solid #e3e3e3; width:55px'><center></center></th>
                                </tr>
                              <tbody>";
                              $no = 1;
                              $tampil = mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_GET[id]' ORDER BY id_siswa");
                              while($r=mysqli_fetch_array($tampil)){
                                  if (isset($_GET[edit])){
                                      $e = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM nilai_pengetahuan where id_nilai_pengetahuan='$_GET[edit]'"));
                                      $name = 'Update';
                                  }else{
                                      $name = 'Simpan';
                                  }
                                  if ($_GET[nisn]==$r[nisn]){
                                    echo "<form action='index.php?view=raport&act=listsiswa&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]' method='POST'>
                                      <tr>
                                        <td>$no</td>
                                        <td style='font-size:12px' id='$r[nisn]'>$r[nama]</td>
                                        <input type='hidden' name='nisn' value='$r[nisn]'>
                                        <input type='hidden' name='id' value='$e[id_nilai_pengetahuan]'>
                                        <input type='hidden' name='status' value='$name'>
                                        <td align=center><input type='text' name='a' value='$e[kd]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='b' value='$e[nilai1]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='c' value='$e[nilai2]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='d' value='$e[nilai3]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='e' value='$e[nilai4]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='f' value='$e[nilai5]' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' style='width:35px; background:#e3e3e3; border:1px solid #e3e3e3;' disabled></td>
                                        <td align=center><input type='text' style='width:35px; background:#e3e3e3; border:1px solid #e3e3e3;' disabled></td>
                                        <td align=center><input type='text' name='g' value='$e[deskripsi]' style='width:100%; padding:0px'></td>
                                        <td align=center><input type='submit' name='simpan' class='btn btn-xs btn-primary' style='width:65px' value='$name'></td>
                                      </tr>
                                      </form>";
                                  }else{
                                    echo "<form action='index.php?view=raport&act=listsiswa&jdwl=$_GET[jdwl]&kd=$_GET[kd]&id=$_GET[id]&tahun=$_GET[tahun]' method='POST'>
                                      <tr>
                                        <td>$no</td>
                                        <td style='font-size:12px' id='$r[nisn]'>$r[nama]</td>
                                        <input type='hidden' name='nisn' value='$r[nisn]'>
                                        <input type='hidden' name='id' value='$e[id_nilai_pengetahuan]'>
                                        <input type='hidden' name='status' value='$name'>
                                        <td align=center><input type='text' name='a' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='b' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='c' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='d' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='e' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' name='f' style='width:35px; text-align:center; padding:0px'></td>
                                        <td align=center><input type='text' style='width:35px; background:#e3e3e3; border:1px solid #e3e3e3;' disabled></td>
                                        <td align=center><input type='text' style='width:35px; background:#e3e3e3; border:1px solid #e3e3e3;' disabled></td>
                                        <td align=center><input type='text' name='g' style='width:100%; padding:0px'></td>
                                        <td align=center><input type='submit' name='simpan' class='btn btn-xs btn-primary' style='width:65px' value='$name'></td>
                                      </tr>
                                      </form>";
                                  }

                                    $pe = mysqli_query($koneksi,"SELECT * FROM nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]'");
                                    while ($n = mysqli_fetch_array($pe)){
                                    $ratarata = average(array($n[nilai1],$n[nilai2],$n[nilai3],$n[nilai4],$n[nilai5]));
                                    $cekpredikat = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[id]'"));
                                    if ($cekpredikat >= 1){
                                      $grade1 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($ratarata)." >=nilai_a) AND (".number_format($ratarata)." <= nilai_b) AND kode_kelas='$_GET[id]'"));
                                    }else{
                                      $grade1 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($ratarata)." >=nilai_a) AND (".number_format($ratarata)." <= nilai_b) AND kode_kelas='0'"));
                                    }
                                    
                                      echo "<tr>
                                        <td></td>
                                        <td></td>
                                        <td align=center>$n[kd]</td>
                                        <td align=center>$n[nilai1]</td>
                                        <td align=center>$n[nilai2]</td>
                                        <td align=center>$n[nilai3]</td>
                                        <td align=center>$n[nilai4]</td>
                                        <td align=center>$n[nilai5]</td>
                                        <td align=center>".number_format($ratarata)."</td>
                                        <td align=center>$grade1[grade]</td>
                                        <td>$n[deskripsi]</td>
                                        <td align=center><a href='index.php?view=raport&act=listsiswa&jdwl=".$_GET[jdwl]."&kd=".$_GET[kd]."&id=".$_GET[id]."&tahun=".$_GET[tahun]."&edit=".$n[id_nilai_pengetahuan]."&nisn=".$r[nisn]."#$r[nisn]' class='btn btn-xs btn-success'><span class='glyphicon glyphicon-edit'></span></a>
                                                        <a href='index.php?view=raport&act=listsiswa&jdwl=".$_GET[jdwl]."&kd=".$_GET[kd]."&id=".$_GET[id]."&tahun=".$_GET[tahun]."&delete=".$n[id_nilai_pengetahuan]."&nisn=".$r[nisn]."' class='btn btn-xs btn-danger' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                                      </tr>";
                                    }
                                      $maxn = mysqli_fetch_array(mysqli_query($koneksi,"SELECT ((nilai1+nilai2+nilai3+nilai4+nilai5)/5) as rata_rata, deskripsi FROM nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
                                      $cekpredikat1 = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[id]'"));
                                      if ($cekpredikat1 >= 1){
                                        $grade2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($maxn[rata_rata])." >=nilai_a) AND (".number_format($maxn[rata_rata])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
                                      }else{
                                        $grade2 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($maxn[rata_rata])." >=nilai_a) AND (".number_format($maxn[rata_rata])." <= nilai_b) AND kode_kelas='0'"));
                                      }
                                      
                                      $rapn = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum((nilai1+nilai2+nilai3+nilai4+nilai5)/5)/count(nisn) as raport FROM nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]'"));
                                      $cekpredikat2 = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM predikat where kode_kelas='$_GET[id]'"));
                                      if ($cekpredikat2 >= 1){
                                        $grade3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($rapn[raport])." >=nilai_a) AND (".number_format($rapn[raport])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
                                      }else{
                                        $grade3 = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM `predikat` where (".number_format($rapn[raport])." >=nilai_a) AND (".number_format($rapn[raport])." <= nilai_b) AND kode_kelas='0'"));
                                      }

                                      echo "<tr>
                                              <td></td><td></td>
                                              <td align=center colspan='6'>Nilai Max/Min</td>
                                              <td align=center>".number_format($maxn[rata_rata])."</td>
                                              <td align=center>$grade2[grade]</td><td></td>
                                            </tr>
                                            <tr>
                                              <td></td><td></td>
                                              <td align=center colspan='6'>Raport</td>
                                              <td align=center>".number_format($rapn[raport])."</td>
                                              <td align=center>$grade3[grade]</td><td>$maxn[deskripsi]</td>
                                            </tr>";
                                  $no++;
                                }

                                echo "</tbody>
                            </table>
              </div>
          </div>
        </div>
      </div>";
?>