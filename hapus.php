<?php
include "konek.php";
$id = $_GET["id"];
$sql = "DELETE FROM data_mahasiswa WHERE id=$id";
if ($konek->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $konek->error;
}
header("Location: index.php");
exit;
