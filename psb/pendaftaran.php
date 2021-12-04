<?php
$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM psb_aktivasi where kode_pendaftaran='$_GET[kode]'"));
$d = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM psb_aktivasi where kode_pendaftaran='$_GET[kode]'"));
if ($cek <= 0){
	echo "<script>document.location='index.mu';</script>";
}else{
	if (isset($_POST['simpan'])){
		$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM psb_pendaftaran where kode_pendaftaran='$_GET[kode]'"));
		if ($cek >= 1){
			echo "<script>document.location='index.mu';</script>";
		}else{
			$kode = anti_injection($_GET['kode']);
			$a = anti_injection($_POST['a']);
			$b = anti_injection($_POST['b']);
			$c = anti_injection($_POST['c']);
			$d = anti_injection($_POST['d']);
			$e = anti_injection($_POST['e']);
			$f = anti_injection($_POST['f']);
			$g = anti_injection($_POST['g']);
			$h = anti_injection($_POST['h']);
			$i = anti_injection($_POST['i']);
			$j = anti_injection($_POST['j']);
			$k = anti_injection($_POST['k']);
			$l = anti_injection($_POST['l']);
			$m = anti_injection($_POST['m']);
			$n = anti_injection($_POST['n']);
			$o = anti_injection($_POST['o']);
			$p = '';
			$q = '';
			$r = anti_injection($_POST['r']);
			$s = anti_injection($_POST['s']);

			$a1 = anti_injection($_POST['a1']);
			$a2 = anti_injection($_POST['a2']);
			$b1 = anti_injection($_POST['b1']);
			$b2 = anti_injection($_POST['b2']);
			$c1 = anti_injection(tgl_simpan($_POST['c1']));
			$c2 = anti_injection(tgl_simpan($_POST['c2']));
			$d1 = anti_injection($_POST['d1']);
			$d2 = anti_injection($_POST['d2']);
			$e1 = anti_injection($_POST['e1']);
			$e2 = anti_injection($_POST['e2']);
			$f1 = anti_injection($_POST['f1']);
			$f2 = anti_injection($_POST['f2']);
			$g1 = anti_injection($_POST['g1']);
			$g2 = anti_injection($_POST['g2']);
			$h1 = anti_injection($_POST['h1']);
			$h2 = anti_injection($_POST['h2']);
			$i1 = anti_injection($_POST['i1']);
			$i2 = anti_injection($_POST['i2']);
			$j1 = anti_injection($_POST['j1']);
			$j2 = anti_injection($_POST['j2']);

			$aa = anti_injection($_POST['aa']);
			$bb = anti_injection($_POST['bb']);
			$cc = anti_injection($_POST['cc']);

			$tgllahir = anti_injection(tgl_simpan($_POST['tgllahir']));
			$status = $d[status];
			mysqli_query($koneksi,"UPDATE psb_aktivasi SET proses='1' where kode_pendaftaran='$kode'");
			mysqli_query($koneksi,"INSERT INTO psb_pendaftaran VALUES('','$kode','$a','$b','$c','$d','$e','$tgllahir','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p',
															   '$q','$r','$s','$a1','$b1','$c1','$d1','$e1','$f1','$g1','$h1','$i1','$j1',
															   '$a2','$b2','$c2','$d2','$e2','$f2','$g2','$h2','$i2','$j2','$aa','$bb','$cc','$status','".date('Y-m-d H:i:s')."')");

			$idd = mysqli_insert_id();
			   for ($i=0; $i<=6; $i++){
			     if (isset($_POST['sa'.$i])){
			       	$nama = $_POST['sa'.$i];
			       	$umur = $_POST['sb'.$i];
			       	$pendidikan = $_POST['sc'.$i];
			        if (trim($nama) != ''){
			       		mysqli_query($koneksi,"INSERT INTO psb_pendaftaran_saudara VALUES('','$idd','$nama','$umur','$pendidikan')");
			       	}
			     }
			   }
			echo "<script>document.location='pendaftaran-sukses.mu';</script>";
		}
	}

		if ($d[status] == 'sma'){
			$sekolah = 'SMA';
			$alert = "info";
		}elseif ($d[status] == 'smk'){
			$sekolah = 'SMK';
			$alert = "success";
		}else{
			$sekolah = 'SMP';
			$alert = "danger";
		}
?>
	<div class="alert alert-<?php echo $alert; ?>">
        <strong>PSB <?php echo $sekolah; ?> </strong> - Pendaftaran Siswa Baru
    </div>

<form action="" id="formku" class="form-horizontal"  method="post">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
		<div style="background:#fff;" class="input-group col-lg-6">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" class="required form-control" value='<?php echo $d[nama_lengkap]; ?>' name="a">
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Nama Panggilan</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
			<input type="text" class="required form-control" name="b">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">No Induk</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-random"></i></span>
			<input type="number" class="required number form-control" name="c">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-heart-empty"></i></span>
			<select class="required form-control" name="d">
				<option value="" selected="">- Pilih -</option>
				<?php 
					$jk = mysqli_query($koneksi,"SELECT * FROM jenis_kelamin");
					while ($j = mysqli_fetch_array($jk)){
						echo "<option value='$j[id_jenis_kelamin]'>$j[jenis_kelamin]</option>";
					}
				?>
			 </select>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Tempat Lahir</label>
		<div style="background:#fff;" class="input-group col-lg-9">
			<span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
			<input type="text" class="required form-control" name="e">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Tanggal Lahir</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			<input type="text" id="datepicker1" class="required form-control" name="tgllahir">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Agama</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-bell"></i></span>
			<select class="required form-control" name="f">
				<option value="" selected="">- Pilih -</option>
				<?php 
					$agama = mysqli_query($koneksi,"SELECT * FROM agama");
					while ($a = mysqli_fetch_array($agama)){
						echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
					}
				?>
			 </select>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Anak Ke</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
			<input type="text" class="required form-control" name="g">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Jumlah Saudara</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
			<input type="text" class="required form-control" name="h">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Status di Keluarga</label>
		<div style="background:#fff;" class="input-group col-lg-6">
			<span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>
			<input type="text" class="required form-control" name="i">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>
		<div style="background:#fff;" class="input-group col-lg-9">
			<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
			<textarea class="required form-control" name="j" style="height:60px" minlength="10"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">No Telpon</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
			<input type="number" class="required number form-control" name="k" value='0' minlength="11">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Berat Badan</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-object-align-horizontal"></i></span>
			<input type="number" class="required form-control" name="l" placeholder='Kilogram (KG)'>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Tinggi Badan</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-object-align-left"></i></span>
			<input type="number" class="required form-control" name="m" placeholder='Centimeter (Cm)'>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Golongan Darah</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-object-align-vertical"></i></span>
			<input type="text" class="required form-control" name="n">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Sakit Pernah Diderita</label>
		<div style="background:#fff;" class="input-group col-lg-9">
			<span class="input-group-addon"><i class="glyphicon glyphicon-erase"></i></span>
			<input type="text" class="required form-control" name="o">
		</div>
	</div>

	<!-- <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Diterima Dikelas</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
			<input type="text" class="required form-control" name="p">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Diterima Tanggal</label>
		<div style="background:#fff;" class="input-group col-lg-4">
			<span class="input-group-addon"><i class="glyphicon glyphicon-equalizer"></i></span>
			<input type="text" id="datepicker2" class="required form-control" name="q">
		</div>
	</div> -->

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Nama Sekolah Asal</label>
		<div style="background:#fff;" class="input-group col-lg-8">
			<span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
			<input type="text" class="required form-control" name="r">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Alamat Sekolah Asal</label>
		<div style="background:#fff;" class="input-group col-lg-9">
			<span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
			<input type="text" class="required form-control" name="s">
		</div>
	</div>
	<br>

	<table class="table daftar">
		<tr class="alert alert-<?php echo $alert; ?>">
			<th></th>
			<th><center>Data Ayah</center></th>
			<th><center>Data Ibu</center></th>
		</tr>
		<tr>
			<td width='170px' style="padding:0px !important"><label style='padding-right:9px' class="pull-right control-label">Nama Lengkap</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="a1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="a2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Tempat Lahir</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="b1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="b2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Tanggal Lahir</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" id="datepicker3" name="c1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" id="datepicker4" name="c2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Agama</label></td>
			<td><select class="required form-control" name="d1">
				<option value="" selected="">- Pilih -</option>
				<?php 
					$agama = mysqli_query($koneksi,"SELECT * FROM agama");
					while ($a = mysqli_fetch_array($agama)){
						echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
					}
				?>
			 </select>
			</td>
			<td><select class="required form-control" name="d2">
				<option value="" selected="">- Pilih -</option>
				<?php 
					$agama = mysqli_query($koneksi,"SELECT * FROM agama");
					while ($a = mysqli_fetch_array($agama)){
						echo "<option value='$a[id_agama]'>$a[nama_agama]</option>";
					}
				?>
			 </select>
			</td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Pendidikan Terakhir</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="e1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="e2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Pekerjaan</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="f1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="f2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Alamat Rumah</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="g1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="g2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">No Telpon Rumah</label></td>
			<td><input type="number" class="required form-control" style="border-radius:0px;" value='0' name="h1"></td>
			<td><input type="number" class="required form-control" style="border-radius:0px;" value='0' name="h2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">Alamat Kantor</label></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="i1"></td>
			<td><input type="text" class="required form-control" style="border-radius:0px;" name="i2"></td>
		</tr>
		<tr>
			<td><label style='padding-right:9px' class="pull-right control-label">No Telpon Kantor</label></td>
			<td><input type="number" class="required form-control" style="border-radius:0px;" value='0' name="j1"></td>
			<td><input type="number" class="required form-control" style="border-radius:0px;" value='0' name="j2"></td>
		</tr>
	</table>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Nama Wali</label>
		<div style="background:#fff;" class="input-group col-lg-8">
			<span class="input-group-addon"><i class="glyphicon glyphicon-compressed"></i></span>
			<input type="text" class="required form-control" name="aa">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Alamat Wali</label>
		<div style="background:#fff;" class="input-group col-lg-9">
			<span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
			<input type="text" class="required form-control" name="bb">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">No Telpon Wali</label>
		<div style="background:#fff;" class="input-group col-lg-3">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
			<input type="number" class="required number form-control" value='0' name="cc" minlength="11">
		</div>
	</div><br>

	<table class="table daftar">
		<tr class="alert alert-<?php echo $alert; ?>">
			<th width='30px'>No</th>
			<th><center>Nama Saudara</center></th>
			<th style="width:15%"><center>Umur</center></th>
			<th><center>Pendidikan</center></th>
		</tr>
		<?php for ($i=1; $i <= 6; $i++){
		echo "<tr>
				<td>$i</td>
				<td><input type='text' class='form-control' style='border-radius:0px;' name='sa".$i."'></td>
				<td><input type='number' class='form-control' style='border-radius:0px;' name='sb".$i."'></td>
				<td><input type='text' class='form-control' style='border-radius:0px;' name='sc".$i."'></td>
			  </tr>";
		} ?>
	</table>

	<div class="form-group">
		<div style="margin-left:15px">
			<button type="submit" name="simpan" class="btn btn-primary">Kirimkan</button>
			<button type="reset" class="btn btn-default">Batal</button>
		</div><br>
	</div>
	</form>

<?php } ?>