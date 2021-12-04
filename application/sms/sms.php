<?php
    echo "<form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Kirimkan Pesan Singkat (SMS)</h3>
                </div>
              <div class='box-body'>";
              		if (isset($_POST[kirim])){
						$hasil = mysqli_query($koneksi,"INSERT INTO sms VALUES('','$_POST[a]','$_POST[b]')");
						if ($hasil){
							echo "<div class='alert alert-success alert-dismissible fade in' role='alert'> 
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>×</span></button> <strong>Success!</strong> - Pesan SMS ke $_POST[a] Telah dikirim,...
								  </div>";
						}else{
							echo "<center style='color:red; padding:15px 0px'>Pengiriman SMS gagal,...</center>";
						}
					}
                echo "


                <table class='table table-condensed table-bordered'>
                  <tbody>
                  	<tr><th width=120px scope='row'>No Telpon</th>  <td><input type='number' class='form-control' name='a' style='width:30%' placeholder='Input No Telpon...' required></td></tr>
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