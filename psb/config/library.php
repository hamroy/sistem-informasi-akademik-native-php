<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");

$bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei", 
                    "Jun", "Jul", "Agu", "Sep", 
                    "Okt", "Nov", "Des");

function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
}
?>
