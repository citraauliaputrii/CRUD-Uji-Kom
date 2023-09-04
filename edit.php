<?php
include "konek.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nim = $_POST["nim"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $kelas = $_POST["kelas"];
    $mata_kuliah = $_POST["mata_kuliah"];
    $nilai = $_POST["nilai"];

    $sql = "UPDATE data_mahasiswa SET nim=$nim, nama_lengkap='$nama_lengkap', kelas='$kelas', mata_kuliah='$mata_kuliah', nilai=$nilai WHERE id=$id";
    if ($konek->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }
} else {
    header("Location: index.php");
    exit;
}
