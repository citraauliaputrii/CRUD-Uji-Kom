<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_mahasiswa";

$konek = new mysqli($servername, $username, $password, $dbname);

if ($konek->connect_error) {
    die("Koneksi gagal: " . $konek->connect_error);
}
