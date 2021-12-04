<?php
    echo "<form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Kirimkan Banyak Pesan (SMS Broadcast)</h3>
                </div>
              <div class='box-body'>";

                if (isset($_POST[kirim])){
                    if ($_POST[aa]=='1'){
                        $kolom = 'hp';
                    }elseif ($_POST[aa]=='2'){
                        $kolom = 'no_telpon_ayah';
                    }else{
                        $kolom = 'no_telpon_ibu';
                    }

                  $querysms = mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_POST[a]' AND $kolom !=''");
                  $totalsiswa = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM siswa where kode_kelas='$_POST[a]'"));
                  $total = mysqli_num_rows($querysms);
                  while ($s = mysqli_fetch_array($querysms)){
                    if ($_POST[aa]=='1'){
                        $target = $s[hp];
                    }elseif ($_POST[aa]=='2'){
                        $target = $s[no_telpon_ayah];
                    }else{
                        $target = $s[no_telpon_ibu];
                    }
                      mysqli_query($koneksi,"INSERT INTO sms VALUES('','$target','$_POST[b]')");
                  }

                    if ($_POST[aa]=='2'){ $ket = 'Orang Tua (Ayah)'; }elseif($_POST[aa]=='3'){ $ket = 'Orang Tua (Ibu)'; }else{}
                    echo "<div class='alert alert-success alert-dismissible fade in' role='alert'> 
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>×</span></button> <strong>Success!</strong> - Pesan SMS ke $ket siswa kelas $_POST[a] Sebanyak $total dari $totalsiswa Orang siswa Telah dikirim,...
                        </div>";
                }

           echo "<table class='table table-condensed table-bordered'>
                  <tbody>
                  	<tr><th width=120px scope='row'>Pilih Kelas</th>  <td><select class='form-control' name='a' style='width:30%' required>";
                                                                            echo "<option value=''>- Belum Terpilih -</option>";
                                                                            $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                                                                            while ($k = mysqli_fetch_array($kelas)){
                                                                                echo "<option value='$k[kode_kelas]'>$k[kode_kelas] - $k[nama_kelas]</option>";
                                                                            }
                                                                          echo "</select></td></tr>
                    <tr><th>Pilih Target</th>  <td><select class='form-control' name='aa' style='width:30%' required>
                                                      <option value=''>- Belum Terpilih -</option>
                                                      <option value='1'>Kirim ke Siswa</option>
                                                      <option value='2'>Kirim ke Ayah</option>
                                                      <option value='3'>Kirim ke Ibu</option>
                                                   </select></td></tr>                                                    
                    <tr><th scope='row'>Isi Pesan</th>           	<td><textarea rows='6' class='form-control' name='b' placeholder='Tuliskan Pesan anda (Max 160 Karakter)...' onKeyDown=\"textCounter(this.form.b,this.form.countDisplay);\" onKeyUp=\"textCounter(this.form.b,this.form.countDisplay);\" required></textarea>
                    													<input type='number' name='countDisplay' size='3' maxlength='3' value='160' style='width:10%; text-align:center' readonly> Sisa Karakter</td></tr>
                  </tbody>
                  </table>
              </div>

              <div class='box-footer'>
                    <button type='submit' name='kirim' class='btn btn-info'>Kirimkan Pesan</button>
                    <button type='reset' class='btn btn-default pull-right'>Reset</button>
              </div>
            </div>
          </form>";