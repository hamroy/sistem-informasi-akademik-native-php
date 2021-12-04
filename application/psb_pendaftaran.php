
<?php 
if ($_GET[act]==''){ 
  cek_session_admin();
  if ($_GET[view]=='psbsma'){
      $status = 'SMA';
      $filter = 'sma';
  }elseif ($_GET[view]=='psbsmk'){
      $status = 'SMK';
      $filter = 'smk';
  }elseif ($_GET[view]=='psbsmp'){
      $status = 'SMP';
      $filter = 'smp';
  }
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Data Siswa PSB <?php echo $status; ?>  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                echo "<table id='example1' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Induk</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                        <th>Sekolah Asal</th>";
                        if($_SESSION[level]!='kepala'){ 
                            echo "<th>Action</th>";
                        }
                      echo "</tr>
                    </thead>
                    <tbody>";
                    $tampil = mysqli_query($koneksi,"SELECT * FROM psb_pendaftaran a JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin where a.status='$filter' ORDER BY a.id_pendaftaran DESC");
                    $no = 1;
                    while($r=mysqli_fetch_array($tampil)){
                    echo "<tr>
                              <td>$no</td>
                              <td>$r[no_induk]</td>
                              <td>$r[nama]</td>
                              <td>$r[jenis_kelamin]</td>
                              <td>$r[no_telpon]</td>
                              <td>$r[sekolah_asal]</td>";
                              if($_SESSION[level]!='kepala'){
                                echo "<td><center>
                                  <a class='btn btn-info btn-xs' title='Lihat Detail' href='?view=psb$filter&act=detailsiswa&id=$r[id_pendaftaran]'><span class='glyphicon glyphicon-search'></span></a>
                                  <a class='btn btn-success btn-xs' target='_BLANK' title='Print Formulir 1 Siswa' href='print-psb1.php?id=$r[id_pendaftaran]&status=$status'><span class='glyphicon glyphicon-print'></span> 1</a>
                                  <a class='btn btn-success btn-xs' target='_BLANK' title='Print Formulir 2 Siswa' href='print-psb2.php?id=$r[id_pendaftaran]&status=$status'><span class='glyphicon glyphicon-print'></span> 2</a>
                                  <a class='btn btn-danger btn-xs' title='Delete Siswa' href='?view=psb$filter&hapus=$r[id_pendaftaran]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET[hapus])){
                          mysqli_query($koneksi,"DELETE FROM psb_pendaftaran where id_pendaftaran='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=psb$filter';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET[act]=='editsiswa'){
  cek_session_siswa();
  if (isset($_POST[update1])){
      $rtrw = explode('/',$_POST[ai]);
      $rt = $rtrw[0];
      $rw = $rtrw[1];
      $dir_gambar = 'foto_siswa/';
      $filename = basename($_FILES['ao']['name']);
      $filenamee = date("YmdHis").'-'.basename($_FILES['ao']['name']);
      $uploadfile = $dir_gambar . $filenamee;
      if ($filename != ''){      
        if (move_uploaded_file($_FILES['ao']['tmp_name'], $uploadfile)){
           mysqli_query($koneksi,"UPDATE siswa SET 
                               nipd        = '$_POST[aa]',
                               nisn   = '$_POST[ab]',
                               password         = '$_POST[ac]',
                               nama       = '$_POST[ad]',
                               kode_kelas    = '$_POST[ae]',
                               angkatan   = '$_POST[af]',
                               kode_jurusan   = '$_POST[ag]',
                               alamat        = '$_POST[ah]',
                               rt         = '$rt',
                               rw   = '$rw',
                               dusun    = '$_POST[aj]',
                               kelurahan       = '$_POST[ak]',
                               kecamatan     = '$_POST[al]',
                               kode_pos      = '$_POST[am]',
                               status_awal   = '$_POST[an]',
                               foto = '$filenamee',

                               nik = '$_POST[ba]',
                               tempat_lahir = '$_POST[bb]',
                               tanggal_lahir = '$_POST[bc]',
                               id_jenis_kelamin = '$_POST[bd]',
                               id_agama = '$_POST[be]',
                               kebutuhan_khusus = '$_POST[bf]',
                               jenis_tinggal = '$_POST[bg]',
                               alat_transportasi = '$_POST[bh]',
                               telepon = '$_POST[bi]',
                               hp = '$_POST[bj]',
                               email = '$_POST[bk]',
                               skhun = '$_POST[bl]',
                               penerima_kps = '$_POST[bm]',
                               no_kps = '$_POST[bn]',
                               status_siswa = '$_POST[bo]' where nipd='$_POST[id]'");
        }
      }else{
            mysqli_query($koneksi,"UPDATE siswa SET 
                               nipd        = '$_POST[aa]',
                               nisn   = '$_POST[ab]',
                               password         = '$_POST[ac]',
                               nama       = '$_POST[ad]',
                               kode_kelas    = '$_POST[ae]',
                               angkatan   = '$_POST[af]',
                               kode_jurusan   = '$_POST[ag]',
                               alamat        = '$_POST[ah]',
                               rt         = '$rt',
                               rw   = '$rw',
                               dusun    = '$_POST[aj]',
                               kelurahan       = '$_POST[ak]',
                               kecamatan     = '$_POST[al]',
                               kode_pos      = '$_POST[am]',
                               status_awal   = '$_POST[an]',

                               nik = '$_POST[ba]',
                               tempat_lahir = '$_POST[bb]',
                               tanggal_lahir = '$_POST[bc]',
                               id_jenis_kelamin = '$_POST[bd]',
                               id_agama = '$_POST[be]',
                               kebutuhan_khusus = '$_POST[bf]',
                               jenis_tinggal = '$_POST[bg]',
                               alat_transportasi = '$_POST[bh]',
                               telepon = '$_POST[bi]',
                               hp = '$_POST[bj]',
                               email = '$_POST[bk]',
                               skhun = '$_POST[bl]',
                               penerima_kps = '$_POST[bm]',
                               no_kps = '$_POST[bn]',
                               status_siswa = '$_POST[bo]' where nipd='$_POST[id]'");
      }
          echo "<script>document.location='index.php?view=siswa&act=editsiswa&id=".$_POST[id]."';</script>";
  }

  if (isset($_POST[update2])){
           mysqli_query($koneksi,"UPDATE siswa SET 
                               nama_ayah        = '$_POST[ca]',
                               tahun_lahir_ayah   = '$_POST[cb]',
                               pendidikan_ayah         = '$_POST[cc]',
                               pekerjaan_ayah       = '$_POST[cd]',
                               penghasilan_ayah    = '$_POST[ce]',
                               kebutuhan_khusus_ayah   = '$_POST[cf]',
                               no_telpon_ayah   = '$_POST[cg]',

                               nama_ibu        = '$_POST[ch]',
                               tahun_lahir_ibu   = '$_POST[ci]',
                               pendidikan_ibu         = '$_POST[cj]',
                               pekerjaan_ibu       = '$_POST[ck]',
                               penghasilan_ibu    = '$_POST[cl]',
                               kebutuhan_khusus_ibu   = '$_POST[cm]',
                               no_telpon_ibu   = '$_POST[cn]',

                               nama_wali        = '$_POST[co]',
                               tahun_lahir_wali   = '$_POST[cp]',
                               pendidikan_wali         = '$_POST[cq]',
                               pekerjaan_wali       = '$_POST[cr]',
                               penghasilan_wali    = '$_POST[cs]' where nisn='$_POST[id]'");

            echo "<script>document.location='index.php?view=siswa&act=editsiswa&id=".$_POST[id]."';</script>";
  }
    if ($_SESSION[level] == 'siswa'){
        $nisn = $_SESSION[id];
        $close = 'readonly=on';
    }else{
        $nisn = $_GET[id];
        $close = '';
    }
    $edit = mysqli_query($koneksi,"SELECT * FROM siswa a LEFT JOIN kelas b ON a.kode_kelas=b.kode_kelas 
                              LEFT JOIN jenis_kelamin c ON a.id_jenis_kelamin=c.id_jenis_kelamin 
                                  LEFT JOIN jurusan d ON b.kode_jurusan=d.kode_jurusan
                                    LEFT JOIN agama e ON a.id_agama=e.id_agama 
                                      where a.nisn='$nisn'");
    $s = mysqli_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Siswa</h3>
                </div>
                <div class='box-body'>";
                
                  if ($_SESSION[level] == 'siswa'){
                    echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'> 
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>×</span></button> <strong>Perhatian!</strong> - Semua Data-data yang ada dibawah ini akan digunakan untuk keperluan pihak sekolah, jadi tolong di isi dengan data sebenarnya dan jika kedapatan data yang diisikan tidak seuai dengan yang sebenarnya, maka pihak sekolah akan memberikan sanksi tegas !!!
                    </div>";
                  }

                  echo "<div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                      <li role='presentation' class=''><a href='#ortu' role='tab' id='ortu-tab' data-toggle='tab' aria-controls='ortu' aria-expanded='false'>Data Orang Tua / Wali</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form action='' method='POST' enctype='multipart/form-data' class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
                                }
                            echo "</th></tr>
                            <input type='hidden' value='$s[nisn]' name='id'>
                            <tr><th width='120px' scope='row'>NIPD</th> <td><input type='text' class='form-control' value='$s[nipd]' name='aa' $close></td></tr>
                            <tr><th scope='row'>NISN</th> <td><input type='text' class='form-control' value='$s[nisn]' name='ab' $close></td></tr>
                            <tr><th scope='row'>Password</th> <td><input type='text' class='form-control' value='$s[password]' name='ac'></td></tr>
                            <tr><th scope='row'>Nama Siswa</th> <td><input type='text' class='form-control' value='$s[nama]' name='ad'></td></tr>
                            <tr><th scope='row'>Kelas</th> <td><select class='form-control' name='ae' $close> 
                                                                          <option value='0' selected>- Pilih Kelas -</option>"; 
                                                                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                                                                            while($a = mysqli_fetch_array($kelas)){
                                                                              if ($_SESSION[level] == 'siswa'){
                                                                                if ($a[kode_kelas] == $s[kode_kelas]){
                                                                                  echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
                                                                                }
                                                                              }else{
                                                                                if ($a[kode_kelas] == $s[kode_kelas]){
                                                                                  echo "<option value='$a[kode_kelas]' selected>$a[nama_kelas]</option>";
                                                                                }else{
                                                                                  echo "<option value='$a[kode_kelas]'>$a[nama_kelas]</option>";
                                                                                }
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                            <tr><th scope='row'>Angkatan</th> <td><input type='text' class='form-control' value='$s[angkatan]' name='af' $close></td></tr>
                            <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='ag' $close> 
                                                                          <option value='0' selected>- Pilih Jurusan -</option>"; 
                                                                            $jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
                                                                            while($a = mysqli_fetch_array($jurusan)){
                                                                              if ($_SESSION[level] == 'siswa'){
                                                                                if ($a[kode_jurusan] == $s[kode_jurusan]){
                                                                                  echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                                                                }
                                                                              }else{
                                                                                if ($a[kode_jurusan] == $s[kode_jurusan]){
                                                                                  echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                                                                }else{
                                                                                  echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                                                                }
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                            <tr><th scope='row'>Alamat Siswa</th> <td><input type='text' class='form-control' value='$s[alamat]' name='ah'></td></tr>
                            <tr><th scope='row'>RT/RW</th> <td><input type='text' class='form-control' value='$s[rt]/$s[rw]' name='ai'></td></tr>
                            <tr><th scope='row'>Dusun</th> <td><input type='text' class='form-control' value='$s[dusun]' name='aj'></td></tr>
                            <tr><th scope='row'>Kelurahan</th> <td><input type='text' class='form-control' value='$s[kelurahan]' name='ak'></td></tr>
                            <tr><th scope='row'>Kecamatan</th> <td><input type='text' class='form-control' value='$s[kecamatan]' name='al'></td></tr>
                            <tr><th scope='row'>Kode Pos</th> <td><input type='text' class='form-control' value='$s[kode_pos]' name='am'></td></tr>
                            <tr><th scope='row'>Status Awal</th> <td><input type='text' class='form-control' value='$s[status_awal]' name='an' $close></td></tr>
                            <tr><th scope='row'>Ganti Foto</th>             <td><div style='position:relative;''>
                                                                          <a class='btn btn-primary' href='javascript:;'>
                                                                            <span class='glyphicon glyphicon-search'></span> Browse..."; ?>
                                                                            <input type='file' class='files' name='ao' onchange='$("#upload-file-info").html($(this).val());'>
                                                                          <?php echo "</a> <span style='width:155px' class='label label-info' id='upload-file-info'></span>
                                                                        </div>
                            </td></tr>
                          </tbody>
                          </table>
                        </div>
                        <div class='col-md-5'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th width='120px' scope='row'>NIK</th> <td><input type='text' class='form-control' value='$s[nik]' name='ba'></td></tr>
                            <tr><th scope='row'>Tempat Lahir</th> <td><input type='text' class='form-control' value='$s[tempat_lahir]' name='bb'></td></tr>
                            <tr><th scope='row'>Tanggal Lahir</th> <td><input type='text' class='form-control' value='$s[tanggal_lahir]' name='bc'></td></tr>
                            <tr><th scope='row'>Jenis Kelamin</th> <td><select class='form-control' name='bd'> 
                                                                          <option value='0' selected>- Pilih Jenis Kelamin -</option>"; 
                                                                            $jk = mysqli_query($koneksi,"SELECT * FROM jenis_kelamin");
                                                                            while($a = mysqli_fetch_array($jk)){
                                                                              if ($a[id_jenis_kelamin] == $s[id_jenis_kelamin]){
                                                                                echo "<option value='$a[id_jenis_kelamin]' selected>$a[jenis_kelamin]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_jenis_kelamin]'>$a[jenis_kelamin]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                            <tr><th scope='row'>Agama</th> <td><select class='form-control' name='be'> 
                                                                          <option value='0' selected>- Pilih Agama -</option>"; 
                                                                            $agama = mysqli_query($koneksi,"SELECT * FROM agama");
                                                                            while($a = mysqli_fetch_array($agama)){
                                                                              if ($a[id_agama] == $s[id_agama]){
                                                                                echo "<option value='$a[id_agama]' selected>$a[nama_agama]</option>";
                                                                              }else{
                                                                                echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
                                                                              }
                                                                            }
                                                                  echo "</select></td></tr>
                            <tr><th scope='row'>Keb. Khusus</th> <td><input type='text' class='form-control' value='$s[kebutuhan_khusus]' name='bf'></td></tr>
                            <tr><th scope='row'>Jenis Tinggal</th> <td><input type='text' class='form-control' value='$s[jenis_tinggal]' name='bg'></td></tr>
                            <tr><th scope='row'>Transportasi</th> <td><input type='text' class='form-control' value='$s[alat_transportasi]' name='bh'></td></tr>
                            <tr><th scope='row'>No Telpon</th> <td><input type='text' class='form-control' value='$s[telepon]' name='bi'></td></tr>
                            <tr><th scope='row'>No Handpone</th> <td><input type='text' class='form-control' value='$s[hp]' name='bj'></td></tr>
                            <tr><th scope='row'>Alamat Email</th> <td><input type='text' class='form-control' value='$s[email]' name='bk'></td></tr>
                            <tr><th scope='row'>SKHUN</th> <td><input type='text' class='form-control' value='$s[skhun]' name='bl'></td></tr>
                            <tr><th scope='row'>Penerima KPS</th> <td><input type='text' class='form-control' value='$s[penerima_kps]' name='bm'></td></tr>
                            <tr><th scope='row'>No KPS</th> <td><input type='text' class='form-control' value='$s[no_kps]' name='bn'></td></tr>
                            <tr><th scope='row'>Status Siswa</th> <td>";
                                                                    if ($s[status_siswa]=='Aktif'){
                                                                        echo "<input type='radio' name='bo' value='Aktif' checked> Aktif
                                                                              <input type='radio' name='bo' value='Tidak Aktif'> Tidak Aktif";
                                                                    }else{
                                                                        echo "<input type='radio' name='bo' value='Aktif'> Aktif
                                                                              <input type='radio' name='bo' value='Tidak Aktif' checked> Tidak Aktif";
                                                                    } 
                                                                    echo "</td></tr>
                          </tbody>
                          </table>
                        </div>  
                        <div style='clear:both'></div>
                        <div class='box-footer'>
                          <button type='submit' name='update1' class='btn btn-info'>Update</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div> 

                        </form>
                    </div>


                    <div role='tabpanel' class='tab-pane fade' id='ortu' aria-labelledby='ortu-tab'>
                        <form action='' method='POST' class='form-horizontal'>
                        <div class='col-md-12'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='22'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
                                }
                            echo "</th></tr>
                            <input type='hidden' value='$s[nipd]' name='id'>
                            <tr bgcolor=#e3e3e3><th width='130px' scope='row'>Nama Ayah</th> <td><input type='text' class='form-control' value='$s[nama_ayah]' name='ca'></td></tr>
                            <tr><th scope='row'>Tahun Lahir</th> <td><input type='text' class='form-control' value='$s[tahun_lahir_ayah]' name='cb'></td></tr>
                            <tr><th scope='row'>Pendidikan</th> <td><input type='text' class='form-control' value='$s[pendidikan_ayah]' name='cc'></td></tr>
                            <tr><th scope='row'>Pekerjaan</th> <td><input type='text' class='form-control' value='$s[pekerjaan_ayah]' name='cd'></td></tr>
                            <tr><th scope='row'>Penghasilan</th> <td><input type='text' class='form-control' value='$s[penghasilan_ayah]' name='ce'></td></tr>
                            <tr><th scope='row'>Kebutuhan Khusus</th> <td><input type='text' class='form-control' value='$s[kebutuhan_khusus_ayah]' name='cf'></td></tr>
                            <tr><th scope='row'>No Telpon</th> <td><input type='text' class='form-control' value='$s[no_telpon_ayah]' name='cg'></td></tr>
                            <tr><th scope='row' coslpan='2'><br></th></tr>
                            <tr bgcolor=#e3e3e3><th scope='row'>Nama Ibu</th> <td><input type='text' class='form-control' value='$s[nama_ibu]' name='ch'></td></tr>
                            <tr><th scope='row'>Tahun Lahir</th> <td><input type='text' class='form-control' value='$s[tahun_lahir_ibu]' name='ci'></td></tr>
                            <tr><th scope='row'>Pendidikan</th> <td><input type='text' class='form-control' value='$s[pendidikan_ibu]' name='cj'></td></tr>
                            <tr><th scope='row'>Pekerjaan</th> <td><input type='text' class='form-control' value='$s[pekerjaan_ibu]' name='ck'></td></tr>
                            <tr><th scope='row'>Penghasilan</th> <td><input type='text' class='form-control' value='$s[penghasilan_ibu]' name='cl'></td></tr>
                            <tr><th scope='row'>Kebutuhan Khusus</th> <td><input type='text' class='form-control' value='$s[kebutuhan_khusus_ibu]' name='cm'></td></tr>
                            <tr><th scope='row'>No Telpon</th> <td><input type='text' class='form-control' value='$s[no_telpon_ibu]' name='cn'></td></tr>
                            <tr><th scope='row' coslpan='2'><br></th></tr>
                            <tr bgcolor=#e3e3e3><th scope='row'>Nama Wali</th> <td><input type='text' class='form-control' value='$s[nama_wali]' name='co'></td></tr>
                            <tr><th scope='row'>Tahun Lahir</th> <td><input type='text' class='form-control' value='$s[tahun_lahir_wali]' name='cp'></td></tr>
                            <tr><th scope='row'>Pendidikan</th> <td><input type='text' class='form-control' value='$s[pendidikan_wali]' name='cq'></td></tr>
                            <tr><th scope='row'>Pekerjaan</th> <td><input type='text' class='form-control' value='$s[pekerjaan_wali]' name='cr'></td></tr>
                            <tr><th scope='row'>Penghasilan</th> <td><input type='text' class='form-control' value='$s[penghasilan_wali]' name='cs'></td></tr>
                          </tbody>
                          </table>
                        </div>
                        <div class='box-footer'>
                          <button type='submit' name='update2' class='btn btn-info'>Update</button>
                          <a href='index.php?view=siswa'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                        </div>
                        </form>
                    </div>

                </div>
            </div>";

}elseif($_GET[act]=='detailsiswa'){
  cek_session_siswa();
    $detail = mysqli_query($koneksi,"SELECT a.*, b.*, c.nama_agama, d.nama_agama as nama_agama_ayah, e.nama_agama as nama_agama_ibu 
                            FROM psb_pendaftaran a JOIN jenis_kelamin b ON a.id_jenis_kelamin=b.id_jenis_kelamin
                              JOIN agama c ON a.id_agama=c.id_agama 
                                JOIN agama d ON a.agama_ayah=d.id_agama 
                                  JOIN agama e ON a.agama_ibu=e.id_agama 
                                    where a.id_pendaftaran='$_GET[id]'");
    $s = mysqli_fetch_array($detail);
      if ($_GET[view]=='psbsma'){
          $status = 'SMA';
          $filter = 'sma';
      }elseif ($_GET[view]=='psbsmk'){
          $status = 'SMK';
          $filter = 'smk';
      }elseif ($_GET[view]=='psbsmp'){
          $status = 'SMP';
          $filter = 'smp';
      }

      $ex = explode(' ',$s['waktu_daftar']);
      $tanggal = $ex[0];
      $jam = $ex[1];
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Siswa PSB $status</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#siswa' id='siswa-tab' role='tab' data-toggle='tab' aria-controls='siswa' aria-expanded='true'>Data Siswa </a></li>
                      <li role='presentation' class=''><a href='#ortu' role='tab' id='ortu-tab' data-toggle='tab' aria-controls='ortu' aria-expanded='false'>Data Orang Tua / Wali</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                    <div role='tabpanel' class='tab-pane fade active in' id='siswa' aria-labelledby='siswa-tab'>
                        <form class='form-horizontal'>
                        <div class='col-md-7'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='17'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
                                }
                                echo "<a href='index.php?view=psb$filter&act=editsiswa&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile</a>
                                </th>
                            </tr>
                            <tr><th width='120px' scope='row'>No Induk</th> <td>$s[no_induk]</td></tr>
                            <tr><th scope='row'>Nama Lengkap</th> <td>$s[nama]</td></tr>
                            <tr><th scope='row'>Nama Panggilan</th> <td>$s[nama_panggilan]</td></tr>
                            <tr><th scope='row'>Jenis Kelamin</th> <td>$s[jenis_kelamin]</td></tr>
                            <tr><th scope='row'>Tempat Lahir</th> <td>$s[tempat_lahir]</td></tr>
                            <tr><th scope='row'>Tanggal Lahir</th> <td>".tgl_indo($s[tanggal_lahir])."</td></tr>
                            <tr><th scope='row'>Agama</th> <td>$s[nama_agama]</td></tr>
                            <tr><th scope='row'>Anak Ke</th> <td>$s[anak_ke]</td></tr>
                            <tr><th scope='row'>Jumlah Saudara</th> <td>$s[jumlah_saudara]</td></tr>
                            <tr><th scope='row'>Status</th> <td>$s[status_dalam_keluarga]</td></tr>
                            <tr><th scope='row'>Alamat Siswa</th> <td>$s[alamat_siswa]</td></tr>
                          </tbody>
                          </table>
                        </div>
                        <div class='col-md-5'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                          <tr><th scope='row'>No Telpon</th> <td>$s[no_telpon]</td></tr>
                            <tr><th scope='row'>Berat Badan</th> <td>$s[berat_badan] Kg</td></tr>
                            <tr><th scope='row'>Tinggi Badan</th> <td>$s[tinggi_badan] Cm</td></tr>
                            <tr><th width='120px' scope='row'>Gol. Darah</th> <td>$s[golongan_darah]</td></tr>
                            <tr><th scope='row'>Pernah Sakit</th> <td>$s[penyakit_pernah_diderita]</td></tr>
                            <tr><th scope='row'>Diterima Kelas</th> <td>$s[diterima_dikelas]</td></tr>
                            <tr><th scope='row'>Diterima Tanggal</th> <td>".tgl_indo($s[diterima_tanggal])."</td></tr>
                            <tr><th scope='row'>Sekolah Asal</th> <td>$s[sekolah_asal]</td></tr>
                            <tr><th scope='row'>Alamat Sekolah</th> <td>$s[alamat_sekolah_asal]</td></tr>
                            <tr><th scope='row'>Tanggal Daftar</th> <td>".tgl_indo($tanggal).", $jam Wib</td></tr>
                          </tbody>
                          </table>
                        </div>   
                        </form>
                    </div>

                    <div role='tabpanel' class='tab-pane fade' id='ortu' aria-labelledby='ortu-tab'>
                        <form class='form-horizontal'>
                        <div class='col-md-12'>
                          <table class='table table-condensed table-bordered'>
                          <tbody>
                            <tr><th style='background-color:#E7EAEC' width='160px' rowspan='26'>";
                                if (trim($s[foto])==''){
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/no-image.jpg'>";
                                }else{
                                  echo "<img class='img-thumbnail' style='width:155px' src='foto_siswa/$s[foto]'>";
                                }
                                echo "<a href='index.php?view=psb$filter&act=editsiswa&id=$_GET[id]' class='btn btn-success btn-block'>Edit Profile</a>
                                </th>
                            </tr>
                            <tr bgcolor=#e3e3e3><th width='120px' scope='row'>Nama Ayah</th> <td>$s[nama_ayah]</td></tr>
                            <tr><th scope='row'>Tempat Lahir</th> <td>$s[tempat_lahir_ayah]</td></tr>
                            <tr><th scope='row'>Tanggal Lahir</th> <td>".tgl_indo($s[tanggal_lahir_ayah])."</td></tr>
                            <tr><th scope='row'>Agama</th> <td>$s[nama_agama_ayah]</td></tr>
                            <tr><th scope='row'>Pendidikan</th> <td>$s[pendidikan_ayah]</td></tr>
                            <tr><th scope='row'>Pekerjaan</th> <td>$s[pekerjaan_ayah]</td></tr>
                            <tr><th scope='row'>Alamat Rumah</th> <td>$s[alamat_rumah_ayah]</td></tr>
                            <tr><th scope='row'>Telpon Rumah</th> <td>$s[telpon_rumah_ayah]</td></tr>
                            <tr><th scope='row'>Alamat Kantor</th> <td>$s[alamat_kantor_ayah]</td></tr>
                            <tr><th scope='row'>Telpon Kantor</th> <td>$s[telpon_kantor_ayah]</td></tr>

                            <tr><th scope='row' coslpan='2'><br></th></tr>
                            <tr bgcolor=#e3e3e3><th width='120px' scope='row'>Nama Ayah</th> <td>$s[nama_ibu]</td></tr>
                            <tr><th scope='row'>Tempat Lahir</th> <td>$s[tempat_lahir_ibu]</td></tr>
                            <tr><th scope='row'>Tanggal Lahir</th> <td>".tgl_indo($s[tanggal_lahir_ibu])."</td></tr>
                            <tr><th scope='row'>Agama</th> <td>$s[nama_agama_ibu]</td></tr>
                            <tr><th scope='row'>Pendidikan</th> <td>$s[pendidikan_ibu]</td></tr>
                            <tr><th scope='row'>Pekerjaan</th> <td>$s[pekerjaan_ibu]</td></tr>
                            <tr><th scope='row'>Alamat Rumah</th> <td>$s[alamat_rumah_ibu]</td></tr>
                            <tr><th scope='row'>Telpon Rumah</th> <td>$s[telpon_rumah_ibu]</td></tr>
                            <tr><th scope='row'>Alamat Kantor</th> <td>$s[alamat_kantor_ibu]</td></tr>
                            <tr><th scope='row'>Telpon Kantor</th> <td>$s[telpon_kantor_ibu]</td></tr>

                            <tr><th scope='row' coslpan='2'><br></th></tr>
                            <tr bgcolor=#e3e3e3><th scope='row'>Nama Wali</th> <td>$s[nama_wali]</td></tr>
                            <tr><th scope='row'>Alamat Wali</th> <td>$s[alamat_wali]</td></tr>
                            <tr><th scope='row'>No Telpon</th> <td>$s[no_telpon_wali]</td></tr>
                          </tbody>
                          </table>
                        </div>
                        </form>
                    </div>

                </div>
            </div>";
}  
?>