<?php
// ADMINISTARTIOR /////////////////////////////////////////////////////////////////////////////////
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=1><span aria-hidden='true'>&larr;</span> Awal</a>
                      <li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$prev class='nextprev'><span aria-hidden='true'>&laquo;</span></a>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif >  3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$i>$i</a></li>";
  }
	  $angka .= "<li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li> <li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$jmlhalaman>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$next><span aria-hidden='true'>&raquo;</span></a><li>
                      <li><a href=$_SERVER[PHP_SELF]?view=$_GET[view]&halaman=$jmlhalaman>Akhir <span aria-hidden='true'>&rarr;</span></a></li> ";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN UTAMA/////////////////////////////////////////////////////////////////////////////////
class Paging1{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halutama'])){
	$posisi=0;
	$_GET['halutama']=1;
}
else{
	$posisi = ($_GET['halutama']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-index-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-index-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-index-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-index-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href='hal-index-$jmlhalaman.mu'>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-index-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-index-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN PERKARA DALAM/////////////////////////////////////////////////////////////////////////////////
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haldalam'])){
	$posisi=0;
	$_GET['haldalam']=1;
}
else{
	$posisi = ($_GET['haldalam']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-data-perkara-$_GET[status]-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-data-perkara-$_GET[status]-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-data-perkara-$_GET[status]-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-data-perkara-$_GET[status]-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href=hal-data-perkara-$_GET[status]-$jmlhalaman.mu>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-data-perkara-$_GET[status]-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-data-perkara-$_GET[status]-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}



// HALAMAN PERKARA LUAR/////////////////////////////////////////////////////////////////////////////////
class Paging3{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halluar'])){
	$posisi=0;
	$_GET['halluar']=1;
}
else{
	$posisi = ($_GET['halluar']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-perkara-luar-$_GET[status]-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-perkara-luar-$_GET[status]-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-perkara-luar-$_GET[status]-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-perkara-luar-$_GET[status]-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href=hal-perkara-luar-$_GET[status]-$jmlhalaman.mu>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-perkara-luar-$_GET[status]-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-perkara-luar-$_GET[status]-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN PUTUSAN/////////////////////////////////////////////////////////////////////////////////
class Paging4{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halputusan'])){
	$posisi=0;
	$_GET['halputusan']=1;
}
else{
	$posisi = ($_GET['halputusan']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-putusan-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-putusan-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-putusan-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-putusan-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href='hal-putusan-$jmlhalaman.mu'>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-putusan-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-putusan-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN PANJAR/////////////////////////////////////////////////////////////////////////////////
class Paging5{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halpanjar'])){
	$posisi=0;
	$_GET['halpanjar']=1;
}
else{
	$posisi = ($_GET['halpanjar']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-sisa-panjar-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-sisa-panjar-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-sisa-panjar-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-sisa-panjar-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href='hal-sisa-panjar-$jmlhalaman.mu'>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-sisa-panjar-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-sisa-panjar-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN ISBAT/////////////////////////////////////////////////////////////////////////////////
class Paging6{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halisbatnikah'])){
	$posisi=0;
	$_GET['halisbatnikah']=1;
}
else{
	$posisi = ($_GET['halisbatnikah']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-isbat-nikah-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-isbat-nikah-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-isbat-nikah-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-isbat-nikah-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href='hal-isbat-nikah-$jmlhalaman.mu'>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-isbat-nikah-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-isbat-nikah-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}


// HALAMAN GHOIB/////////////////////////////////////////////////////////////////////////////////
class Paging7{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halghoib'])){
	$posisi=0;
	$_GET['halghoib']=1;
}
else{
	$posisi = ($_GET['halghoib']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
    $link_halaman .= "<li><a href='hal-panggilan-ghoib-1.mu'><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href='hal-panggilan-ghoib-$prev.mu'><span aria-hidden='true'>&laquo;</span></a></li>";
}
else{ 
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&larr;</span> Awal</a></li>
					  <li><a href=''><span aria-hidden='true'>&laquo;</span></a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " <li><a href=''>...</a></li>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href='hal-panggilan-ghoib-$i.mu'>$i</a></li>";
  }
	  $angka .= " <li class='active'><a href=''>$halaman_aktif</a></li>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href='hal-panggilan-ghoib-$i.mu'>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href=''>...</a></li><li><a href='hal-panggilan-ghoib-$jmlhalaman.mu'>$jmlhalaman</a></li>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Lanjut) dan terakhir (Akhir) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "<li><a href='hal-panggilan-ghoib-$next.mu'><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href='hal-panggilan-ghoib-$jmlhalaman.mu'>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
else{
	$link_halaman .= "<li><a href=''><span aria-hidden='true'>&raquo;</span></a></li>
                      <li><a href=''>Akhir <span aria-hidden='true'>&rarr;</span></a></li>";
}
return $link_halaman;
}
}
?>
