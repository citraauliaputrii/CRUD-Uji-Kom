<?php
include "konek.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST["nim"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $kelas = $_POST["kelas"];
    $mata_kuliah = $_POST["mata_kuliah"];
    $nilai = $_POST["nilai"];

    $sql = "INSERT INTO data_mahasiswa (nim, nama_lengkap, kelas, mata_kuliah, nilai) VALUES ($nim, '$nama_lengkap', '$kelas', '$mata_kuliah', $nilai)";
    if ($konek->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }
} else {
    header("Location: index.php");
    exit;
}
