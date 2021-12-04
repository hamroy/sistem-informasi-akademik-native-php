<?php
$query = mysqli_query($koneksi,"SELECT * FROM halaman where judul_seo='$_GET[seo]' AND status='psb'");
$row = mysqli_fetch_array($query);
	echo "<div class='alert alert-success'>$row[judul]</div>
	      <p>".nl2br($row['isi_halaman'])."</p>";
