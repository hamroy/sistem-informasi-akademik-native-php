<?php
include "../../config/koneksi.php";
$code = $_GET['code'];
$op = $_GET['op'];

header('Content-Type: text/xml');
echo "<?xml version='1.0'?>";
echo "<data>";

// cek kesesuaian kode API
if ($code == '19891989'){
	if ($op == 'send'){
	    // baca data SMS
		$pesan = $_GET['pesan'];
		$notelp = $_GET['notelp'];
		$waktu = $_GET['timee'];
		$idmodem = $_GET['idmodem'];
		
		// menyimpan data SMS ke inbox di database hosting
		$query = "INSERT INTO sms_inbox (pesan, nohp, waktu, modem) VALUES ('$pesan', '$notelp', '$waktu', '$idmodem')";
		mysqli_query($koneksi,$query);

		$qr = mysqli_query($koneksi,"SELECT * FROM sms_autoreply where keyword='$pesan'");
		$ar = mysqli_num_rows($qr);
		$r = mysqli_fetch_array($qr);
		if ($ar >= 1){
			mysqli_query($koneksi,"INSERT INTO sms VALUES('','$notelp','$r[isi_pesan]')");
			mysqli_query($koneksi,"INSERT INTO sms_outbox VALUES('','$notelp','$r[isi_pesan]','".date('Y-m-d H:i:s')."')");
		}
	}
}
echo "</data>";
?>