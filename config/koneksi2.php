<?php
$server = "103.55.39.194";
$username = "smpmuhse_admin";
$password = "W%&Yr?jY)cVF";
$database = "smpmuhse_db_sim";

$koneksi2 = mysqli_connect($server, $username, $password, $database);
mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "<h1>Koneksi database gagal : " . mysqli_connect_error() . "</h1>";
    exit();
}
